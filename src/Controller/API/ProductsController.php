<?php

namespace App\Controller\API;

use App\Entity\Product;
use App\Repository\CategoryProductRepository;
use OpenApi\Attributes as OA;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/api/products', name:'api_products')]
#[OA\Tag(name: "Product endpoints", description: "Product operations")]
class ProductsController extends AbstractController
{
    #[Route('/', name:'_all', methods: ['GET'])]   
    public function getProducts(ProductRepository $productRepo, SerializerInterface $serializer): JsonResponse
    {
        $products = $productRepo->findAll();

        $data = $serializer->serialize($products, 'json', ['groups' => ['products.index','products.show','products.date']]);

        return new JsonResponse($data, 200, [], true); 
    }

    #[Route('/{id}', name:'_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]  
    public function getProduct(ProductRepository $productRepo, $id): JsonResponse
    {
        $product = $productRepo->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        return $this->json($product, 200, [], [
            'groups' => ['products.index','products.show']
        ]);       
    }
    
    #[Route('/', name: '_create', methods: ['POST'])] 
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            required: ["title", "cover", "images", "colors", "sizes", "stock", "price", "description", "category", "user"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "My first Product"),
                new OA\Property(property: "cover", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "images", type: "array", items:
                    new OA\Items(type: "string",                        
                            description: "An array of image URLs representing the product images.",
                            example: "https://example.com/image1.jpg"
                        )),                        
                new OA\Property(property: "colors", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "black"
                        )),                
                new OA\Property(property: "sizes", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "42"
                        )),
                new OA\Property(property: "stock", type: "integer", example: 5),
                new OA\Property(property: "price", type: "integer", example: 25.50),
                new OA\Property(property: "description", type: "string", example: "The description of the product..."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Accesories")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "hgautier@hotmail.fr")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Product created successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "title", type: "string", example: "My first Product"),
                new OA\Property(property: "cover", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "images", type: "array", items:
                    new OA\Items(type: "string",                        
                            description: "An array of image URLs representing the product images.",
                            example: "https://example.com/image1.jpg"
                        )),                        
                new OA\Property(property: "colors", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "black"
                        )),                
                new OA\Property(property: "sizes", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "42"
                        )),                          
                new OA\Property(property: "stock", type: "integer", example: 5),
                new OA\Property(property: "price", type: "integer", example: 25.50),
                new OA\Property(property: "description", type: "string", example: "The description of the product..."),                
                new OA\Property(property: "category", type: "string", example: "Accesories"),
                new OA\Property(property: "user", type: "string", example: "hgautier@hotmail.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    public function createProduct(Request $request, UserRepository $userRepo, CategoryProductRepository $catRepo, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['title'], $data['cover'], $data['images'], $data['colors'], $data['sizes'], $data['stock'], $data['price'], $data['description'], $data['category'], $data['user'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $product = new Product();

        $dataSer = $serializer->deserialize($request->getContent(), Product::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $product,
            'groups' => ['products.create']
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
    public function deleteProduct(ProductRepository $productRepo, $id, EntityManagerInterface $entityManager): JsonResponse
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
            type: "object",
            required: ["title", "cover", "images", "colors", "sizes", "stock", "price", "description", "category", "user"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "My first Product"),
                new OA\Property(property: "cover", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "images", type: "array", items:
                    new OA\Items(type: "string",                        
                            description: "An array of image URLs representing the product images.",
                            example: "https://example.com/image1.jpg"
                        )),                        
                new OA\Property(property: "colors", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "black"
                        )),                
                new OA\Property(property: "sizes", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "42"
                        )),
                new OA\Property(property: "stock", type: "integer", example: 5),
                new OA\Property(property: "price", type: "integer", example: 25.50),
                new OA\Property(property: "description", type: "string", example: "The description of the product..."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Accesories")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "hgautier@hotmail.fr")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Product put successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "title", type: "string", example: "My first Product"),
                new OA\Property(property: "cover", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "images", type: "array", items:
                    new OA\Items(type: "string",                        
                            description: "An array of image URLs representing the product images.",
                            example: "https://example.com/image1.jpg"
                        )),                        
                new OA\Property(property: "colors", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "black"
                        )),                
                new OA\Property(property: "sizes", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "42"
                        )),                          
                new OA\Property(property: "stock", type: "integer", example: 5),
                new OA\Property(property: "price", type: "integer", example: 25.50),
                new OA\Property(property: "description", type: "string", example: "The description of the product..."),                
                new OA\Property(property: "category", type: "string", example: "Accesories"),
                new OA\Property(property: "user", type: "string", example: "hgautier@hotmail.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    public function updateProduct(ProductRepository $productRepo, $id, Request $request, SerializerInterface $serializer, CategoryProductRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $product = $productRepo->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }
        
        $data = json_decode($request->getContent(), true);
        if (!isset($data['title'], $data['cover'], $data['images'], $data['colors'], $data['sizes'], $data['stock'], $data['price'], $data['description'], $data['user'], $data['category'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Product::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $product,
            'groups' => ['products.create']
        ]);        
              
        $product->setTitle($dataSer->getTitle());
        $product->setImages($dataSer->getImages());
        $product->setCover($dataSer->getCover());
        $product->setColors($dataSer->getColors());
        $product->setSizes($dataSer->getSizes());
        $product->setStock($dataSer->getStock());
        $product->setPrice($dataSer->getPrice());
        $product->setDescription($dataSer->getDescription());
        //$product->setCreatedAt(new \DateTimeImmutable());
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
            type: "object",
            required: ["title", "cover", "images", "colors", "sizes", "stock", "price", "description", "category", "user"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "My first Product"),
                new OA\Property(property: "cover", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "images", type: "array", items:
                    new OA\Items(type: "string",                        
                            description: "An array of image URLs representing the product images.",
                            example: "https://example.com/image1.jpg"
                        )),                        
                new OA\Property(property: "colors", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "black"
                        )),                
                new OA\Property(property: "sizes", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "42"
                        )),
                new OA\Property(property: "stock", type: "integer", example: 5),
                new OA\Property(property: "price", type: "integer", example: 25.50),
                new OA\Property(property: "description", type: "string", example: "The description of the product..."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Accesories")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "hgautier@hotmail.fr")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Product patched successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "title", type: "string", example: "My first Product"),
                new OA\Property(property: "cover", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "images", type: "array", items:
                    new OA\Items(type: "string",                        
                            description: "An array of image URLs representing the product images.",
                            example: "https://example.com/image1.jpg"
                        )),                        
                new OA\Property(property: "colors", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "black"
                        )),                
                new OA\Property(property: "sizes", type: "array", items:
                    new OA\Items(
                            type: "string",                            
                            description: "An array of colors representing the color of the product.",
                            example: "42"
                        )),                          
                new OA\Property(property: "stock", type: "integer", example: 5),
                new OA\Property(property: "price", type: "integer", example: 25.50),
                new OA\Property(property: "description", type: "string", example: "The description of the product..."),                
                new OA\Property(property: "category", type: "string", example: "Accesories"),
                new OA\Property(property: "user", type: "string", example: "hgautier@hotmail.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    public function updateFieldProduct(ProductRepository $productRepo, $id, Request $request, SerializerInterface $serializer, CategoryProductRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $product = $productRepo->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $dataSer = $serializer->deserialize($request->getContent(), Product::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $product,
            'groups' => ['products.update']
        ]);        
          
        if (isset($data['title'])) {
            $product->setTitle($dataSer->getTitle());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['cover'])) {
            $product->setCover($dataSer->getCover());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['images'])) {
            $product->setImages($dataSer->getImages());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['colors'])) {
            $product->setColors($dataSer->getColors());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['sizes'])) {
            $product->setSizes($dataSer->getSizes());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['stock'])) {
            $product->setStock($dataSer->getStock());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['price'])) {
            $product->setPrice($dataSer->getPrice());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['description'])) {
            $product->setDescription($dataSer->getDescription());
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['category'])) {
            $category = $catRepo->findOneBy(['name' => $data['category']]);        
            $product->setCategory($category); 
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['user'])) {
            $user = $userRepo->findOneBy(['email' => $data['user']]);
            $product->setUser($user);            
            $product->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($product);        
        $entityManager->flush();

        $responseData = $serializer->serialize($product, 'json', ['groups' => 'products.show']);

        return new JsonResponse($responseData, 201, [], true);
    }  
    
}
