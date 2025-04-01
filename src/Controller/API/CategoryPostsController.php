<?php

namespace App\Controller\API;

use App\Entity\CategoryPost;
use App\Repository\CategoryPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/categoryPosts', name: 'api_categoryPosts')]
#[OA\Tag(name: 'CategoryPosts endpoints', description: 'CategoryPosts operations')]
final class CategoryPostsController extends AbstractController
{
    #[Route('/', name: '_all', methods: ['GET'])]
    public function getcategoryPosts(CategoryPostRepository $categoryPostRepo, SerializerInterface $serializer): JsonResponse
    {
        $categoryPosts = $categoryPostRepo->findAll();

        $data = $serializer->serialize($categoryPosts, 'json', ['groups' => ['categoryPosts.index', 'categoryPosts.show', 'categoryPosts.date']]);

        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', name: '_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]
    public function getCategoryPost(CategoryPostRepository $categoryPostRepo, int $id): JsonResponse
    {
        $categoryPost = $categoryPostRepo->find($id);

        if (!$categoryPost) {
            return $this->json(['error' => 'CategoryPost not found'], 404);
        }

        return $this->json($categoryPost, 200, [], [
            'groups' => ['categoryPosts.index', 'categoryPosts.show'],
        ]);
    }

    #[Route('/', name: '_create', methods: ['POST'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['name', 'description'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Other category'),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the category...'),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'CategoryPost created successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Other category'),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the category...'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    #[OA\Response(response: 400, description: 'Invalid input data')]
    public function createCategoryPost(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'], $data['description'])) {
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $categoryPost = new CategoryPost();

        $dataSer = $serializer->deserialize($request->getContent(), CategoryPost::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryPost,
            'groups' => ['categoryPosts.create'],
        ]);

        $categoryPost->setName($dataSer->getName());
        $categoryPost->setDescription($dataSer->getDescription());
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($categoryPost);
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryPost, 'json', ['groups' => 'categoryPosts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_del', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function deleteCategoryPost(CategoryPostRepository $categoryPostRepo, int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryPost = $categoryPostRepo->find($id);

        if (!$categoryPost) {
            return $this->json(['error' => 'CategoryPost not found'], 404);
        }

        $entityManager->remove($categoryPost);
        $entityManager->flush();

        return $this->json($categoryPost, 204, [], []);
    }

    #[Route('/{id}', name: '_update', methods: ['PUT'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['name', 'description'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Other category'),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the category...'),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'CategoryPost created successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Other category'),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the category...'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updateCategoryPost(CategoryPostRepository $categoryPostRepo, int $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryPost = $categoryPostRepo->find($id);

        if (!$categoryPost) {
            return $this->json(['error' => 'CategoryPost not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'], $data['description'])) {
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), CategoryPost::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryPost,
            'groups' => ['categoryPosts.create'],
        ]);

        $categoryPost->setName($dataSer->getName());
        $categoryPost->setDescription($dataSer->getDescription());
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($categoryPost);
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryPost, 'json', ['groups' => 'categoryPosts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_updateField', methods: ['PATCH'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['name', 'description'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Other category'),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the category...'),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'CategoryPost patched successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Other category'),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the category...'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updateFieldCategoryPost(CategoryPostRepository $categoryPostRepo, int $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryPost = $categoryPostRepo->find($id);

        if (!$categoryPost) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $dataSer = $serializer->deserialize($request->getContent(), CategoryPost::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryPost,
            'groups' => ['categoryPosts.update'],
        ]);

        if (isset($data['name'])) {
            $categoryPost->setName($dataSer->getName());
            $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['description'])) {
            $categoryPost->setDescription($dataSer->getDescription());
            $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($categoryPost);
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryPost, 'json', ['groups' => 'categoryPosts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }
}
