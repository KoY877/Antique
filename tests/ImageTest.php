<?php

namespace App\Tests;

use App\Entity\Image;
use DateTime;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testIsTrue(): void
    { 
        $image = new Image();
        $datetime = new Datetime();

        $image->setNom('nom')
            ->setFile('file')
            ->setCreatedAt($datetime)
        ;

        $this->assertTrue($image->getNom() === 'nom');
        $this->assertTrue($image->getFile() === 'file');
        $this->assertTrue($image->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    { 
        $image = new Image();
        $datetime = new Datetime();

        $image->setNom('nom')
            ->setFile('file')
            ->setCreatedAt($datetime)
        ;

        $this->assertFalse($image->getNom() === 'false');
        $this->assertFalse($image->getFile() === 'false');
        $this->assertFalse($image->getCreatedAt() === new  Datetime());
    }

    public function testIsEmpty(): void
    { 
        $image = new Image();
       
        $this->assertEmpty($image->getNom());
        $this->assertEmpty($image->getFile());
        $this->assertEmpty($image->getCreatedAt());
    }
}
