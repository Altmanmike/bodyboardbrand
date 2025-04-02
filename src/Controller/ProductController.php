<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /*#[Route('/api/products', name: 'api_product_all')]
    public function getCollection(): Response
    {
        $products = [
            [
                'title' => 'Board Alpha',
                'cover' => '/build/images/kz-board-01.png',
                'description' => '',
                'images' => '',
                'sizes' => '[\'40\', \'41\', \'42\', \'43\', \'44\']',
                'stock' => '',
                'colors' => '',
                'price' => '',
                'created_at' => '',
            ],
            [
                'title' => 'Board Omega',
                'cover' => '/build/images/kz-board-02.png',
                'description' => '',
                'images' => '',
                'sizes' => '[\'40\', \'41\', \'42\', \'43\', \'44\']',
                'stock' => '',
                'colors' => '',
                'price' => '',
                'created_at' => '',
            ],

        ];
        return $this->json($products);
    }*/
}
