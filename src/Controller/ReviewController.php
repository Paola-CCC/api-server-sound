<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReviewController extends AbstractController
{
    #[Route('/review', name: 'app_review', methods: ['GET'])]
    public function indexReview( ReviewRepository $reviewRepository, SerializerInterface $serializer): JsonResponse
    {
        $coursesList = $reviewRepository->findAll();

        $serializedCourses = $serializer->serialize($coursesList, 'json', ['groups' => ['user','review']]);

        return new JsonResponse($serializedCourses, 200, [], true);
    }
}
