<?php

namespace App\Tests\Fonctionnel;

use PHPUnit\Framework\TestCase;

class HomePageTest extends TestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des derniers articles');

        $link = $crawler->selectLink('Inscription');
        $this->assertEquals(1, count($link));
    }
}
