<?php

namespace App\Controller\API;

use App\Entity\Post;
use App\Entity\CategoryPost;
use App\Repository\CategoryPostRepository;
use OpenApi\Attributes as OA;
use App\Repository\PostRepository;
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

#[Route('/api/posts', name:'api_posts')]
#[OA\Tag(name: "Entity Post Endpoints", description: "Post operations")]
class PostsController extends AbstractController
{
    #[Route('/', name:'_all', methods: ['GET'])]
    #[OA\Response(response: 200, description: 'Successful response', content: new Model(type: Post::class, groups: ['posts.index','posts.show','posts.date']))]    
    public function getPosts(PostRepository $postRepo, SerializerInterface $serializer)
    {
        $posts = $postRepo->findAll();

        $data = $serializer->serialize($posts, 'json', ['groups' => ['posts.index','posts.show','posts.date']]);

        return new JsonResponse($data, 200, [], true); 
    }

    #[Route('/{id}', name:'_one', methods: ['GET'], requirements: ['id' => Requirement::DIGITS])]
    #[OA\Response(response: 200, description: 'Successful response', content: new Model(type: Post::class, groups: ['posts.show']))]
    #[OA\Response(response: 404, description: 'Post not found', content: new Model(type: Post::class, groups: ['posts.show']))]
    public function getPost(PostRepository $postRepo, $id)
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post not found'], 404);
        }

        return $this->json($post, 200, [], [
            'groups' => ['posts.index','posts.show']
        ]);       
    }
    
    #[Route('/', name: '_create', methods: ['POST'])] 
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            required: ["title", "image", "content", "category", "user"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "My first post"),
                new OA\Property(property: "image", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "content", type: "string", example: "This is the content of the post."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Technology")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "bob@aol.com")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Post created successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "title", type: "string", example: "My first post"),
                new OA\Property(property: "image", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "content", type: "string", example: "This is the content of the post."),
                new OA\Property(property: "category", type: "string", example: "Politic"),
                new OA\Property(property: "user", type: "string", example: "mick@aol.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    #[OA\Response(response: 400, description: "Invalid input data")]
    public function createPost(Request $request, UserRepository $userRepo, CategoryPostRepository $catRepo, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['title'], $data['image'], $data['content'], $data['category'], $data['user'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $post = new Post();

        $dataSer = $serializer->deserialize($request->getContent(), Post::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $post,
            'groups' => ['posts.create']
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
    #[OA\Parameter(name: 'id', description: 'Id of the post to delete', in: 'query')]
    #[OA\Response(response: 200, description: 'Post deleted successfully', content: new Model(type: Post::class))]
    #[OA\Response(response: 404, description: 'Post not found', content: new Model(type: Post::class))]
    public function deletePost(PostRepository $postRepo, $id, EntityManagerInterface $entityManager)
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
            type: "object",
            required: ["title", "image", "content", "category", "user"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "My first post"),
                new OA\Property(property: "image", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "content", type: "string", example: "This is the content of the post."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Technology")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "bob@aol.com")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Post put successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "title", type: "string", example: "My first post"),
                new OA\Property(property: "image", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "content", type: "string", example: "This is the content of the post."),
                new OA\Property(property: "category", type: "string", example: "Politic"),
                new OA\Property(property: "user", type: "string", example: "mick@aol.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    #[OA\Response(response: 400, description: "Invalid input data")]
    #[OA\Response(response: 404, description: 'Post not found')]
    public function updatePost(PostRepository $postRepo, $id, Request $request, SerializerInterface $serializer, CategoryPostRepository $catRepo, UserRepository $userRepo, EntityManagerInterface $entityManager)
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['title'], $data['image'], $data['content'], $data['category'], $data['user'])) {            
            return $this->json(['error' => 'Invalid input data'], 400);
        }

        $dataSer = $serializer->deserialize($request->getContent(), Post::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $post,
            'groups' => ['posts.create']
        ]);        
              
        $post->setTitle($dataSer->getTitle());
        $post->setImage($dataSer->getImage());
        $post->setContent($dataSer->getContent());
        //$post->setCreatedAt(new \DateTimeImmutable());
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
            type: "object",
            required: ["title", "image", "content", "category", "user"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "My first post"),
                new OA\Property(property: "image", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "content", type: "string", example: "This is the content of the post."),
                new OA\Property(property: "category", type: "object", required: ["name"], properties: [
                        new OA\Property(property: "name", type: "string", example: "Technology")
                    ]),
                new OA\Property(property: "user", type: "object", required: ["email"], properties: [
                    new OA\Property(property: "email", type: "string", example: "bob@aol.com")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Post patched successfully",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "title", type: "string", example: "My first post"),
                new OA\Property(property: "image", type: "string", example: "https://example.com/image.jpg"),
                new OA\Property(property: "content", type: "string", example: "This is the content of the post."),
                new OA\Property(property: "category", type: "string", example: "Politic"),
                new OA\Property(property: "user", type: "string", example: "mick@aol.fr"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-16T14:30:00Z")
            ]
        )
    )]
    #[OA\Response(response: 400, description: "Invalid input data")]
    #[OA\Response(response: 404, description: 'Post not found')]
    public function updateFieldPost(PostRepository $postRepo, $id, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $post = $postRepo->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $dataSer = $serializer->deserialize($request->getContent(), Post::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $post,
            'groups' => ['posts.create']
        ]);        
           
        if (isset($data['title'])) {
            $post->setTitle($dataSer->getTitle());
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['image'])) {
            $post->setImage($dataSer->getImage());
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['content'])) {
            $post->setContent($dataSer->getContent());
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['category'])) {
            $post->setCategory($dataSer->getCategory());
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        if (isset($data['user'])) {
            $post->setUser($dataSer->getUser());            
            $post->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($post);        
        $entityManager->flush();

        $responseData = $serializer->serialize($post, 'json', ['groups' => 'posts.show']);

        return new JsonResponse($responseData, 201, [], true);
    }  
    
}
