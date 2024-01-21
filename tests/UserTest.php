<?php

namespace App\Tests;

use App\Entity\Allergie;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIstrue(): void
    {
        $user = new User();
        $datetime = new DateTime();

        $user->setEmail('user@test.com')
            ->setPassword('password')
            ->setNombreDeConvive(3)
            ->setCreatedAt($datetime)
        ;

        $this->assertTrue($user->getEmail() === 'user@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getNombreDeConvive() === 3);
        $this->assertTrue($user->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    {
        $user = new User();
        $datetime = new DateTime();

        $user->setEmail('user@test.com')
            ->setPassword('password')
            ->setNombreDeConvive(3)
            ->setCreatedAt($datetime)
        ;

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getNombreDeConvive() === 5);
        $this->assertFalse($user->getCreatedAt() === new Datetime());
    }

    public function testIsEmpty(): void
    {
        $user = new User();

        $user->setPassword('')
        ;

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getNombreDeConvive());
        $this->assertEmpty($user->getCreatedAt());
    }

    public function testAddGetRemoveAllergie()
    {
        $user = new User();
        $allergie = new Allergie();

        $this->assertEmpty($user->getMentionDesAllergies());

        $user->addMentionDesAllergy($allergie);
        $this->assertContains($allergie, $user->getMentionDesAllergies());

        $user->removeMentionDesAllergy($allergie);
        $this->assertEmpty($user->getMentionDesAllergies());
    }

}
