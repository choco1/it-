<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
        ]);
    }


    /**
     * @Route("/job/{id}", name="single_job")
     */
    public function singleJob(Request $request, Job $job){


        return $this->render('job/singleJob.html.twig', [
            'job' => $job,
        ]);
    }



    /**
     * @Route("/jobs", name="all_jobs")
     */
    public function listJobs(JobRepository $jobRepository) {

        $jobRepository =$this->getDoctrine()->getRepository(Job::class);
        $jobs = $jobRepository->findAll();

        return $this->render('job/listJobs.html.twig', [
            'jobs' => $jobs,
        ]);
    }


    /**
     * @Route("/add", name="add_job")
     */
    public function addNewJob(Request $request){

    $job = new Job();
    $form = $this->createForm(JobType::class, $job);
    $form->handleRequest($request);


    if ($form->isSubmitted() && $form->isValid()){

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($job);
        $entityManager->flush();

        $this->addFlash('success', 'Votre annonce '.$job->getTitle().' a bien été ajoutée');

        return $this->redirectToRoute('all_jobs');

    }

        return $this->render('job/addJob.html.twig', [
            'addJob' => $form->createView(),
        ]);
    }


    /**
     * @Route("/job/delete/{id}", name="delete_job")
     */
    public function deleteJob(Job $job) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($job);
        $entityManager->flush(); // DELETE FROM

        $this->addFlash('danger', 'Votre annonce a bien été supprimée');

        return $this->redirectToRoute('all_jobs');


    }






}
