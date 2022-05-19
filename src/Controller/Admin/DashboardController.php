<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Controller\Admin\PostCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator) {}

    #[Route('%app.admin_path%', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->redirect(
            $this->adminUrlGenerator->setController(PostCrudController::class)
                ->generateUrl()
        );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bloggy');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section();
        yield MenuItem::linkToUrl('Visit public website', 'fa fa-home', '/');

        yield MenuItem::section('Blog');
        yield MenuItem::linkToCrud('Posts', 'fa fa-file-text', Post::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
    }
}
