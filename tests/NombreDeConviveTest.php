<?php

namespace App\Tests;


use App\Entity\NombreDeConvive;
use DateTime;
use PHPUnit\Framework\TestCase;

class NombreDeConviveTest extends TestCase
{
    public function testIsTrue(): void
    { 
        $NombreDeConvive = new NombreDeConvive();
        $datetime = new Datetime();

        $NombreDeConvive->setNombreDePlaceDisponible(10)
            ->setCreatedAt($datetime)
        ;

        $this->assertTrue($NombreDeConvive->getNombreDePlaceDisponible() === 10);
        $this->assertTrue($NombreDeConvive->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    { 
        $NombreDeConvive = new NombreDeConvive();
        $datetime = new Datetime();

        $NombreDeConvive->setNombreDePlaceDisponible(10)
            ->setCreatedAt($datetime)
        ;

        $this->assertFalse($NombreDeConvive->getNombreDePlaceDisponible() === 23);
        $this->assertFalse($NombreDeConvive->getCreatedAt() === new  Datetime());
    }

    public function testIsEmpty(): void
    { 
        $NombreDeConvive = new NombreDeConvive();
       
        $this->assertEmpty($NombreDeConvive->getNombreDePlaceDisponible());
        $this->assertEmpty($NombreDeConvive->getCreatedAt());
    }

}
