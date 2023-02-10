<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Repository\UserRepository;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('', name: 'app_profil')]
    // Rediriect to profil/{id}
    public function index(Request $request, UserRepository $UserRepository): Response
    {
      

        // Si pas connecté, redirection vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        } else{
            $user = $this->getUser();
            return $this->redirectToRoute('app_profil_show', ['id' => $user->getId()]);
        }
    }   

    // Profil utilisateur, avec pseudo, role et mot de passe
    #[Route('/{id}', name: 'app_profil_show')]

    public function show(Request $request, User $user, UserRepository $UserRepository): Response
    {
        return $this->render('profil/profil.html.twig', [
            'user' => $user,
        ]);
    }
}
