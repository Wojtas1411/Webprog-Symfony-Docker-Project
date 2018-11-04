<?php

namespace App\Controller;

use App\Entity\StaffCategory;
use App\Form\StaffCategoryType;
use App\Repository\StaffCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/staff/category")
 */
class StaffCategoryController extends AbstractController
{
    /**
     * @Route("/", name="staff_category_index", methods="GET")
     */
    public function index(StaffCategoryRepository $staffCategoryRepository): Response
    {
        return $this->render('staff_category/index.html.twig', ['staff_categories' => $staffCategoryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="staff_category_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $staffCategory = new StaffCategory();
        $form = $this->createForm(StaffCategoryType::class, $staffCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($staffCategory);
            $em->flush();

            return $this->redirectToRoute('staff_category_index');
        }

        return $this->render('staff_category/new.html.twig', [
            'staff_category' => $staffCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="staff_category_show", methods="GET")
     */
    public function show(StaffCategory $staffCategory): Response
    {
        return $this->render('staff_category/show.html.twig', ['staff_category' => $staffCategory]);
    }

    /**
     * @Route("/{id}/edit", name="staff_category_edit", methods="GET|POST")
     */
    public function edit(Request $request, StaffCategory $staffCategory): Response
    {
        $form = $this->createForm(StaffCategoryType::class, $staffCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('staff_category_edit', ['id' => $staffCategory->getId()]);
        }

        return $this->render('staff_category/edit.html.twig', [
            'staff_category' => $staffCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="staff_category_delete", methods="DELETE")
     */
    public function delete(Request $request, StaffCategory $staffCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$staffCategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($staffCategory);
            $em->flush();
        }

        return $this->redirectToRoute('staff_category_index');
    }
}
