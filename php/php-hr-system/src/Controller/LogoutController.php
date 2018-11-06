<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    /**
     * @Route("/logout", name="logout")
     */
    public function index()
    {
        return $this->render('logout/index.html.twig', [
            'controller_name' => 'LogoutController',
        ]);
    }
}
