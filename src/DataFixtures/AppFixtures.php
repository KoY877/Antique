<?php

namespace App\DataFixtures;

use App\Entity\Allergie;
use App\Entity\Category;
use App\Entity\Horaire;
use App\Entity\Image;
use App\Entity\NombreDeConvive;
use App\Entity\Plat;
use App\Entity\Reservation;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(
        UserPasswordHasherInterface $encoder
    ) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // Utilisation de Faker 
        $faker = Factory::create('fr-FR');

        // création d´un utilisateur
        $user = new User();

        $user->setEmail('user@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setNombreDeConvive($faker->numberBetween($min = 1, $max = 50))
            ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
        ;

        $password = $this->encoder->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        // Définir le nombre de place disponible
        $NombreDeConvive = new NombreDeConvive();

        $NombreDeConvive->setNombreDePlaceDisponible(40)
             ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
        ;

        $manager->persist($NombreDeConvive);

        // Creation 3 Categorie plats
        for ($i = 0; $i < 3 ; $i++) {
            $categorie = new Category();

            $categorie->setNom($faker->numerify('categorie-####'))
                ->setSlug($faker->slug())
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'));

            $manager->persist($categorie);
        }

        // Creation 5 plat
        for ($i = 0; $i < 5 ; $i++) {
            $plat = new Plat();
            
            $plat->setNom($faker->numerify('Salomon-####'))
                ->setDescription($faker->text(50))
                ->setPrix($faker->numberBetween($min = 1000, $max = 9000))
                ->setSlug($faker->numerify('Salomon-####'))
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                ->addCategories($categorie);

            $manager->persist($plat);
        }

        // Creation 3 Allergies
        for ($i = 0; $i < 4 ; $i++) {
            $allergie = new Allergie();

            $allergie->setNom($faker->numerify('allergie-####'))
                    ->setSlug($faker->slug())
                    ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'));

            $manager->persist($allergie);
        }

        // Creation de 4 reservations
        for ($i = 0; $i < 5 ; $i++) {
            $reservation = new Reservation();

            $reservation->setNom($faker->numerify('client-####'))
                        ->setNombreDeConvive($faker->numberBetween($min = 1, $max = 50))
                        ->setDate($faker->datetime('now'))
                        ->setHeurePrevue($faker->numberBetween($min = 12, $max = 23))
                        ->setMinutePrevue($faker->numberBetween($min = 1, $max = 59))
                        ->addMentionDesAllergy($allergie)
                        ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
            ;
    

            $manager->persist($reservation);
        }

        // Creation 4 Image
        for ($i = 0; $i < 4 ; $i++) {
            $image = new Image();

            $image->setNom($faker->numerify('image-####'))
                ->setFile('image1.jpg')
                ->setSlug($faker->numerify('image-####'))
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'));

            $manager->persist($image);
        }

        // Creation 4 Horaire
        for ($i = 0; $i < 4 ; $i++) {
            $horaire = new Horaire();

            $horaire->setNomDuJour($faker->numerify('Jour-####'))
                ->setOuvertureMidi($faker->time())
                ->setFermetureMidi($faker->time())
                ->setOuvertureSoir($faker->time())
                ->setFermetureSoir($faker->time())
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'));

            $manager->persist($horaire);
        }

        
       

        $manager->flush();
    }
}
