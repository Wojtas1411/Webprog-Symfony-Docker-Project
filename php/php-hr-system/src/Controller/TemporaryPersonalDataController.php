<?php

namespace App\Controller;

use App\Entity\PersonalData;
use App\Entity\User;
use App\Entity\Adres;
use App\Entity\Emails;
use App\Entity\PhoneNumbers;
use App\Entity\TemporaryPersonalData;
use App\Form\TemporaryPersonalDataType;
use App\Repository\TemporaryPersonalDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/temporary/personal/data")
 */
class TemporaryPersonalDataController extends AbstractController
{
    private $security;
    private $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/", name="temporary_personal_data_index", methods="GET")
     */
    public function index(TemporaryPersonalDataRepository $temporaryPersonalDataRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        return $this->render('temporary_personal_data/index.html.twig', ['temporary_personal_datas' => $temporaryPersonalDataRepository->findAll()]);
    }

    //new change request should never be created

    /*
     * @Route("/new", name="temporary_personal_data_new", methods="GET|POST")
     */
//    public function new(Request $request): Response
//    {
//        $temporaryPersonalDatum = new TemporaryPersonalData();
//        $form = $this->createForm(TemporaryPersonalDataType::class, $temporaryPersonalDatum);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($temporaryPersonalDatum);
//            $em->flush();
//
//            return $this->redirectToRoute('temporary_personal_data_index');
//        }
//
//        return $this->render('temporary_personal_data/new.html.twig', [
//            'temporary_personal_datum' => $temporaryPersonalDatum,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="temporary_personal_data_show", methods="GET")
     */
    public function show(TemporaryPersonalData $temporaryPersonalDatum): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        return $this->render('temporary_personal_data/show.html.twig', ['temporary_personal_datum' => $temporaryPersonalDatum]);
    }

    /**
     * @Route("/{id}/edit", name="temporary_personal_data_edit", methods="GET|POST")
     */
    public function edit(Request $request, TemporaryPersonalData $temporaryPersonalDatum, LoggerInterface $logger): Response
    {
        //security condition xDDDD
        if($this->security->getUser()->getUsername()!='admin' && ($this->security->getUser()->getUsername() != $temporaryPersonalDatum->getUserID() ||
        $temporaryPersonalDatum->getTimestamp() != $this->entityManager->getRepository(TemporaryPersonalData::class)
            ->findOneBy(['UserID'=>$this->security->getUser()->getUsername()], ["Timestamp"=>'DESC'])->getTimestamp() ))
        {
            return $this->redirectToRoute("my_data");
        }

        //$logger->info(json_encode($temporaryPersonalDatum->getAdres()));
        $form = $this->createForm(TemporaryPersonalDataType::class, $temporaryPersonalDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('temporary_personal_data_edit', ['id' => $temporaryPersonalDatum->getId()]);
        }

        return $this->render('temporary_personal_data/edit.html.twig', [
            'temporary_personal_datum' => $temporaryPersonalDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temporary_personal_data_delete", methods="DELETE")
     */
    public function delete(Request $request, TemporaryPersonalData $temporaryPersonalDatum): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$temporaryPersonalDatum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temporaryPersonalDatum);
            $em->flush();
        }

        return $this->redirectToRoute('temporary_personal_data_index');
    }

    /**
     * @Route("/accept/{id}", name="temporary_personal_data_accept", methods="DELETE")
     */
    public function accept(Request $request, TemporaryPersonalData $temporaryPersonalDatum): Response
    {
        $this->denyAccessUnlessGranted('ROLE_HR', null, 'User tried to access a page without having ROLE_HR');

        //retrieve proper objects and persist them in database

        //find user which data are to be changed

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$temporaryPersonalDatum->getUserID()]);

        //retrive his personal data

        $personalData = $this->entityManager->getRepository(PersonalData::class)->findOneBy(['UserID'=>$user]);

        //easy part - changing his personal data
        $personalData->setFamilyName($temporaryPersonalDatum->getFamilyName());
        $personalData->setFirstName($temporaryPersonalDatum->getFirstName());
        $personalData->setBirthDate($temporaryPersonalDatum->getBirthDate());
        $personalData->setBirthPlace($temporaryPersonalDatum->getBirthPlace());
        $personalData->setPhoto($temporaryPersonalDatum->getPhoto());

        // setting addresses
        $iter = 1;
        foreach ( $personalData->getAdres() as $adres){
            $adres->setStreet($temporaryPersonalDatum->getAdres()['Address'.$iter]['street']);
            $adres->setNumber($temporaryPersonalDatum->getAdres()['Address'.$iter]['number']);
            $adres->setLocal($temporaryPersonalDatum->getAdres()['Address'.$iter]['local']);
            $adres->setPostalCode($temporaryPersonalDatum->getAdres()['Address'.$iter]['postalCode']);
            $adres->setTown($temporaryPersonalDatum->getAdres()['Address'.$iter]['town']);
            $iter++;
        }

        // setting emails
        $iter = 1;
        foreach ($personalData->getEmails() as $email){
            $email->setValue($temporaryPersonalDatum->getEmails()['Email'.$iter]['value']);
            $iter++;
        }

        // setting phone numbers
        $iter = 1;
        foreach ($personalData->getPhoneNumbers() as $phone){
            $phone->setValue($temporaryPersonalDatum->getPhoneNumbers()['PhoneNumber'.$iter]['value']);
            $iter++;
        }


        //---save changes in database---///

        $this->getDoctrine()->getManager()->flush();

        //---create form and delete temporary data from db---//

        if ($this->isCsrfTokenValid('delete'.$temporaryPersonalDatum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temporaryPersonalDatum);
            $em->flush();
        }

        return $this->redirectToRoute('view_requests');
    }

    /**
     * @Route("/discard/{id}", name="temporary_personal_data_discard", methods="DELETE")
     */
    public function discard(Request $request, TemporaryPersonalData $temporaryPersonalDatum): Response
    {
        $this->denyAccessUnlessGranted('ROLE_HR', null, 'User tried to access a page without having ROLE_HR');

        if ($this->isCsrfTokenValid('delete'.$temporaryPersonalDatum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temporaryPersonalDatum);
            $em->flush();
        }

        return $this->redirectToRoute('view_requests');
    }

}
