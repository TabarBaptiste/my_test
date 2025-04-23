<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Product;
use App\Entity\Articles;
use App\Repository\ProductRepository;
use App\Repository\ArticlesRepository;

final class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(ProductRepository $productRepository, ArticlesRepository $articlesRepository): Response
    {
        $produits = $productRepository->findProductLast();
        $articles = $articlesRepository->findPostLast(6);

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'produits' => $produits,
            'articles' => $articles,
        ]);
    }
}
