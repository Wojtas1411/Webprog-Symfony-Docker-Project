<?php

namespace App\Controller;

use App\Entity\Engagement;
use App\Form\EngagementType;
use App\Repository\EngagementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/engagement")
 */
class EngagementController extends AbstractController
{
    /**
     * @Route("/", name="engagement_index", methods="GET")
     */
    public function index(EngagementRepository $engagementRepository): Response
    {
        return $this->render('engagement/index.html.twig', ['engagements' => $engagementRepository->findAll()]);
    }

    /**
     * @Route("/new", name="engagement_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $engagement = new Engagement();
        $form = $this->createForm(EngagementType::class, $engagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($engagement);
            $em->flush();

            return $this->redirectToRoute('engagement_index');
        }

        return $this->render('engagement/new.html.twig', [
            'engagement' => $engagement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="engagement_show", methods="GET")
     */
    public function show(Engagement $engagement): Response
    {
        return $this->render('engagement/show.html.twig', ['engagement' => $engagement]);
    }

    /**
     * @Route("/{id}/edit", name="engagement_edit", methods="GET|POST")
     */
    public function edit(Request $request, Engagement $engagement): Response
    {
        $form = $this->createForm(EngagementType::class, $engagement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('engagement_edit', ['id' => $engagement->getId()]);
        }

        return $this->render('engagement/edit.html.twig', [
            'engagement' => $engagement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="engagement_delete", methods="DELETE")
     */
    public function delete(Request $request, Engagement $engagement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$engagement->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($engagement);
            $em->flush();
        }

        return $this->redirectToRoute('engagement_index');
    }
}
