<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(UserRepository $userRepository, EntityManagerInterface $em): Response
    {
        // $user = new User;
        // $user->setName('New User');
        // $user->setEmail('newuser@gmail.com');
        // $user->setPassword('$2y$13$VOV6Zs0DFNHSmU8Mk7DCwuHRe//dgvKaShMMKguZq9.zZVG2A6Ate');

        // $userRepository->add($user);

        $user = $userRepository->findOneBy(['name' => 'New User']);

        $user->setName('Nouvel Utilisateur');

        $em->flush();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DemoController.php',
        ]);
    }
}
