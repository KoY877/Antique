<?php

namespace App\Tests;

use App\Entity\Menu;
use DateTime;
use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase
{
    public function testIsTrue(): void
    { 
        $menu = new Menu();
        $datetime = new Datetime();

        $menu->setFormule('formule')
            ->setDescription('description')
            ->setPrix(23.60)
            ->setSlug('slug')
            ->setCreatedAt($datetime)
        ;

        $this->assertTrue($menu->getFormule() === 'formule');
        $this->assertTrue($menu->getDescription() === 'description');
        $this->assertTrue($menu->getPrix() === 23.60);
        $this->assertTrue($menu->getSlug() === 'slug');
        $this->assertTrue($menu->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    { 
        $menu = new Menu();
        $datetime = new Datetime();
      
        $menu->setFormule('formule')
            ->setDescription('description')
            ->setPrix(23.60)
            ->setSlug('slug')
            ->setCreatedAt($datetime)
        ;

        $this->assertFalse($menu->getFormule() === 'false');
        $this->assertFalse($menu->getDescription() === 'false');
        $this->assertFalse($menu->getPrix() === 5);
        $this->assertFalse($menu->getSlug() === 'false');
        $this->assertFalse($menu->getCreatedAt() === new DateTime());
    }

    public function testIsEmpty(): void
    { 
        $menu = new Menu();
       
        $this->assertEmpty($menu->getFormule());
        $this->assertEmpty($menu->getDescription());
        $this->assertEmpty($menu->getPrix());
        $this->assertEmpty($menu->getSlug());
        $this->assertEmpty($menu->getCreatedAt());
    }
}
