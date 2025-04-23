<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;

use Doctrine\ORM\EntityManagerInterface;

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

    #[Route('/produits/new', name: 'app_product_new')]
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        return $this->render('produits/new.html.twig', [
            'form' => $form
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
