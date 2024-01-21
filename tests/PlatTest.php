<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Allergie;
use App\Entity\Plat;
use DateTime;
use PHPUnit\Framework\TestCase;

class PlatTest extends TestCase
{
    public function testIsTrue(): void
    { 
        $plat = new Plat();
        $datetime = new Datetime();
        $categorie = new Category();

        $plat->setNom('nom')
            ->setDescription('description')
            ->setPrix(23.60)
            ->setSlug('slug')
            ->addCategories($categorie)
            ->setCreatedAt($datetime)
        ;

        $this->assertTrue($plat->getNom() === 'nom');
        $this->assertTrue($plat->getDescription() === 'description');
        $this->assertTrue($plat->getPrix() === 23.60);
        $this->assertContains($categorie, $plat->getCategories());
        $this->assertTrue($plat->getSlug() === 'slug');
        $this->assertTrue($plat->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    { 
        $plat = new Plat();
        $datetime = new Datetime();
        $categorie = new Category();

        $plat->setNom('nom')
            ->setDescription('description')
            ->setPrix(23)
            ->setSlug('slug')
            ->addCategories($categorie)
            ->setCreatedAt($datetime)
        ;

        $this->assertFalse($plat->getNom() === 'false');
        $this->assertFalse($plat->getDescription() === 'false');
        $this->assertFalse($plat->getPrix() === 5);
        $this->assertNotContains(new Category, $plat->getCategories());
        $this->assertFalse($plat->getSlug() === 'false');
        $this->assertFalse($plat->getCreatedAt() === new DateTime());
    }

    public function testIsEmpty(): void
    { 
        $plat = new Plat();
       
        $this->assertEmpty($plat->getNom());
        $this->assertEmpty($plat->getDescription());
        $this->assertEmpty($plat->getPrix());
        $this->assertEmpty($plat->getCategories());
        $this->assertEmpty($plat->getSlug());
        $this->assertEmpty($plat->getCreatedAt());
    }
}
