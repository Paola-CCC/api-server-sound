<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Entity\User;
use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\RatingRepository;
use App\Repository\CourseRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class RatingController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/ratings', name: 'ratings_list', methods: ['GET'])]
    public function getRatingsList(RatingRepository $ratingRepository, SerializerInterface $serializer): JsonResponse
    {
        $ratingsList = $ratingRepository->findAll();

        $serializedRatings = $serializer->serialize($ratingsList, 'json', ['groups' => ['rating', 'rating_user', 'rating_course']]);

        return new JsonResponse($serializedRatings, 200, [], true);

    }

    #[Route('/ratings/{courseId}', name: 'ratings_by_course', methods: ['GET'])]
    public function getRatingsByCourse(int $courseId, CourseRepository $courseRepository, RatingRepository $ratingRepository, SerializerInterface $serializer): JsonResponse
    {
        $course = $courseRepository->find($courseId);

        if (!$course) {
            return new JsonResponse(['message' => 'Course not found'], 404);
        }

        $ratings = $ratingRepository->findOneBy(['course' => $courseId]);

        if(!$ratings){
            return new JsonResponse(['message' => 'No ratings found'], 404);
        }

        $serializedRatings = $serializer->serialize($ratings, 'json', ['groups' => ['rating', 'rating_user', 'rating_course']]);

        return new JsonResponse($serializedRatings, 200, [], true);

    }

    #[Route('/new-rating', name: 'new_rating', methods: ['POST'])]
    public function newRating(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $courseId = $data['courseId'];
        $course = $this->entityManager->getRepository(Course::class)->find($courseId);
        $user = $this->entityManager->getRepository(User::class)->find($data['userId']);
        
        if (!$course) {
            return new Response("Course not found", 404);
        }

        if (!$user) {
            return new Response("User not found", 404);
        }

        $review = $this->entityManager->getRepository(User::class)->findby([
            'user' =>  $data['userId'],
            'course' => $data['courseId']
        ]);

        if ($review) {
            return new Response("Attention! Cet utilisateur a déjà donné son avis sur ce cours", 404);
        }

        $rating = new Rating();
        $rating->setCourse($course);
        $rating->setValue($data['valueRating']);
        $rating->setUser($user);
        $this->entityManager->persist($rating);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Rating created successfully']);

    }
}
