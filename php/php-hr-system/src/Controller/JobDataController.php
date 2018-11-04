<?php

namespace App\Controller;

use App\Entity\JobData;
use App\Form\JobDataType;
use App\Repository\JobDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job/data")
 */
class JobDataController extends AbstractController
{
    /**
     * @Route("/", name="job_data_index", methods="GET")
     */
    public function index(JobDataRepository $jobDataRepository): Response
    {
        return $this->render('job_data/index.html.twig', ['job_datas' => $jobDataRepository->findAll()]);
    }

    /**
     * @Route("/new", name="job_data_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $jobDatum = new JobData();
        $form = $this->createForm(JobDataType::class, $jobDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jobDatum);
            $em->flush();

            return $this->redirectToRoute('job_data_index');
        }

        return $this->render('job_data/new.html.twig', [
            'job_datum' => $jobDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_data_show", methods="GET")
     */
    public function show(JobData $jobDatum): Response
    {
        return $this->render('job_data/show.html.twig', ['job_datum' => $jobDatum]);
    }

    /**
     * @Route("/{id}/edit", name="job_data_edit", methods="GET|POST")
     */
    public function edit(Request $request, JobData $jobDatum): Response
    {
        $form = $this->createForm(JobDataType::class, $jobDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_data_edit', ['id' => $jobDatum->getId()]);
        }

        return $this->render('job_data/edit.html.twig', [
            'job_datum' => $jobDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_data_delete", methods="DELETE")
     */
    public function delete(Request $request, JobData $jobDatum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobDatum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jobDatum);
            $em->flush();
        }

        return $this->redirectToRoute('job_data_index');
    }
}
