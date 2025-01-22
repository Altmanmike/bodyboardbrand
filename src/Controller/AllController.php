<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\VideoRepository;
use App\Repository\MemberRepository;
use App\Repository\ProductRepository;
use App\Repository\InnovationRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/all', name:'app_all')]
class AllController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(
        PostRepository $postRepo,
        ProductRepository $productRepo,
        MemberRepository $memberRepo,
        VideoRepository $videoRepo,
        InnovationRepository $innovRepo,
    ): Array
    {
        $posts = $postRepo->findAll();
        $products = $productRepo->findAll();
        $members = $memberRepo->findAll();
        $videos = $videoRepo->findAll();
        $innovations = $innovRepo->findAll();
        $data = [$posts, $products, $members, $videos, $innovations];

        return $data;    
    }
}
