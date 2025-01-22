<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController'
        ]);
    }

    /*#[Route('/api/posts', name: 'api_post_all')]
    public function getCollection(): Response
    {
        $posts = [
            [
                'title' => 'Exploring the Waves', 
                'image' => '../../imgs/posts/waves.jpg',
                'content' => 'Discover the best spots for bodyboarding this summer.',
                'author' => 'Jane Doe',
                'created_at' => 'November 10, 2024',
            ],
            [
                'title' => 'Top 5 Bodyboard Tricks', 
                'image' => '../../imgs/posts/tricks.jpg',
                'content' => 'Learn the most exciting tricks to level up your skills.',
                'author' => 'John Smith',
                'created_at' => 'November 12, 2024',
            ],
            [
                'title' => 'Maintaining Your Gear', 
                'image' => '../../imgs/posts/gear.jpg',
                'content' => 'Tips to ensure your bodyboard and fins last longer.',
                'author' => 'Emily Brown',
                'created_at' => 'November 14, 2024',
            ],
        ];
        return $this->json($posts);
    }*/
}
