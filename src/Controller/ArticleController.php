<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{

    #[Route('/', name: 'app_categorie_index', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $ArticleRepository->findAll(),
        ]);
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function indexx(Article $article, ArticleRepository $ArticleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, ArticleRepository $ArticleRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ArticleRepository->save($article, true);

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit-article.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }
}
