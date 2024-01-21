<?php

namespace App\Tests;

use App\Entity\Reservation;
use App\Entity\User;
use App\Entity\Allergie;
use DateTime;
use PHPUnit\Framework\TestCase;

class AllergieTest extends TestCase
{
    public function testIsTrue(): void
    { 
        $allergie = new Allergie();
        $datetime = new Datetime();
        $reservations = new Reservation();
        $users = new User();

        $allergie->setNom('nom')
                ->addReservation($reservations)
                ->addUser($users)
                ->setCreatedAt($datetime)
        ;

        $this->assertTrue($allergie->getNom() === 'nom');
        $this->assertContains($reservations, $allergie->getReservations());
        $this->assertContains($users, $allergie->getUsers());
        $this->assertTrue($allergie->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    {  
        $allergie = new Allergie();
        $datetime = new Datetime();
        $reservations = new Reservation();
        $users = new User();

        $allergie->setNom('nom')
                ->addReservation($reservations)
                ->addUser($users)
                ->setCreatedAt($datetime)
        ;

        $this->assertFalse($allergie->getNom() === 'false');
        $this->assertNotContains(new Reservation(), $allergie->getReservations());
        $this->assertNotContains(new User(), $allergie->getUsers());
        $this->assertFalse($allergie->getCreatedAt() === new DateTime());
    }

    public function testIsEmpty(): void
    { 
        $allergie = new Allergie();
      
        $this->assertEmpty($allergie->getNom());
        $this->assertEmpty($allergie->getReservations());
        $this->assertEmpty($allergie->getUsers());
        $this->assertEmpty($allergie->getCreatedAt());
    }
}
