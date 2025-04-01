<?php

namespace App\Controller\API;

use App\Entity\Product;
use App\Repository\CategoryProductRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/products', name: 'api_products')]
#[OA\Tag(name: 'Product endpoints', description: 'Product operations')]
final class ProductsController extends AbstractController
{
    #[Route('/', name: '_all', methods: ['GET'])]
    public function getProducts(ProductRepository $productRepo, SerializerInterface $serializer): JsonResponse
    {
        $products = $productRepo->findAll();

        $data = $serializer->serialize($products, 'json', ['groups' => ['products.index', 'products.show', 'products.date']]);

        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', name: '_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]
    public function getProduct(ProductRepository $productRepo, int $id): JsonResponse
    {
        $product = $productRepo->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        return $this->json($product, 200, [], [
            'groups' => ['products.index', 'products.show'],
        ]);
    }

    #[Route('/', name: '_create', methods: ['POST'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['title', 'cover', 'images', 'colors', 'sizes', 'stock', 'price', 'description', 'category', 'user'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'My first Product'),
                new OA\Property(property: 'cover', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'images', type: 'array', items: new OA\Items(type: 'string',
                    description: 'An array of image URLs representing the product images.',
                    example: 'https://example.com/image1.jpg'
                )),
                new OA\Property(property: 'colors', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: 'black'
                )),
                new OA\Property(property: 'sizes', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: '42'
                )),
                new OA\Property(property: 'stock', type: 'integer', example: 5),
                new OA\Property(property: 'price', type: 'integer', example: 25.50),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the product...'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Accesories'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Product created successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'title', type: 'string', example: 'My first Product'),
                new OA\Property(property: 'cover', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'images', type: 'array', items: new OA\Items(type: 'string',
                    description: 'An array of image URLs representing the product images.',
                    example: 'https://example.com/image1.jpg'
                )),
                new OA\Property(property: 'colors', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: 'black'
                )),
                new OA\Property(property: 'sizes', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: '42'
                )),
                new OA\Property(property: 'stock', type: 'integer', example: 5),
                new OA\Property(property: 'price', type: 'integer', example: 25.50),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the product...'),
                new OA\Property(property: 'category', type: 'string', example: 'Accesories'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function createProduct(Request $request, UserRepository $userRepo, CategoryProductRepository $catRepo, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }
        
        if (!array_key_exists('title', $data) || !array_key_exists('cover', $data) || !array_key_exists('images', $data) || !array_key_exists('colors', $data) || !array_key_exists('sizes', $data) || !array_key_exists('stock', $data) || !array_key_exists('price', $data) || !array_key_exists('description', $data) || !array_key_exists('category', $data) || !array_key_exists('user', $data)) {
            return $this->json(['error' => 'Fields "title", "cover", "images", "content", "category" and "user" are required.'], 400);
        }

        $product = new Product();

        $dataSer = $serializer->deserialize($request->getContent(), Product::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $product,
            'groups' => ['products.create'],
        ]);

        $product->setTitle($dataSer->getTitle());
        $product->setImages($dataSer->getImages());
        $product->setCover($dataSer->getCover());
        $product->setColors($dataSer->getColors());
        $product->setSizes($dataSer->getSizes());
        $product->setStock($dataSer->getStock());
        $product->setPrice($dataSer->getPrice());
        $product->setDescription($dataSer->getDescription());
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        $category = $catRepo->findOneBy(['name' => $data['category']]);
        $product->setCategory($category);
        $user = $userRepo->findOneBy(['email' => $data['user']]);
        $product->setUser($user);

        $entityManager->persist($product);
        $entityManager->flush();

        $responseData = $serializer->serialize($product, 'json', ['groups' => 'products.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_del', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function deleteProduct(ProductRepository $productRepo, int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $product = $productRepo->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->json($product, 204, [], []);
    }

    #[Route('/{id}', name: '_update', methods: ['PUT'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['title', 'cover', 'images', 'colors', 'sizes', 'stock', 'price', 'description', 'category', 'user'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'My first Product'),
                new OA\Property(property: 'cover', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'images', type: 'array', items: new OA\Items(type: 'string',
                    description: 'An array of image URLs representing the product images.',
                    example: 'https://example.com/image1.jpg'
                )),
                new OA\Property(property: 'colors', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: 'black'
                )),
                new OA\Property(property: 'sizes', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: '42'
                )),
                new OA\Property(property: 'stock', type: 'integer', example: 5),
                new OA\Property(property: 'price', type: 'integer', example: 25.50),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the product...'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Accesories'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Product put successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'title', type: 'string', example: 'My first Product'),
                new OA\Property(property: 'cover', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'images', type: 'array', items: new OA\Items(type: 'string',
                    description: 'An array of image URLs representing the product images.',
                    example: 'https://example.com/image1.jpg'
                )),
                new OA\Property(property: 'colors', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: 'black'
                )),
                new OA\Property(property: 'sizes', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: '42'
                )),
                new OA\Property(property: 'stock', type: 'integer', example: 5),
                new OA\Property(property: 'price', type: 'integer', example: 25.50),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the product...'),
                new OA\Property(property: 'category', type: 'string', example: 'Accesories'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updateProduct(ProductRepository $productRepo, int $id, Request $request, SerializerInterface $serializer, CategoryProductRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $product = $productRepo->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }

        if (!array_key_exists('title', $data) || !array_key_exists('cover', $data) || !array_key_exists('images', $data) || !array_key_exists('colors', $data) || !array_key_exists('sizes', $data) || !array_key_exists('stock', $data) || !array_key_exists('price', $data) || !array_key_exists('description', $data) || !array_key_exists('category', $data) || !array_key_exists('user', $data)) {
            return $this->json(['error' => 'Fields "title", "cover", "images", "content", "category" and "user" are required.'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Product::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $product,
            'groups' => ['products.create'],
        ]);

        $product->setTitle($dataSer->getTitle());
        $product->setImages($dataSer->getImages());
        $product->setCover($dataSer->getCover());
        $product->setColors($dataSer->getColors());
        $product->setSizes($dataSer->getSizes());
        $product->setStock($dataSer->getStock());
        $product->setPrice($dataSer->getPrice());
        $product->setDescription($dataSer->getDescription());
        // $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        $category = $catRepo->findOneBy(['name' => $data['category']]);
        $product->setCategory($category);
        $user = $userRepo->findOneBy(['email' => $data['user']]);
        $product->setUser($user);

        $entityManager->persist($product);
        $entityManager->flush();

        $responseData = $serializer->serialize($product, 'json', ['groups' => 'products.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_updateField', methods: ['PATCH'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['title', 'cover', 'images', 'colors', 'sizes', 'stock', 'price', 'description', 'category', 'user'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'My first Product'),
                new OA\Property(property: 'cover', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'images', type: 'array', items: new OA\Items(type: 'string',
                    description: 'An array of image URLs representing the product images.',
                    example: 'https://example.com/image1.jpg'
                )),
                new OA\Property(property: 'colors', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: 'black'
                )),
                new OA\Property(property: 'sizes', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: '42'
                )),
                new OA\Property(property: 'stock', type: 'integer', example: 5),
                new OA\Property(property: 'price', type: 'integer', example: 25.50),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the product...'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Accesories'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Product patched successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'title', type: 'string', example: 'My first Product'),
                new OA\Property(property: 'cover', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'images', type: 'array', items: new OA\Items(type: 'string',
                    description: 'An array of image URLs representing the product images.',
                    example: 'https://example.com/image1.jpg'
                )),
                new OA\Property(property: 'colors', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: 'black'
                )),
                new OA\Property(property: 'sizes', type: 'array', items: new OA\Items(
                    type: 'string',
                    description: 'An array of colors representing the color of the product.',
                    example: '42'
                )),
                new OA\Property(property: 'stock', type: 'integer', example: 5),
                new OA\Property(property: 'price', type: 'integer', example: 25.50),
                new OA\Property(property: 'description', type: 'string', example: 'The description of the product...'),
                new OA\Property(property: 'category', type: 'string', example: 'Accesories'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updateFieldProduct(ProductRepository $productRepo, int $id, Request $request, SerializerInterface $serializer, CategoryProductRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $product = $productRepo->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Product::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $product,
            'groups' => ['products.update'],
        ]);

        if (array_key_exists('title', $data)) {
            $title = $dataSer->getTitle();
            if ($title === null) {
                return $this->json(['error' => 'The "title" field cannot be null'], 400);
            }
            $product->setTitle($title);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('cover', $data)) {
            $cover = $dataSer->getCover();
            if ($cover === null) {
                return $this->json(['error' => 'The "cover" field cannot be null'], 400);
            }
            $product->setTitle($cover);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('images', $data)) {
            $images = $dataSer->getImages();
            if ($images === null) {
                return $this->json(['error' => 'The "images" field cannot be null'], 400);
            }
            $product->setImages($images);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('colors', $data)) {
            $colors = $dataSer->getColors();
            if ($colors === null) {
                return $this->json(['error' => 'The "colors" field cannot be null'], 400);
            }
            $product->setColors($colors);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('sizes', $data)) {
            $sizes = $dataSer->getSizes();
            if ($sizes === null) {
                return $this->json(['error' => 'The "sizes" field cannot be null'], 400);
            }
            $product->setSizes($sizes);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('stock', $data)) {
            $stock = $dataSer->getStock();
            if ($stock === null) {
                return $this->json(['error' => 'The "stock" field cannot be null'], 400);
            }
            $product->setStock($stock);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('price', $data)) {
            $price = $dataSer->getPrice();
            if ($price === null) {
                return $this->json(['error' => 'The "price" field cannot be null'], 400);
            }
            $product->setPrice($price);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('description', $data)) {
            $description = $dataSer->getDescription();
            if ($description === null) {
                return $this->json(['error' => 'The "description" field cannot be null'], 400);
            }
            $product->setDescription($description);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('category', $data)) {
            $category = $catRepo->findOneBy(['name' => $data['category']]);
            if ($category === null) {
                return $this->json(['error' => 'The "category" field cannot be null'], 400);
            }
            $product->setCategory($category);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('user', $data)) {
            $user = $userRepo->findOneBy(['email' => $data['user']]);
            if ($user === null) {
                return $this->json(['error' => 'The "user" field cannot be null'], 400);
            }
            $product->setUser($user);
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($product);
        $entityManager->flush();

        $responseData = $serializer->serialize($product, 'json', ['groups' => 'products.show']);

        return new JsonResponse($responseData, 201, [], true);
    }
}
