<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Job;
use App\Entity\Image;
use App\Entity\Candidature;

class JobController extends AbstractController
{
    #[Route("/", name: "home")]
    public function home(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Candidature::class);
        $lesCandidats = $repo->findAll();
        return $this->render('job/home.html.twig', [
            'lesCandidats' => $lesCandidats
        ]);
    }

    #[Route('/job/{id}', name: 'app_job_show')]
    public function show(EntityManagerInterface $entityManager, $id)
    {
        $job = $entityManager->getRepository(Job::class)->find($id);

        $listCandidatures = $entityManager->getRepository(Candidature::class)
            ->findBy(['job' => $job]);


        return $this->render('job/show.html.twig', [
            'job' => $job,
            'listCandidatures' => $listCandidatures
        ]);
    }

    #[Route(path: "/job/new", name: "app_job_new")]
    public function createJob(Request $request, EntityManagerInterface $em): Response
    {
        $job = new Job();
        $form = $this->createForm(type: "App\Form\JobType", data: $job);
        $form->handleRequest(request: $request);
        if ($form->isSubmitted()) {
            $em->persist(object: $job);
            $em->flush();
            return $this->redirectToRoute(route: 'home');
        }

        return $this->render(
            view: 'job/new.html.twig',
            parameters: ['f' => $form->createView()]
        );
    }
}