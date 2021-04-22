<?php

namespace App\Controller\Admin;

use App\Entity\Goal;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Exercise;
use App\Entity\Progress;
use App\Entity\FitnessRoom;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
       // rediriger vers un contrôleur CRUD
       $routeBuilder = $this->get(AdminUrlGenerator::class);

       return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());

       // vous pouvez également rediriger vers différentes pages en fonction de l'utilisateur actuel
    //    if ('jane' === $this->getUser()->getUsername()) {
    //        return $this->redirect('...');
    //    }

       // vous pouvez également rendre un modèle pour afficher un tableau de bord approprié
       // (astuce: c'est plus facile si votre modèle s'étend de @ EasyAdmin / page / content.html.twig)
    //    return $this->render('un / chemin / mon-tableau de bord.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('O NE RM');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Entités');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('User', 'fa fa-list', User::class);
        yield MenuItem::linkToCrud('Exercise', 'fas fa-list', Exercise::class);
        yield MenuItem::linkToCrud('FitnessRoom', 'fas fa-list', FitnessRoom::class);
        yield MenuItem::linkToCrud('Progress', 'fas fa-list', Progress::class);
        yield MenuItem::linkToCrud('Goal', 'fas fa-list', Goal::class);
        yield MenuItem::linkToCrud('Comment', 'fas fa-list', Comment::class);

        
    }
    
}
