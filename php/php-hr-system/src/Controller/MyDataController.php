<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\EngagementRepository;
use Symfony\Component\Security\Core\Security;
use App\Entity\TemporaryPersonalData;
use Psr\Log\LoggerInterface;

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

    /**
     * @Route("/my/data/temp/edit", name="my_data_temp_edit")
     */
    public function createTemporaryRequest(UserRepository $userRepository, LoggerInterface $logger){
        $userName = $this->security->getUser()->getUsername();

        $user = $userRepository->findOneBy(['username'=>$userName]);

        $temp_user = new TemporaryPersonalData();

        $temp_user->setTimestamp(new \DateTime('now'));
        $temp_user->setUserID($userName);
        $temp_user->setFamilyName($user->getPersonalData()->getFamilyName());
        $temp_user->setFirstName($user->getPersonalData()->getFirstName());
        $temp_user->setBirthDate($user->getPersonalData()->getBirthDate());
        $temp_user->setBirthPlace($user->getPersonalData()->getBirthPlace());
        $temp_user->setPhoto($user->getPersonalData()->getPhoto());

        $temp_addresses = array();
        $iter = 1;
        foreach ($user->getPersonalData()->getAdres() as $adres){
            //if(!$adres === null){
                $temp_addresses["Address".$iter] = $adres->toArray();
                $iter++;
            //}
        }

        $temp_user->setAdres($temp_addresses);
        //$logger->info(count($temp_addresses));
        //$logger->info(count($temp_user->getAdres()));

        $temp_emails = array();
        $iter = 1;
        foreach ($user->getPersonalData()->getEmails() as $email){
            //if(!$email === null){
                $temp_emails["Email".$iter] = $email->toArray();
                $iter++;
            //}
        }

        $temp_user->setEmails($temp_emails);
        //$logger->info(count($temp_emails));
        //$logger->info(count($temp_user->getEmails()));

        $temp_phoneNumbers = array();
        $iter = 1;
        foreach ($user->getPersonalData()->getPhoneNumbers() as $phoneNumber){
            //if(!$phoneNumber === null){
                $temp_phoneNumbers["PhoneNumber".$iter] = $phoneNumber->toArray();
                $iter++;
            //}
        }

        $temp_user->setPhoneNumbers($temp_phoneNumbers);
        //$logger->info(count($temp_phoneNumbers));
        //$logger->info(count($temp_user->getPhoneNumbers()));

        $em = $this->getDoctrine()->getManager();
        $em->persist($temp_user);
        $em->flush();

        return $this->redirectToRoute('temporary_personal_data_edit', ['id' => $temp_user->getId()]);
    }
}
