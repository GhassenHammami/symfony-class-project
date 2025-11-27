<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function registration(
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        // 1) Build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        // If the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $user->getPlainPassword();

            if ($plainPassword) {
                // Hash the password
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plainPassword
                );

                $user->setPassword($hashedPassword);
            }

            // Save user to database
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirect to "show" page
            return $this->redirectToRoute('show', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('registration/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'show')]
    public function show(User $user): Response
    {
        return $this->render('registration/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupère la dernière erreur de login, s’il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier email saisi par l’utilisateur
        $lastUsername = $authenticationUtils->getLastUsername() ?? '';

        return $this->render('registration/login.html.twig', [
            'controller_name' => 'LoginController',
            'email' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Ce code ne sera jamais exécuté !
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key.');
    }

}
