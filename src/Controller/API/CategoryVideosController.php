<?php

namespace App\Controller\API;

use App\Entity\CategoryVideo;
use OpenApi\Attributes as OA;
use App\Repository\CategoryVideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/categoryVideos', name:'api_categoryVideos')]
#[OA\Tag(name: "CategoryVideos endpoints", description: "CategoryVideos operations")]
class CategoryVideosController extends AbstractController
{
    #[Route('/', name:'_all', methods: ['GET'])]    
    public function getCategoryVideos(CategoryVideoRepository $categoryVideoRepo, SerializerInterface $serializer): JsonResponse
    {
        $categoryVideos = $categoryVideoRepo->findAll();

        $data = $serializer->serialize($categoryVideos, 'json', ['groups' => ['categoryVideos.index','categoryVideos.show','categoryVideos.date']]);

        return new JsonResponse($data, 200, [], true); 
    }

    #[Route('/{id}', name:'_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]    
    public function getCategoryVideo(CategoryVideoRepository $categoryVideoRepo, $id): JsonResponse
    {
        $categoryVideo = $categoryVideoRepo->find($id);

        if (!$categoryVideo) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        return $this->json($categoryVideo, 200, [], [
            'groups' => ['categoryVideos.index','categoryVideos.show']
        ]);       
    }
    
    #[Route('/', name: '_create', methods: ['POST'])] 
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            required: ["name","description"],
            properties: [
                new OA\Property(property: "name", type: "string", example: "Other category"),
                new OA\Property(property: "description", type: "string", example: "The description of the category...")                
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "CategoryVideo created successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "name", type: "string", example: "Other category"),
                new OA\Property(property: "description", type: "string", example: "The description of the category..."),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")                
            ]             
        )
    )]
    public function createCategoryVideo(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'], $data['description'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $categoryVideo = new CategoryVideo();

        $dataSer = $serializer->deserialize($request->getContent(), CategoryVideo::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryVideo,
            'groups' => ['categoryVideos.create']
        ]);        
              
        $categoryVideo->setName($dataSer->getName());
        $categoryVideo->setDescription($dataSer->getDescription());
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($categoryVideo);
        $entityManager->flush();
                
        $responseData = $serializer->serialize($categoryVideo, 'json', ['groups' => 'categoryVideos.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_del', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function deleteCategoryVideo(CategoryVideoRepository $categoryVideoRepo, $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryVideo = $categoryVideoRepo->find($id);

        if (!$categoryVideo) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $entityManager->remove($categoryVideo);        
        $entityManager->flush();
        
        return $this->json($categoryVideo, 204, [], []); 
    }

    #[Route('/{id}', name: '_update', methods: ['PUT'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            required: ["name","description"],
            properties: [
                new OA\Property(property: "name", type: "string", example: "Other category"),
                new OA\Property(property: "description", type: "string", example: "The description of the category...")                
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "CategoryVideo created successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "name", type: "string", example: "Other category"),
                new OA\Property(property: "description", type: "string", example: "The description of the category..."),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")                
            ]             
        )
    )]    
    public function updateCategoryVideo(CategoryVideoRepository $categoryVideoRepo, $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryVideo = $categoryVideoRepo->find($id);

        if (!$categoryVideo) {
            return $this->json(['error' => 'CategoryVideo not found'], 404);
        }
        
        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'], $data['description'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), CategoryVideo::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryVideo,
            'groups' => ['categoryVideos.create']
        ]);        
              
        $categoryVideo->setName($dataSer->getName());
        $categoryVideo->setDescription($dataSer->getDescription());
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($categoryVideo);
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryVideo, 'json', ['groups' => 'categoryVideos.show']);

        return new JsonResponse($responseData, 201, [], true);
    } 
    
    #[Route('/{id}', name: '_updateField', methods: ['PATCH'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            required: ["name","description"],
            properties: [
                new OA\Property(property: "name", type: "string", example: "Other category"),
                new OA\Property(property: "description", type: "string", example: "The description of the category...")                
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "CategoryVideo patched successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "name", type: "string", example: "Other category"),
                new OA\Property(property: "description", type: "string", example: "The description of the category..."),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")                
            ]             
        )
    )]
    public function updateFieldCategoryVideo(CategoryVideoRepository $categoryVideoRepo, $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryVideo = $categoryVideoRepo->find($id);

        if (!$categoryVideo) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $dataSer = $serializer->deserialize($request->getContent(), CategoryVideo::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryVideo,
            'groups' => ['categoryVideos.update']
        ]);        
          
        if (isset($data['name'])) {
            $categoryVideo->setName($dataSer->getName());
            $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['description'])) {
            $categoryVideo->setDescription($dataSer->getDescription());
            $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($categoryVideo);        
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryVideo, 'json', ['groups' => 'categoryVideos.show']);

        return new JsonResponse($responseData, 201, [], true);
    }  
    
}
