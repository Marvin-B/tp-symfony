<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateType;



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


    #[Route('/article/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, ArticleRepository $ArticleRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

    
        if ($form->isSubmitted() && $form->isValid()) {
            $ArticleRepository->save($article, true);

            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit-article.html.twig', [
            'article' => $article,
            'form' => $form,
            'id' => $article->getId(),

            'auteur' => $this->getUser(),
        ]);
    }

    // Nouvel article
    #[Route('/nouvel-article', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArticleRepository $ArticleRepository): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ArticleRepository->save($article, true);

            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/add-article.html.twig', [
            'article' => $article,
            'form' => $form,
            'auteur' => $this->getUser(),
        ]);
    }

    // Supprimer article
    #[Route('/article/{id}/delete', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, ArticleRepository $ArticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $ArticleRepository->delete($article);
        }

        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }

    public function dateForm(Request $request): Response
    {
        $date = new \DateTime();
        return $this->render('article/_form.html.twig', [
            'date' => $date,
        ]);
    }
}
