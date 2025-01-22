<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InnovationController extends AbstractController
{
    #[Route('/innovation', name: 'app_innovation')]
    public function index(): Response
    {
        return $this->render('innovation/index.html.twig', [
            'controller_name' => 'InnovationController',
        ]);
    }

    /*#[Route('/api/innovations', name: 'api_innovation_all')]
    public function getCollection(): Response
    {
        $innovations = [
            [
                'title' => 'Reinforced Board Stringers', 
                'image' => '../../imgs/innovation/stringers.jpg',
                'description' => 'New stringer technology for improved board flexibility and strength.',
            ],
            [
                'title' => 'Hydrodynamic Fins', 
                'image' => '../../imgs/innovation/fins.jpg',
                'description' => 'Innovative fins design for better water flow and speed.',
            ],
            [
                'title' => 'Eco-Friendly Leash', 
                'image' => '../../imgs/innovation/leash.jpg',
                'description' => 'Sustainable materials to minimize ocean pollution.',
            ],
        ];
        return $this->json($innovations);
    }*/
}
