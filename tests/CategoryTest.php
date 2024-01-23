<?php

namespace App\Tests;

use App\Entity\Plat;
use App\Entity\Category;
use DateTime;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{ 
    public function testIsTrue(): void
    { 
        $categories = new Category();
        $datetime = new Datetime();
        $plats = new Plat();

        $categories->setNom('nom')
                ->addPlat($plats)
                ->setCreatedAt($datetime)
        ;

        $this->assertTrue($categories->getNom() === 'nom');
        $this->assertContains($plats, $categories->getPlats());
        $this->assertTrue($categories->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    {  
        $categories = new Category();
        $datetime = new Datetime();
        $plats = new Plat();

        $categories->setNom('nom')
                ->addPlat($plats)
                ->setCreatedAt($datetime)
        ;

        $this->assertFalse($categories->getNom() === 'false');
        $this->assertNotContains(new Plat(), $categories->getPlats());
        $this->assertFalse($categories->getCreatedAt() === new Datetime());
    }

    public function testIsEmpty(): void
    { 
        $categories = new Category(); 

        $this->assertEmpty($categories->getNom());
        $this->assertEmpty($categories->getPlats());
        $this->assertEmpty($categories->getCreatedAt());
    }
}
