<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        // Menu
        yield MenuItem::section('BASE DE DONNEES');
        yield MenuItem::linkToDashboard('Utilisateurs','fas fa-user', User::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Sous catégories','fas fa-list-alt', SousCategorie::class);
        yield MenuItem::linkToCrud('Articles','far fa-newspaper', Article::class);


        // Divider
        yield MenuItem::section('RETOUR AU SITE');
        // Retour accueil
        yield MenuItem::linkToUrl('Retour au site', 'fas fa-home', '/');
    }
}
