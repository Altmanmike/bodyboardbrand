<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VideoController extends AbstractController
{
    #[Route('/video', name: 'app_video')]
    public function index(): Response
    {
        return $this->render('video/index.html.twig', [
            'controller_name' => 'VideoController',
        ]);
    }

    #[Route('/api/videos', name: 'api_video_all')]
    public function getCollection(): Response
    {
        $videos = [
            [
                'videoId' => 'ZeivXGDX6Bk', // Remplacez par un ID de vidéo YouTube valide 
                'title' => 'Another Team Highlights',
                'description' => 'Best moments from the K&Z team in 2024 competitions.',
            ],
            [
                'videoId' => 'S6Twm_oofew', 
                'title' => 'How to Master Aerial Tricks',
                'description' => 'Step-by-step tutorial by our pro riders.',
            ],
            [
                'videoId' => '--OREA5IU5s',
                'title' => 'Junior Rider Training Day',
                'description' => 'A day in the life of our junior riders.',
            ],
        ];
        return $this->json($videos);
    }
}
