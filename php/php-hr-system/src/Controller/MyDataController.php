<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\EngagementRepository;
use Symfony\Component\Security\Core\Security;

class MyDataController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    /**
     * @Route("/my/data", name="my_data")
     */
    public function index(UserRepository $userRepository, EngagementRepository $engagementRepository)
    {
        // returns User object or null if not authenticated
        $userName = $this->security->getUser()->getUsername();

        $user = $userRepository->findOneBy(['username'=>$userName]);

        $my_engagement = $engagementRepository->findOneBy(['Person'=>$user->getPersonalData()]);

        return $this->render('my_data/index.html.twig', [
            'personal_data' => $user->getPersonalData(),
            'my_engagement' => $my_engagement
        ]);
    }
}
