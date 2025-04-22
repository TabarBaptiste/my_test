<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setTitle('Produit '.$i);
            $product->setDescription('Description '.$i);
            $product->setDateCreated(new \DateTimeImmutable('now'));
            $manager->persist($product);
        }

        $manager->flush();
    }
}