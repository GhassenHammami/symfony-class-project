<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/candidature')]
class CandidatureController extends AbstractController
{
    #[Route(path: "/new", name: "app_candidature_new")]
    public function createCandidature(Request $request, EntityManagerInterface $em): Response
    {
        $candidat = new Candidature();

        $fb = $this->createFormBuilder($candidat)
            ->add('candidat', TextType::class)
            ->add('contenu', TextType::class, [
                'label' => 'Contenu',
            ])
            ->add('date', DateType::class)
            ->add('job', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'type',
            ])
            ->add('Valider', SubmitType::class);

        $form = $fb->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($candidat);
            $em->flush();

            $this->addFlash('notice', 'Le candidat a été ajouté avec succès !');

            return $this->redirectToRoute('home');
        }

        return $this->render('candidature/new.html.twig', [
            'f' => $form->createView(),
        ]);
    }

    #[Route('/{id}/update', name: 'app_candidature_edit')]
    public function updateCandidature(Request $request, EntityManagerInterface $em, $id): Response
    {
        $candidat = $em->getRepository(Candidature::class)->find($id);

        if (!$candidat) {
            throw $this->createNotFoundException('Aucune candidature trouvée pour l’ID ' . $id);
        }

        $fb = $this->createFormBuilder($candidat)
            ->add('candidat', TextType::class)
            ->add('contenu', TextType::class, [
                'label' => 'Contenu',
            ])
            ->add('date', DateType::class)
            ->add('job', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'type',
            ])
            ->add('update', SubmitType::class, [
                'label' => 'Mettre à jour',
            ]);

        $form = $fb->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('notice', 'La candidature a été mise à jour avec succès !');
            return $this->redirectToRoute('home');
        }

        return $this->render('candidature/update.html.twig', [
            'f' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}/delete', name: 'app_candidature_delete')]
    public function delete(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $c = $entityManager->getRepository(Candidature::class)->find($id);

        if (!$c) {
            throw $this->createNotFoundException(
                'No job found for id ' . $id
            );
        }

        $entityManager->remove($c);
        $entityManager->flush();

        $this->addFlash('notice', 'La candidature a été supprimée avec succès !');

        return $this->redirectToRoute('home');
    }


}
