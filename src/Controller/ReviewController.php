<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\User;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReviewController extends AbstractController
{


    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    #[Route('/review', name: 'app_review', methods: ['GET'])]
    public function indexReview( ReviewRepository $reviewRepository, SerializerInterface $serializer): JsonResponse
    {
        $coursesList = $reviewRepository->findAll();

        $serializedCourses = $serializer->serialize($coursesList, 'json', ['groups' => ['user','review']]);

        return new JsonResponse($serializedCourses, 200, [], true);
    }

    #[Route('/review-add', name: 'app_review_add', methods: ['GET' ,'POST'])]
    public function addReview(EntityManagerInterface $entityManager,ManagerRegistry $doctrine, HttpFoundationRequest $request): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $authorReview = $doctrine->getRepository(User::class)->find($data['author']);
        $allReview = $doctrine->getRepository(Review::class)->findBy(['author' => $data['author']]);

        if (!$authorReview) {
            $textError = "L'utilisateur n'existe pas";
            return new JsonResponse($textError, 404, [], true);
        }
    
        if ($allReview) {
            $textError = "L'utilisateur a déjà laissé un message";
            return new JsonResponse($textError, 404, [], true);
        }

        $review = new Review();
        $review->setAuthor($authorReview);
        $review->setContentText($data['contentText'] ?? '');
        $review->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($review);
        $entityManager->flush();

        return new JsonResponse("Votre avis a bien été envoyé  et enregistré avec succès", 200, [], true);

    }

    #[Route('/delete-review/{id}', name: 'delete_review', methods: ['DELETE'])]
    public function removeMessage(ManagerRegistry $doctrine, EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $review = $doctrine->getRepository(Review::class)->findBy(['author' => $id]);

        if (!$review) {
            return new JsonResponse('Review not found', 404);
        }

        $entityManager->remove($review[0]);
        $entityManager->flush();

        return new JsonResponse('Review removed successfully');
    }
}
