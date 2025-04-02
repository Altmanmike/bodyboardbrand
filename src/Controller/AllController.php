<?php

namespace App\Controller;

use App\Repository\InnovationRepository;
use App\Repository\MemberRepository;
use App\Repository\PostRepository;
use App\Repository\ProductRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/all', name: 'app_all')]
final class AllController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(
        PostRepository $postRepo,
        ProductRepository $productRepo,
        MemberRepository $memberRepo,
        VideoRepository $videoRepo,
        InnovationRepository $innovRepo,
    ): array {
        $posts = $postRepo->findAll();
        $products = $productRepo->findAll();
        $members = $memberRepo->findAll();
        $videos = $videoRepo->findAll();
        $innovations = $innovRepo->findAll();
        $data = [$posts, $products, $members, $videos, $innovations];

        return $data;
    }
}
