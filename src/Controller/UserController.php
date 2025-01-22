<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /*#[Route('/api/users', name: 'api_user_all')]
    public function getCollection(): Response
    {
        $users = [
            [
                'email' => 'altman_mike@yahoo.fr', 
                'roles' => '["ROLE_ADMIN"]',
                'firstname' => 'Michael',
                'lastname' => 'ALTMAN',
                'phone' => '0781570127',
                'city' => 'Lyon',
                'zipcode' => '69003',
                'location' => '10 rue sans soucis',
                'country' => 'france',
                'department' => '',
                'region' => '',
                'created_at' => 'gffghf',
                'last_login_at' => 'fghfgh',
            ],
            [
                'email' => 'pguillaume@fontaine.com', 
                'roles' => '["ROLE_USER"]',
                'firstname' => 'zerzerzer',
                'lastname' => 'zerzer',
                'phone' => '15784589',
                'city' => 'Lyon',
                'zipcode' => '69003',
                'location' => 'fghfghfg hfhgfh',
                'country' => '',
                'department' => '',
                'region' => '',
                'created_at' => 'fsfsdf',
                'last_login_at' => 'sdfsdf',
            ],
            
        ];
        return $this->json($users);
    }*/

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
