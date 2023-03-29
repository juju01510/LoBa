<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Commentary;
use App\Entity\Introduction;
use App\Entity\Logo;
use App\Entity\Newsletter\Users;
use App\Entity\Partners;
use App\Entity\Post;
use App\Entity\Project;
use App\Entity\Section;
use App\Entity\Translation;
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
                MenuItem::linkToRoute('Profile', 'fa fa-user', 'app_user_profile', ['id' => $this->getUser()->getId()]),
                MenuItem::linkToUrl('Sign out', 'fa fa-sign-out', $this->generateUrl('app_logout'))
            ]);
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToUrl('Website', 'fa fa-solid fa-globe', $this->generateUrl('app_home'));

        yield MenuItem::section('', '');

        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Messages', 'fa fa-envelope', Commentary::class);
        yield MenuItem::linkToCrud('Subscribers', 'fa fa-envelope', Users::class);

        yield MenuItem::section('Naviguation', 'fa fa-bars');
        yield MenuItem::linkToCrud('Logo', ' ', Logo::class);

//        yield MenuItem::subMenu('Navigation', 'fa fa-home')->setSubItems([
//            MenuItem::linkToCrud('Logo', '',Logo::class)->setAction(Crud::PAGE_INDEX),
//        ]);

        yield MenuItem::section('Homepage', 'fa fa-home');
        yield MenuItem::subMenu('Introduction', ' ')->setSubItems([
            MenuItem::linkToCrud('Main', '',Introduction::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('French', '',Translation::class)->setAction(Crud::PAGE_INDEX),
        ]);
        yield MenuItem::subMenu('Sections', ' ')->setSubItems([
            MenuItem::linkToCrud('Main', '',Section::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('French', '',Translation::class)->setAction(Crud::PAGE_INDEX),
        ]);

//        yield MenuItem::subMenu('Homepage', 'fa fa-home')->setSubItems([
//            MenuItem::linkToCrud('Introduction', '',Introduction::class)->setAction(Crud::PAGE_INDEX),
//            MenuItem::linkToCrud('Sections', '',Section::class)->setAction(Crud::PAGE_INDEX),
//        ]);

        yield MenuItem::section('Project page', 'fa fa-list-check');
        yield MenuItem::subMenu('Projects', ' ')->setSubItems([
            MenuItem::linkToCrud('Main', '',Project::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('French', '',Translation::class)->setAction(Crud::PAGE_INDEX),
        ]);

        yield MenuItem::section('', '');

        yield MenuItem::subMenu('News page', 'fa fa-newspaper-o')->setSubItems([
            MenuItem::linkToCrud('News', '',Post::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Categories', '',Category::class)->setAction(Crud::PAGE_INDEX),
        ]);

        yield MenuItem::subMenu('Partners page', 'fa fa-handshake-o')->setSubItems([
            MenuItem::linkToCrud('Partners', '',Partners::class)->setAction(Crud::PAGE_INDEX),
        ]);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
