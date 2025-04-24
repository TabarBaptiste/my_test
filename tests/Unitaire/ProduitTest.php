<?php

namespace App\Tests\Unitaire;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use PHPUnit\Framework\TestCase;
use App\Entity\Product;

class ProduitTest extends KernelTestCase
{
    public function testEntityInvalid(): void {
        self::bootKernel();

        $container = static::getContainer();
        $product = new Product();
        $product->setTitle('Test');
        $product->setDescription('Test de description');
        $product->setDateCreated(new \DateTime);

        $errors = $container->get('validator')->validate($product);

        $this->assertCount(1, $errors);
        $this->assertSame('le titre ne peut pas être vide', $errors[0]->getMessage());
    }
}
