<?php

namespace App\Controller;

use App\Entity\Units;
use App\Form\UnitsType;
use App\Repository\UnitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/units")
 */
class UnitsController extends AbstractController
{
    /**
     * @Route("/", name="units_index", methods="GET")
     */
    public function index(UnitsRepository $unitsRepository): Response
    {
        return $this->render('units/index.html.twig', ['units' => $unitsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="units_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $unit = new Units();
        $form = $this->createForm(UnitsType::class, $unit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();

            return $this->redirectToRoute('units_index');
        }

        return $this->render('units/new.html.twig', [
            'unit' => $unit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="units_show", methods="GET")
     */
    public function show(Units $unit): Response
    {
        return $this->render('units/show.html.twig', ['unit' => $unit]);
    }

    /**
     * @Route("/{id}/edit", name="units_edit", methods="GET|POST")
     */
    public function edit(Request $request, Units $unit): Response
    {
        $form = $this->createForm(UnitsType::class, $unit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('units_edit', ['id' => $unit->getId()]);
        }

        return $this->render('units/edit.html.twig', [
            'unit' => $unit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="units_delete", methods="DELETE")
     */
    public function delete(Request $request, Units $unit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unit->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unit);
            $em->flush();
        }

        return $this->redirectToRoute('units_index');
    }
}
