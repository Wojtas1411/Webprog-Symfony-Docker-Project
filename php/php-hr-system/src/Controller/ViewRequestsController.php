<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TemporaryPersonalData;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ViewRequestsController extends AbstractController
{
    private $security;
    private $entityManager;
    private $logger;

    public function __construct(Security $security, EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @Route("/view/requests", name="view_requests")
     */
    public function index()
    {
        $temp = $this->entityManager->getRepository(TemporaryPersonalData::class)->findBy([],['Timestamp'=>'ASC']);

        # $this->logger->info(count($temp));

        if(count($temp) == 0){
            $ret = null;
        } else {
            $ret = $temp[0];
        }


        return $this->render('temporary_personal_data/show.html.twig', [
            'temporary_personal_datum' => $ret,
        ]);
    }
}
