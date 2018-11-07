<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\MembershipRepository;
use App\Repository\UserRepository;
use App\Repository\UnitsRepository;

class MyUnitsController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    /**
     * @Route("/my/units", name="my_units")
     */
    public function index(MembershipRepository $membershipRepository, UserRepository $userRepository, UnitsRepository $unitsRepository)
    {
        $user = $userRepository->findOneBy(['username'=>$this->security->getUser()->getUsername()]);
        $units = $unitsRepository->findBy(['Boss'=>$user->getPersonalData()]);
        $ret = array();
        foreach ($units as $key => $unit){
            if (!($unit === null)){
                $members = $membershipRepository->findBy(['Unit'=>$unit]);
                $ret[$key] = array('unit'=>$unit,'members'=>$members);
            }
        }

        return $this->render('my_units/index.html.twig', [
            'all' => $ret,
        ]);
    }
}
