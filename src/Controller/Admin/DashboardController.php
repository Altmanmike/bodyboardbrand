<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Member;
use App\Entity\Product;
use App\Entity\Innovation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    { 
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BodyboardBrand')
            ->setTitle('<div style="text-align:center;"><img src="/assets/logo.png" alt="logo" class="logo-image" style="width:150px;"/><span class="text-small">Bodyboards</span></div>');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Posts', 'fas fa-pencil-alt', Post::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-shopping-cart', Product::class);
        yield MenuItem::linkToCrud('Innovations','fas fa-lightbulb', Innovation::class); 
        yield MenuItem::linkToCrud('Members','fas fa-users', Member::class); 
        yield MenuItem::linkToCrud('Teams','fas fa-people-group', Team::class);
        yield MenuItem::linkToCrud('Videos','fa-brands fa-youtube', Video::class);
    }
}
