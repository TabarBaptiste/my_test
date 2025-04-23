<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
final class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(ArticlesRepository $articlesRepository): Response
    {        
        $articles = $articlesRepository->findAll(6);

        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'articles' => $articles,
        ]);
    }
}
