<?php // src/Controller/InscriptionController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route('/number', name: 'inscription_number')]
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('Inscription/acceuil.html.twig', ['number' => $number]);
    }

    #[Route('/voir/{id}', name: 'voir')]
    public function voirAction($id)
    {
        return $this->render('Inscription/voir.html.twig', [
            'id' => $id,
        ]);
    }
}
?>