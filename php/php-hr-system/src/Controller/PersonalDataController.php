<?php

namespace App\Controller;

use App\Entity\PersonalData;
use App\Form\PersonalDataType;
use App\Repository\PersonalDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personal/data")
 */
class PersonalDataController extends AbstractController
{
    /**
     * @Route("/", name="personal_data_index", methods="GET")
     */
    public function index(PersonalDataRepository $personalDataRepository): Response
    {
        return $this->render('personal_data/index.html.twig', ['personal_datas' => $personalDataRepository->findAll()]);
    }

    /**
     * @Route("/new", name="personal_data_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $personalDatum = new PersonalData();
        $form = $this->createForm(PersonalDataType::class, $personalDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personalDatum);
            $em->flush();

            return $this->redirectToRoute('personal_data_index');
        }

        return $this->render('personal_data/new.html.twig', [
            'personal_datum' => $personalDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personal_data_show", methods="GET")
     */
    public function show(PersonalData $personalDatum): Response
    {
        return $this->render('personal_data/show.html.twig', ['personal_datum' => $personalDatum]);
    }

    /**
     * @Route("/{id}/edit", name="personal_data_edit", methods="GET|POST")
     */
    public function edit(Request $request, PersonalData $personalDatum): Response
    {
        $form = $this->createForm(PersonalDataType::class, $personalDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personal_data_edit', ['id' => $personalDatum->getId()]);
        }

        return $this->render('personal_data/edit.html.twig', [
            'personal_datum' => $personalDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personal_data_delete", methods="DELETE")
     */
    public function delete(Request $request, PersonalData $personalDatum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personalDatum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personalDatum);
            $em->flush();
        }

        return $this->redirectToRoute('personal_data_index');
    }
}
