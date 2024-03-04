<?php

namespace App\Controller\Admin;

use App\Entity\Allergie;
use App\Entity\Category;
use App\Entity\Horaire;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\NombreDeConvive;
use App\Entity\Plat;
use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ReservationType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/api/login/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('ROLE_ADMIN' === $this->getUser()->getRoles()) {

            
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Antique');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Catégories de plats', 'fa-solid fa-list', Category::class);
        yield MenuItem::linkToCrud('Galerie', 'fa-solid fa-image', Image::class);
        yield MenuItem::linkToCrud('Carte', 'fa-solid fa-bowl-food', Plat::class);
        yield MenuItem::linkToCrud('Menus', 'fa-solid fa-bars', Menu::class);
        yield MenuItem::linkToCrud('Réservation', 'fa-solid fa-wine-glass-empty', Reservation::class);
        yield MenuItem::linkToCrud('Heure d´ouvertures', 'fa-solid fa-clock', Horaire::class);
        yield MenuItem::linkToCrud('Nombre de places', 'fa-solid fa-people-roof', NombreDeConvive::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);

        return [
            // ...
            MenuItem::linkToLogout('Logout', 'fa fa-exit'),
        ];
    }

   
}
