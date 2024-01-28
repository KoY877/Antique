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
                ->setMidi('12:00 - 14:00')
                ->setSoir('18:00 - 22:00')
                ->setCreatedAt($datetime)
        ;

        $this->assertTrue($horaire->getNomDuJour() === 'nom');
        $this->assertTrue($horaire->getMidi() === '12:00 - 14:00');
        $this->assertTrue($horaire->getSoir() === '18:00 - 22:00');
        $this->assertTrue($horaire->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    {  
        $horaire = new Horaire();
        $datetime = new Datetime();

        $horaire->setNomDuJour('nom')
                ->setMidi('12:00 - 14:00')
                ->setSoir('18:00 - 22:00')
                ->setCreatedAt($datetime)
        ;


        $this->assertFalse($horaire->getNomDuJour() === 'false');
        $this->assertFalse($horaire->getMidi() === 'false');
        $this->assertFalse($horaire->getSoir() === 'false');
        $this->assertFalse($horaire->getCreatedAt() === new Datetime());
    }

    public function testIsEmpty(): void
    { 
        $horaire = new Horaire();

        $this->assertEmpty($horaire->getNomDuJour());
        $this->assertEmpty($horaire->getMidi());
        $this->assertEmpty($horaire->getSoir());
        $this->assertEmpty($horaire->getCreatedAt());
    }
}
