<?php

namespace App\Controller\API;

use App\Entity\Post;
use App\Repository\CategoryPostRepository;
use App\Repository\PostRepository;
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

#[Route('/api/posts', name: 'api_posts')]
#[OA\Tag(name: 'Post endpoints', description: 'Post operations')]
final class PostsController extends AbstractController
{
    #[Route('/', name: '_all', methods: ['GET'])]
    public function getPosts(PostRepository $postRepo, SerializerInterface $serializer): JsonResponse
    {
        $posts = $postRepo->findAll();

        $data = $serializer->serialize($posts, 'json', ['groups' => ['posts.index', 'posts.show', 'posts.date']]);

        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', name: '_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]
    public function getPost(PostRepository $postRepo, int $id): JsonResponse
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post not found'], 404);
        }

        return $this->json($post, 200, [], [
            'groups' => ['posts.index', 'posts.show'],
        ]);
    }

    #[Route('/', name: '_create', methods: ['POST'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['title', 'image', 'content', 'category', 'user'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'My first post'),
                new OA\Property(property: 'image', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'content', type: 'string', example: 'This is the content of the post.'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Gears'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Post created successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'title', type: 'string', example: 'My first post'),
                new OA\Property(property: 'image', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'content', type: 'string', example: 'This is the content of the post.'),
                new OA\Property(property: 'category', type: 'string', example: 'Gears'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function createPost(Request $request, UserRepository $userRepo, CategoryPostRepository $catRepo, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }
        
        if (!array_key_exists('title', $data) || !array_key_exists('image', $data) || !array_key_exists('content', $data) || !array_key_exists('category', $data) || !array_key_exists('user', $data)) {
            return $this->json(['error' => 'Fields "title", "image", "content", "category" and "user" are required.'], 400);
        }

        $post = new Post();

        $dataSer = $serializer->deserialize($request->getContent(), Post::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $post,
            'groups' => ['posts.create'],
        ]);

        $post->setTitle($dataSer->getTitle());
        $post->setImage($dataSer->getImage());
        $post->setContent($dataSer->getContent());
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $category = $catRepo->findOneBy(['name' => $data['category']]);
        $post->setCategory($category);
        $user = $userRepo->findOneBy(['email' => $data['user']]);
        $post->setUser($user);

        $entityManager->persist($post);
        $entityManager->flush();

        $responseData = $serializer->serialize($post, 'json', ['groups' => 'posts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_del', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function deletePost(PostRepository $postRepo, int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post not found'], 404);
        }

        $entityManager->remove($post);
        $entityManager->flush();

        return $this->json($post, 204, [], []);
    }

    #[Route('/{id}', name: '_update', methods: ['PUT'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['title', 'image', 'content', 'category', 'user'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'My first post'),
                new OA\Property(property: 'image', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'content', type: 'string', example: 'This is the content of the post.'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Gears'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Post put successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'title', type: 'string', example: 'My first post'),
                new OA\Property(property: 'image', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'content', type: 'string', example: 'This is the content of the post.'),
                new OA\Property(property: 'category', type: 'string', example: 'Gears'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updatePost(PostRepository $postRepo, int $id, Request $request, SerializerInterface $serializer, CategoryPostRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }

        if (!array_key_exists('title', $data) || !array_key_exists('image', $data) || !array_key_exists('content', $data) || !array_key_exists('category', $data) || !array_key_exists('user', $data)) {
            return $this->json(['error' => 'Fields "title", "image", "content", "category" and "user" are required.'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Post::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $post,
            'groups' => ['posts.update'],
        ]);

        $post->setTitle($dataSer->getTitle());
        $post->setImage($dataSer->getImage());
        $post->setContent($dataSer->getContent());
        // $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $category = $catRepo->findOneBy(['name' => $data['category']]);
        $post->setCategory($category);
        $user = $userRepo->findOneBy(['email' => $data['user']]);
        $post->setUser($user);

        $entityManager->persist($post);
        $entityManager->flush();

        $responseData = $serializer->serialize($post, 'json', ['groups' => 'posts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }

    #[Route('/{id}', name: '_updateField', methods: ['PATCH'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            required: ['title', 'image', 'content', 'category', 'user'],
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'My first post'),
                new OA\Property(property: 'image', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'content', type: 'string', example: 'This is the content of the post.'),
                new OA\Property(property: 'category', type: 'object', required: ['name'], properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Gears'),
                ]),
                new OA\Property(property: 'user', type: 'object', required: ['email'], properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'hgautier@hotmail.fr'),
                ]),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Post patched successfully',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer', example: 1),
                new OA\Property(property: 'title', type: 'string', example: 'My first post'),
                new OA\Property(property: 'image', type: 'string', example: 'https://example.com/image.jpg'),
                new OA\Property(property: 'content', type: 'string', example: 'This is the content of the post.'),
                new OA\Property(property: 'category', type: 'string', example: 'Gears'),
                new OA\Property(property: 'user', type: 'string', example: 'hgautier@hotmail.fr'),
                new OA\Property(property: 'createdAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
                new OA\Property(property: 'updatedAt', type: 'string', format: 'date-time', example: '2025-01-16T14:30:00Z'),
            ]
        )
    )]
    public function updateFieldPost(PostRepository $postRepo, int $id, Request $request, SerializerInterface $serializer, CategoryPostRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager): JsonResponse
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Post::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $post,
            'groups' => ['posts.update'],
        ]);

        if (array_key_exists('title', $data)) {
            $title = $dataSer->getTitle();
            if ($title === null) {
                return $this->json(['error' => 'The "title" field cannot be null'], 400);
            }
            $post->setTitle($title);
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('image', $data)) {
            $image = $dataSer->getImage();
            if ($image === null) {
                return $this->json(['error' => 'The "image" field cannot be null'], 400);
            }
            $post->setTitle($title);
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('content', $data)) {
            $content = $dataSer->getContent();
            if ($content === null) {
                return $this->json(['error' => 'The "content" field cannot be null'], 400);
            }
            $post->setContent($content);
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('category', $data)) {
            $category = $catRepo->findOneBy(['name' => $data['category']]);
            if ($category === null) {
                return $this->json(['error' => 'The "category" field cannot be null'], 400);
            }
            $post->setCategory($category);
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (array_key_exists('user', $data)) {
            $user = $userRepo->findOneBy(['email' => $data['user']]);
            if ($user === null) {
                return $this->json(['error' => 'The "user" field cannot be null'], 400);
            }
            $post->setUser($user);
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($post);
        $entityManager->flush();

        $responseData = $serializer->serialize($post, 'json', ['groups' => 'posts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }
}
