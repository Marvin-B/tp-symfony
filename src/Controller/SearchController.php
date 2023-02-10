<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;



class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('recherche'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Rechercher',
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'button',
                ],
                'label' => 'Résultats',
            ])
            ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recherche', name: 'recherche')]
    public function recherche(Request $request, ArticleRepository $repo)
    {
        $query = $request->request->all('form')['query'];
        if($query) {
            $articles = $repo->findArticlesByName($query);
        }
        return $this->render('search/index.html.twig', [
            'articles' => $articles
        ]);
    }
    }
