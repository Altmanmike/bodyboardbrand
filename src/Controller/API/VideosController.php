<?php

namespace App\Controller\API;

use App\Entity\Video;
use App\Repository\CategoryVideoRepository;
use OpenApi\Attributes as OA;
use App\Repository\VideoRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/videos', name:'api_videos')]
#[OA\Tag(name: "Video endpoints", description: "Video operations")]
class VideosController extends AbstractController
{
    #[Route('/', name:'_all', methods: ['GET'])]   
    public function getVideos(VideoRepository $videoRepo, SerializerInterface $serializer)
    {
        $videos = $videoRepo->findAll();

        $data = $serializer->serialize($videos, 'json', ['groups' => ['videos.index','videos.show','videos.date']]);

        return new JsonResponse($data, 200, [], true); 
    }

    #[Route('/{id}', name:'_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]
    public function getVideo(VideoRepository $videoRepo, $id)
    {
        $video = $videoRepo->find($id);

        if (!$video) {
            return $this->json(['error' => 'Video not found'], 404);
        }

        return $this->json($video, 200, [], [
            'groups' => ['videos.index','videos.show']
        ]);       
    }
    
    #[Route('/', name: '_create', methods: ['POST'])] 
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            required: ["url", "title", "description", "category", "user"],
            properties: [                
                new OA\Property(property: "url", type: "string", example: "beMjspD76Bk"),
                new OA\Property(property: "title", type: "string", example: "My first Video"),
                new OA\Property(property: "description", type: "string", example: "This is the description of the Video."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Friends and co")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "hgautier@hotmail.fr")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Video created successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "url", type: "string", example: "beMjspD76Bk"),
                new OA\Property(property: "title", type: "string", example: "My first Video"),
                new OA\Property(property: "description", type: "string", example: "This is the content of the Video."),
                new OA\Property(property: "category", type: "string", example: "Friends and co"),
                new OA\Property(property: "user", type: "string", example: "hgautier@hotmail.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    public function createVideo(Request $request, UserRepository $userRepo, CategoryVideoRepository $catRepo, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['url'], $data['title'], $data['description'], $data['category'], $data['user'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $video = new Video();

        $dataSer = $serializer->deserialize($request->getContent(), Video::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $video,
            'groups' => ['videos.create']
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
    public function deleteVideo(VideoRepository $videoRepo, $id, EntityManagerInterface $entityManager)
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
            type: "object",
            required: ["url", "title", "description", "category", "user"],
            properties: [                
                new OA\Property(property: "url", type: "string", example: "beMjspD76Bk"),
                new OA\Property(property: "title", type: "string", example: "My first Video"),
                new OA\Property(property: "description", type: "string", example: "This is the description of the Video."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Friends and co")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "hgautier@hotmail.fr")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Video put successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "url", type: "string", example: "beMjspD76Bk"),
                new OA\Property(property: "title", type: "string", example: "My first Video"),
                new OA\Property(property: "description", type: "string", example: "This is the content of the Video."),
                new OA\Property(property: "category", type: "string", example: "Friends and co"),
                new OA\Property(property: "user", type: "string", example: "hgautier@hotmail.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    public function updateVideo(VideoRepository $videoRepo, $id, Request $request, SerializerInterface $serializer, CategoryVideoRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager)
    {
        $video = $videoRepo->find($id);

        if (!$video) {
            return $this->json(['error' => 'Video not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['url'], $data['title'], $data['description'], $data['category'], $data['user'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Video::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $video,
            'groups' => ['videos.update']
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
            type: "object",
            required: ["url", "title", "description", "category", "user"],
            properties: [                
                new OA\Property(property: "url", type: "string", example: "beMjspD76Bk"),
                new OA\Property(property: "title", type: "string", example: "My first Video"),
                new OA\Property(property: "description", type: "string", example: "This is the description of the Video."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Friends and co")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "hgautier@hotmail.fr")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Video patched successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "url", type: "string", example: "beMjspD76Bk"),
                new OA\Property(property: "title", type: "string", example: "My first Video"),
                new OA\Property(property: "description", type: "string", example: "This is the content of the Video."),
                new OA\Property(property: "category", type: "string", example: "Friends and co"),
                new OA\Property(property: "user", type: "string", example: "hgautier@hotmail.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    public function updateFieldVideo(VideoRepository $videoRepo, $id, Request $request, SerializerInterface $serializer, CategoryVideoRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager)
    {
        $video = $videoRepo->find($id);

        if (!$video) {
            return $this->json(['error' => 'Video not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $dataSer = $serializer->deserialize($request->getContent(), Video::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $video,
            'groups' => ['videos.update']
        ]);        
        
        if (isset($data['url'])) {
            $video->setUrl($dataSer->getUrl());
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['title'])) {
            $video->setTitle($dataSer->getTitle());
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['description'])) {
            $video->setDescription($dataSer->getDescription());
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['category'])) {
            $category = $catRepo->findOneBy(['name' => $data['category']]);        
            $video->setCategory($category);            
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['user'])) {
            $user = $userRepo->findOneBy(['email' => $data['user']]);
            $video->setUser($user);                      
            $video->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($video);        
        $entityManager->flush();

        $responseData = $serializer->serialize($video, 'json', ['groups' => 'videos.show']);

        return new JsonResponse($responseData, 201, [], true);
    }  
    
}
