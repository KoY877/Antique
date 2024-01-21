<?php

namespace App\Tests;

use App\Entity\Allergie;
use App\Entity\Reservation;
use DateTime;
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    public function testIsTrue(): void
    { 
        $reservation = new Reservation();
        $datetime = new Datetime();

        $reservation->setNom('nom')
                    ->setNombreDeConvive(3)
                    ->setDate($datetime)
                    ->setHeurePrevue('12')
                    ->setMinutePrevue('30')
                    ->setCreatedAt($datetime)
        ;

        $this->assertTrue($reservation->getNom() === 'nom');
        $this->assertTrue($reservation->getNombreDeConvive() === 3);
        $this->assertTrue($reservation->getDate() === $datetime);
        $this->assertTrue($reservation->getHeurePrevue() === '12');
        $this->assertTrue($reservation->getMinutePrevue() === '30');
        $this->assertTrue($reservation->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    { 
        $reservation = new Reservation();
        $datetime = new Datetime();

        $reservation->setNom('nom')
                    ->setNombreDeConvive(3)
                    ->setDate($datetime)
                    ->setHeurePrevue('12')
                    ->setMinutePrevue('30')
                     ->setCreatedAt($datetime)
        ;

        $this->assertFalse($reservation->getNom() === 'False');
        $this->assertFalse($reservation->getNombreDeConvive() === 6);
        $this->assertFalse($reservation->getDate() === new Datetime());
        $this->assertFalse($reservation->getHeurePrevue() === '45');
        $this->assertFalse($reservation->getMinutePrevue() === '53');
        $this->assertFalse($reservation->getCreatedAt() === new Datetime());
    }

    public function testIsEmpty(): void
    { 
        $reservation = new Reservation();

        $this->assertEmpty($reservation->getNom());
        $this->assertEmpty($reservation->getNombreDeConvive());
        $this->assertEmpty($reservation->getDate());
        $this->assertEmpty($reservation->getHeurePrevue());
        $this->assertEmpty($reservation->getMinutePrevue());
        $this->assertEmpty($reservation->getCreatedAt());
    }
    


    public function testAddGetRemoveAllergie()
    {
        $reservation = new Reservation();
        $allergie = new Allergie();

        $this->assertEmpty($reservation->getMentionDesAllergies());

        $reservation->addMentionDesAllergy($allergie);
        $this->assertContains($allergie, $reservation->getMentionDesAllergies());

        $reservation->removeMentionDesAllergy($allergie);
        $this->assertEmpty($reservation->getMentionDesAllergies());
    }
}


