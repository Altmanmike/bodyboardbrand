<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\VideoRepository;
use App\Repository\MemberRepository;
use App\Repository\ProductRepository;
use App\Repository\InnovationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class AppController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(SerializerInterface $serializer,
        PostRepository $postRepo,
        ProductRepository $productRepo,
        MemberRepository $memberRepo,
        VideoRepository $videoRepo,
        InnovationRepository $innovRepo,
    ): Response
    {
        $posts = $postRepo->findAll();
        $products = $productRepo->findAll();
        $members = $memberRepo->findAll();
        $videos = $videoRepo->findAll();
        $innovations = $innovRepo->findAll();
        
        $postsJson = $serializer->serialize($posts, 'json', ['groups' => ['posts.index','posts.show','posts.date']]);
        $productsJson = $serializer->serialize($products, 'json', ['groups' => ['products.index','products.show','products.date']]);
        $membersJson = $serializer->serialize($members, 'json', ['groups' => ['members.index','members.show','members.date']]);
        $videosJson = $serializer->serialize($videos, 'json', ['groups' => ['videos.index','videos.show','videos.date']]);
        $innovationsJson = $serializer->serialize($innovations, 'json', ['groups' => ['innovations.index','innovations.show','innovations.date']]);
        
        $data = [
            'posts' => $postsJson, 
            'products' => $productsJson, 
            'members' => $membersJson, 
            'videos' => $videosJson, 
            'innovations' => $innovationsJson
        ];
        
        return $this->render('index.html.twig', [
            'controller_name' => 'AppController',
            'data' => $data
        ]);
    }
}
