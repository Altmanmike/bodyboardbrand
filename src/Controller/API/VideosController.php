<?php

namespace App\Controller\API;

use App\Entity\Video;
use App\Repository\CategoryVideoRepository;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/videos', name: 'api_videos')]
#[OA\Tag(name: 'Video endpoints', description: 'Video operations')]
final class VideosController extends AbstractController
{
    #[Route('/', name: '_all', methods: ['GET'])]
    public function getVideos(VideoRepository $videoRepo, SerializerInterface $serializer): JsonResponse
    {
        $videos = $videoRepo->findAll();

        $data = $serializer->serialize($videos, 'json', ['groups' => ['videos.index', 'videos.show', 'videos.date']]);

        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', name: '_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]
    public function getVideo(VideoRepository $videoRepo, int $id): JsonResponse
    {
        $video = $videoRepo->find($id);

        if (!$video) {
            return $this->json(['error' => 'Video not found'], 404);
        }

        return $this->json($video, 200, [], [
            'groups' => ['videos.index', 'videos.show'],
        ]);
    }

    #[Route('/', name: '_create', methods: ['POST'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['url', 'title', 'description', 'category', 'user'],
            properties: [
                new OA\Property(property: 'url', type: 'string', example: 'beMjspD76Bk'),
                new OA\Property(property: 'title', type: 'string', example: 'My first Video'),
                new OA\Property(property: 'description', type: 'string', example: 'This is the description of the Video.'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Friends and co'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Video created successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'url', type: 'string', example: 'beMjspD76Bk'),
                new OA\Property(property: 'title', type: 'string', example: 'My first Video'),
                new OA\Property(property: 'description', type: 'string', example: 'This is the content of the Video.'),
                new OA\Property(property: 'category', type: 'string', example: 'Friends and co'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function createVideo(Request $request, UserRepository $userRepo, CategoryVideoRepository $catRepo, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }
        
        if (!array_key_exists('url', $data) || !array_key_exists('title', $data) || !array_key_exists('description', $data) || !array_key_exists('category', $data) || !array_key_exists('user', $data)) {
            return $this->json(['error' => 'Fields "url", "title", "description", "category" and "user" are required.'], 400);
        }

        $video = new Video();

        $dataSer = $serializer->deserialize($request->getContent(), Video::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $video,
            'groups' => ['videos.create'],
        ]);

        $video->setUrl($dataSer->getUrl());
        $video->setTitle($dataSer->getTitle());
        $video->setDescription($dataSer->getDescription());
        $video->setCreatedAt(new \DateTimeImmutable());
        $video->setUpdatedAt(new \DateTimeImmutable());
        $category = $catRepo->findOneBy(['name' => $data['category']]);
        $video->setCategory($category);
        $user = $userRepo->findOneBy(['email' => $data['user']]);
        $video->setUser($user);

        $entityManager->persist($video);
        $entityManager->flush();

        $responseData = $serializer->serialize($video, 'json', ['groups' => 'videos.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_del', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function deleteVideo(VideoRepository $videoRepo, int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $video = $videoRepo->find($id);

        if (!$video) {
            return $this->json(['error' => 'Video not found'], 404);
        }

        $entityManager->remove($video);
        $entityManager->flush();

        return $this->json($video, 204, [], []);
    }

    #[Route('/{id}', name: '_update', methods: ['PUT'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['url', 'title', 'description', 'category', 'user'],
            properties: [
                new OA\Property(property: 'url', type: 'string', example: 'beMjspD76Bk'),
                new OA\Property(property: 'title', type: 'string', example: 'My first Video'),
                new OA\Property(property: 'description', type: 'string', example: 'This is the description of the Video.'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Friends and co'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Video put successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'url', type: 'string', example: 'beMjspD76Bk'),
                new OA\Property(property: 'title', type: 'string', example: 'My first Video'),
                new OA\Property(property: 'description', type: 'string', example: 'This is the content of the Video.'),
                new OA\Property(property: 'category', type: 'string', example: 'Friends and co'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updateVideo(VideoRepository $videoRepo, int $id, Request $request, SerializerInterface $serializer, CategoryVideoRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $video = $videoRepo->find($id);

        if (!$video) {
            return $this->json(['error' => 'Video not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }

        if (!array_key_exists('url', $data) || !array_key_exists('title', $data) || !array_key_exists('description', $data) || !array_key_exists('category', $data) || !array_key_exists('user', $data)) {
            return $this->json(['error' => 'Fields "url", "title", "description", "category" and "user" are required.'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Video::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $video,
            'groups' => ['videos.update'],
        ]);

        $video->setUrl($dataSer->getUrl());
        $video->setTitle($dataSer->getTitle());
        $video->setDescription($dataSer->getDescription());
        $video->setCreatedAt(new \DateTimeImmutable());
        $video->setUpdatedAt(new \DateTimeImmutable());
        $category = $catRepo->findOneBy(['name' => $data['category']]);
        $video->setCategory($category);
        $user = $userRepo->findOneBy(['email' => $data['user']]);
        $video->setUser($user);

        $entityManager->persist($video);
        $entityManager->flush();

        $responseData = $serializer->serialize($video, 'json', ['groups' => 'videos.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_updateField', methods: ['PATCH'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['url', 'title', 'description', 'category', 'user'],
            properties: [
                new OA\Property(property: 'url', type: 'string', example: 'beMjspD76Bk'),
                new OA\Property(property: 'title', type: 'string', example: 'My first Video'),
                new OA\Property(property: 'description', type: 'string', example: 'This is the description of the Video.'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Friends and co'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Video patched successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'url', type: 'string', example: 'beMjspD76Bk'),
                new OA\Property(property: 'title', type: 'string', example: 'My first Video'),
                new OA\Property(property: 'description', type: 'string', example: 'This is the content of the Video.'),
                new OA\Property(property: 'category', type: 'string', example: 'Friends and co'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updateFieldVideo(VideoRepository $videoRepo, int $id, Request $request, SerializerInterface $serializer, CategoryVideoRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $video = $videoRepo->find($id);

        if (!$video) {
            return $this->json(['error' => 'Video not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Video::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $video,
            'groups' => ['videos.update'],
        ]);

        if (array_key_exists('url', $data)) {
            $url = $dataSer->getUrl();
            if ($url === null) {
                return $this->json(['error' => 'The "url" field cannot be null'], 400);
            }
            $video->setUrl($url);
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('title', $data)) {
            $title = $dataSer->getTitle();
            if ($title === null) {
                return $this->json(['error' => 'The "title" field cannot be null'], 400);
            }
            $video->setTitle($title);
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('description', $data)) {
            $description = $dataSer->getDescription();
            if ($description === null) {
                return $this->json(['error' => 'The "description" field cannot be null'], 400);
            }
            $video->setDescription($description);
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('category', $data)) {
            $category = $catRepo->findOneBy(['name' => $data['category']]);
            if ($category === null) {
                return $this->json(['error' => 'The "category" field cannot be null'], 400);
            }
            $video->setCategory($category);
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('user', $data)) {
            $user = $userRepo->findOneBy(['email' => $data['user']]);
            if ($user === null) {
                return $this->json(['error' => 'The "user" field cannot be null'], 400);
            }
            $video->setUser($user);
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($video);
        $entityManager->flush();

        $responseData = $serializer->serialize($video, 'json', ['groups' => 'videos.show']);

        return new JsonResponse($responseData, 201, [], true);
    }
}
