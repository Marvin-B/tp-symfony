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
            return $this->render('profil/profil.html.twig', [
                'user' => $user,
            ]);
        }
    }
    // Editer nom d'utilisateur
    #[Route('/edit', name: 'app_profil_edit')]
    public function edit(Request $request, UserRepository $UserRepository): Response
    {
        // Si pas connecté, redirection vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        } else{
            $user = $this->getUser();
            return $this->render('profil/edit.html.twig', [
                'user' => $user,
            ]);
        }
    }
    

}
