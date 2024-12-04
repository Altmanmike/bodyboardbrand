<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $repo): Response
    {
        // Récupération d'un utilisateur avec informations (array)
        $u = $this->getUser()->getUserIdentifier();        
        $user = $repo->findByEmail($u);

        // Si l'utilisateur est un admin
        if (in_array('ROLE_ADMIN', $user[0]->getRoles())) {
            return $this->redirectToRoute('app_admin_dash');
        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
             'user' => $user[0]
        ]);
    }

    #[Route('/admin_dash', name: 'app_admin_dash')]
    public function adminDash(): Response
    {
        return $this->render('user/admin_dash.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user_dash', name: 'app_user_dash')]
    public function userDash(): Response
    {
        return $this->render('user/user_dash.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user_cart', name: 'app_user_cart')]
    public function userCart(): Response
    {
        return $this->render('user/cart.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
