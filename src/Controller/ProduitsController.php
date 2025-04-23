<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Product;
use App\Repository\ProductRepository;
final class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'app_produits')]
    public function index(ProductRepository $productRepository): Response
    {
        $produits = $productRepository->findProductDesc();
        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/{id}', name: 'app_product_show')]
    public function produitsId(Product $produit): Response
    {
        dump($produit);
        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }
}
