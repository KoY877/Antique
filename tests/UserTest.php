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
            ->setNombreDeConvives(3)
            ->setMentionDesAllergie('allergie')
            ->setCreatedAt($datetime)
        ;

        $this->assertTrue($user->getEmail() === 'user@test.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getNombreDeConvives() === 3);
        $this->assertTrue($user->getMentionDesAllergie() === 'allergie');
        $this->assertTrue($user->getCreatedAt() === $datetime);
    }

    public function testIsFalse(): void
    {
        $user = new User();
        $datetime = new DateTime();

        $user->setEmail('user@test.com')
            ->setPassword('password')
            ->setNombreDeConvives(3)
            ->setCreatedAt($datetime)
        ;

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getNombreDeConvives() === 5);
        $this->assertFalse($user->getMentionDesAllergie() === 'false');
        $this->assertFalse($user->getCreatedAt() === new Datetime());
    }

    public function testIsEmpty(): void
    {
        $user = new User();

        $user->setPassword('')
        ;

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getNombreDeConvives());
        $this->assertEmpty($user->getMentionDesAllergie());
        $this->assertEmpty($user->getCreatedAt());
    }

}
