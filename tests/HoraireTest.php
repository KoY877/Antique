<?php

namespace App\Tests;

use App\Entity\Horaire;
use Symfony\Component\Validator\Constraints\Time;
use DateTime;
use PHPUnit\Framework\TestCase;

class HoraireTest extends TestCase
{
    public function testIsTrue(): void
    { 
        $horaire = new Horaire();
        $datetime = new Datetime();

        $horaire->setNomDuJour('nom')
                ->setOuvertureMidi($datetime)
                ->setFermetureMidi($datetime)
                ->setOuvertureSoir($datetime)
                ->setFermetureSoir($datetime)
                ->setCreatedAt($datetime)
        ;

        $this->assertTrue($horaire->getNomDuJour() === 'nom');
        $this->assertTrue($horaire->getOuvertureMidi() === $datetime);
        $this->assertTrue($horaire->getFermetureMidi() === $datetime);
        $this->assertTrue($horaire->getOuvertureSoir() === $datetime);
        $this->assertTrue($horaire->getFermetureSoir() === $datetime);
        $this->assertTrue($horaire->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    {  
        $horaire = new Horaire();
        $datetime = new Datetime();

        $horaire->setNomDuJour('nom')
                ->setOuvertureMidi($datetime)
                ->setFermetureMidi($datetime)
                ->setOuvertureSoir($datetime)
                ->setFermetureSoir($datetime)
                ->setCreatedAt($datetime)
        ;

        $this->assertFalse($horaire->getNomDuJour() === 'false');
        $this->assertFalse($horaire->getOuvertureMidi() === new Datetime());
        $this->assertFalse($horaire->getFermetureMidi() === new Datetime());
        $this->assertFalse($horaire->getOuvertureSoir() === new Datetime());
        $this->assertFalse($horaire->getFermetureSoir() === new Datetime());
        $this->assertFalse($horaire->getCreatedAt() === new Datetime());
    }

    public function testIsEmpty(): void
    { 
        $horaire = new Horaire();

        $this->assertEmpty($horaire->getNomDuJour());
        $this->assertEmpty($horaire->getOuvertureMidi());
        $this->assertEmpty($horaire->getFermetureMidi());
        $this->assertEmpty($horaire->getOuvertureSoir());
        $this->assertEmpty($horaire->getFermetureSoir());
        $this->assertEmpty($horaire->getCreatedAt());
    }
}
