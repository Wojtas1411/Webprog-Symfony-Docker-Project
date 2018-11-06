<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\PersonalDataRepository;
use App\Repository\UserRepository;

class StartController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }
    /**
     * @Route("/start", name="start")
     */
    public function index(UserRepository $userRepository)
    {
        $userName = $this->security->getUser()->getUsername();


        if($userRepository->findOneBy(['username' => $userName])->getPersonalData() === null){
            $render_string = "No information provided";
        }
        else {
            $render_string = $userRepository->findOneBy(['username' => $userName])->getPersonalData()->getFamilyName()." ".
                $userRepository->findOneBy(['username' => $userName])->getPersonalData()->getFirstName();
        }

        if($userName == "admin"){
            $render_string = "Admin";
        }

        return $this->render('start/index.html.twig', [
            'user_name' => $render_string,
        ]);
    }
}
