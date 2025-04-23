<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/articles')]
final class ArticlesController extends AbstractController
{
    #[Route(name: 'app_articles_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN', message:'T\'as pas accès')]
    #[Route('/new', name: 'app_articles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, "Tentative accès page, mais pas admin");

        // if (!$this->IsGranted('ROLE_ADMIN')) {
        //     throw new AccessDeniedException('Accès limité aux admins');
        // }

        // if(!$this->denyAccessUnlessGranted('IS_AUTHENTICATED')) {
        //     return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        // }
        $user = $this->getUser();
        
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_articles_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_articles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Articles $article, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_articles_delete', methods: ['POST'])]
    public function delete(Request $request, Articles $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}
