<?php

namespace App\Controller\API;

use App\Entity\CategoryProduct;
use App\Repository\CategoryProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/categoryProducts', name: 'api_categoryProducts')]
#[OA\Tag(name: 'CategoryProducts endpoints', description: 'CategoryProducts operations')]
final class CategoryProductsController extends AbstractController
{
    #[Route('/', name: '_all', methods: ['GET'])]
    public function getcategoryProducts(CategoryProductRepository $categoryProductRepo, SerializerInterface $serializer): JsonResponse
    {
        $categoryProducts = $categoryProductRepo->findAll();

        $data = $serializer->serialize($categoryProducts, 'json', ['groups' => ['categoryProducts.index', 'categoryProducts.show', 'categoryProducts.date']]);

        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', name: '_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]
    public function getCategoryProduct(CategoryProductRepository $categoryProductRepo, int $id): JsonResponse
    {
        $categoryProduct = $categoryProductRepo->find($id);

        if (!$categoryProduct) {
            return $this->json(['error' => 'CategoryProduct not found'], 404);
        }

        return $this->json($categoryProduct, 200, [], [
            'groups' => ['categoryProducts.index', 'categoryProducts.show'],
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
        description: 'CategoryProduct created successfully',
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
    public function createCategoryProduct(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'], $data['description'])) {
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $categoryProduct = new CategoryProduct();

        $dataSer = $serializer->deserialize($request->getContent(), CategoryProduct::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryProduct,
            'groups' => ['categoryProducts.create'],
        ]);

        $categoryProduct->setName($dataSer->getName());
        $categoryProduct->setDescription($dataSer->getDescription());
        $categoryProduct->setCreatedAt(new \DateTimeImmutable());
        $categoryProduct->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($categoryProduct);
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryProduct, 'json', ['groups' => 'categoryProducts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_del', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function deleteCategoryProduct(CategoryProductRepository $categoryProductRepo, int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryProduct = $categoryProductRepo->find($id);

        if (!$categoryProduct) {
            return $this->json(['error' => 'CategoryProduct not found'], 404);
        }

        $entityManager->remove($categoryProduct);
        $entityManager->flush();

        return $this->json($categoryProduct, 204, [], []);
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
        description: 'CategoryProduct created successfully',
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
    public function updateCategoryProduct(CategoryProductRepository $categoryProductRepo, int $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryProduct = $categoryProductRepo->find($id);

        if (!$categoryProduct) {
            return $this->json(['error' => 'CategoryProduct not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'], $data['description'])) {
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), CategoryProduct::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryProduct,
            'groups' => ['categoryProducts.create'],
        ]);

        $categoryProduct->setName($dataSer->getName());
        $categoryProduct->setDescription($dataSer->getDescription());
        $categoryProduct->setCreatedAt(new \DateTimeImmutable());
        $categoryProduct->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($categoryProduct);
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryProduct, 'json', ['groups' => 'categoryProducts.show']);

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
        description: 'CategoryProduct patched successfully',
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
    public function updateFieldCategoryProduct(CategoryProductRepository $categoryProductRepo, int $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryProduct = $categoryProductRepo->find($id);

        if (!$categoryProduct) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $dataSer = $serializer->deserialize($request->getContent(), CategoryProduct::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $categoryProduct,
            'groups' => ['categoryProducts.update'],
        ]);

        if (isset($data['name'])) {
            $categoryProduct->setName($dataSer->getName());
            $categoryProduct->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['description'])) {
            $categoryProduct->setDescription($dataSer->getDescription());
            $categoryProduct->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($categoryProduct);
        $entityManager->flush();

        $responseData = $serializer->serialize($categoryProduct, 'json', ['groups' => 'categoryProducts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }
}
