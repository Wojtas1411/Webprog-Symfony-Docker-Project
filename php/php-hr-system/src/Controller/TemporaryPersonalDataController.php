<?php

namespace App\Controller;

use App\Entity\TemporaryPersonalData;
use App\Form\TemporaryPersonalDataType;
use App\Repository\TemporaryPersonalDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

/**
 * @Route("/temporary/personal/data")
 */
class TemporaryPersonalDataController extends AbstractController
{
    /**
     * @Route("/", name="temporary_personal_data_index", methods="GET")
     */
    public function index(TemporaryPersonalDataRepository $temporaryPersonalDataRepository): Response
    {
        return $this->render('temporary_personal_data/index.html.twig', ['temporary_personal_datas' => $temporaryPersonalDataRepository->findAll()]);
    }

    /**
     * @Route("/new", name="temporary_personal_data_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $temporaryPersonalDatum = new TemporaryPersonalData();
        $form = $this->createForm(TemporaryPersonalDataType::class, $temporaryPersonalDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($temporaryPersonalDatum);
            $em->flush();

            return $this->redirectToRoute('temporary_personal_data_index');
        }

        return $this->render('temporary_personal_data/new.html.twig', [
            'temporary_personal_datum' => $temporaryPersonalDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temporary_personal_data_show", methods="GET")
     */
    public function show(TemporaryPersonalData $temporaryPersonalDatum): Response
    {
        return $this->render('temporary_personal_data/show.html.twig', ['temporary_personal_datum' => $temporaryPersonalDatum]);
    }

    /**
     * @Route("/{id}/edit", name="temporary_personal_data_edit", methods="GET|POST")
     */
    public function edit(Request $request, TemporaryPersonalData $temporaryPersonalDatum, LoggerInterface $logger): Response
    {
        $logger->info(json_encode($temporaryPersonalDatum->getAdres()));
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
        if ($this->isCsrfTokenValid('delete'.$temporaryPersonalDatum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temporaryPersonalDatum);
            $em->flush();
        }

        return $this->redirectToRoute('temporary_personal_data_index');
    }
}
