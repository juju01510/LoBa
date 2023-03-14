<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Introduction;
use App\Entity\Post;
use App\Entity\Project;
use App\Entity\Section;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

//        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
//         return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Loba Admin');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setMenuItems([
//                MenuItem::linkToUrl('Profile','fa fa-user', $this->generateUrl())
                MenuItem::linkToUrl('Sign out', 'fa fa-sign-out', $this->generateUrl('app_logout'))
            ]);
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToUrl('Website', 'fa fa-home', $this->generateUrl('app_home'));
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);

        yield MenuItem::section('Homepage', 'fa fa-home');
        yield MenuItem::linkToCrud('Introduction', 'fas fa-list', Introduction::class);
        yield MenuItem::linkToCrud('Sections', 'fas fa-list', Section::class);


        yield MenuItem::section('Project page', 'fa fa-book');
        yield MenuItem::linkToCrud('Projects', 'fas fa-list', Project::class);

        yield MenuItem::section('Blog page', 'fa fa-blog ');
        yield MenuItem::linkToCrud('Posts', 'fas fa-list', Post::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
