<?php

namespace App\Controller;

use App\Entity\PhoneNumbers;
use App\Form\PhoneNumbersType;
use App\Repository\PhoneNumbersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/phone/numbers")
 */
class PhoneNumbersController extends AbstractController
{
    /**
     * @Route("/", name="phone_numbers_index", methods="GET")
     */
    public function index(PhoneNumbersRepository $phoneNumbersRepository): Response
    {
        return $this->render('phone_numbers/index.html.twig', ['phone_numbers' => $phoneNumbersRepository->findAll()]);
    }

    /**
     * @Route("/new", name="phone_numbers_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $phoneNumber = new PhoneNumbers();
        $form = $this->createForm(PhoneNumbersType::class, $phoneNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phoneNumber);
            $em->flush();

            return $this->redirectToRoute('phone_numbers_index');
        }

        return $this->render('phone_numbers/new.html.twig', [
            'phone_number' => $phoneNumber,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="phone_numbers_show", methods="GET")
     */
    public function show(PhoneNumbers $phoneNumber): Response
    {
        return $this->render('phone_numbers/show.html.twig', ['phone_number' => $phoneNumber]);
    }

    /**
     * @Route("/{id}/edit", name="phone_numbers_edit", methods="GET|POST")
     */
    public function edit(Request $request, PhoneNumbers $phoneNumber): Response
    {
        $form = $this->createForm(PhoneNumbersType::class, $phoneNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('phone_numbers_edit', ['id' => $phoneNumber->getId()]);
        }

        return $this->render('phone_numbers/edit.html.twig', [
            'phone_number' => $phoneNumber,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="phone_numbers_delete", methods="DELETE")
     */
    public function delete(Request $request, PhoneNumbers $phoneNumber): Response
    {
        if ($this->isCsrfTokenValid('delete'.$phoneNumber->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($phoneNumber);
            $em->flush();
        }

        return $this->redirectToRoute('phone_numbers_index');
    }
}
