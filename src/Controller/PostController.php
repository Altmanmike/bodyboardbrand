<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    /*#[Route('/api/posts', name: 'api_post_all')]
    public function getCollection(): Response
    {
        $posts = [
            [
                'title' => 'Exploring the Waves',
                'image' => '/build/images/waves.jpg',
                'content' => 'Discover the best spots for bodyboarding this summer.',
                'author' => 'Jane Doe',
                'created_at' => 'November 10, 2024',
            ],
            [
                'title' => 'Top 5 Bodyboard Tricks',
                'image' => '/build/images/tricks.jpg',
                'content' => 'Learn the most exciting tricks to level up your skills.',
                'author' => 'John Smith',
                'created_at' => 'November 12, 2024',
            ],
            [
                'title' => 'Maintaining Your Gear',
                'image' => '/build/images/gear.jpg',
                'content' => 'Tips to ensure your bodyboard and fins last longer.',
                'author' => 'Emily Brown',
                'created_at' => 'November 14, 2024',
            ],
        ];
        return $this->json($posts);
    }*/
}
