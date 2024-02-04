<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Repository\NombreDeConviveRepository;
use App\Repository\ReservationRepository;
use DateTime;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;

class ReservationType extends AbstractType
{
    public function __construct(private Security $security, 
            private ReservationRepository $reservationRepository,
            private  NombreDeConviveRepository $nombreDeConviveRepository,
    ) {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        // Récupérer les données de l´utilisateurs
        $user = $this->security->getUser();

        $nombreConvive = 0;
        $allergie = 0;

        if ( isset($user)) {
            $nombreConvive = $user->getNombreDeConvives();
            $allergie = $user->getMentionDesAllergie();
        }

        // Récupérer le nombre de place de la base de données
        $nombreDePlaceOccuper = $this->reservationRepository->nombreTotalDeConvive();
        $placeDisponible = $this->nombreDeConviveRepository->nombreDePlaceDisponible();

        // calcul du nombre de place restant
        $nombreDePlaceRestant = intval(implode("",$placeDisponible)) - intval(implode("",$nombreDePlaceOccuper));
        

        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom : ',
        ])
        ->add('nombreDeConvive', NumberType::class, [
            'label' => 'Nombres de convives :',
           'data' => $nombreConvive,
           'constraints' => [
                new LessThanOrEqual([
                    'value' => $nombreDePlaceRestant,
                    'message' => 'Il ne reste que : '. $nombreDePlaceRestant . ' places',
                ])
           ]
           
        ])
        ->add('date', DateType::class, [ 
            'label' => 'Date',
                    'html5' => false,
                    'input' => 'datetime_immutable',
                    'widget' => 'choice',
                    'constraints' => [
                        new GreaterThanOrEqual([
                            'value' => 'now', 
                            'message' => 'La date doit être ultérieure ou égale à la date actuelle.'
                        ]),
                    ],
        ])
        ->add('heure', ChoiceType::class, [
            'label' => 'Heure',
            'choices' => [
                '12' => '12',
                '13' => '13',
                '14' => '14',
                '18' => '18',
                '19' => '19',
                '20' => '20',
                '21' => '21',
                '22' => '22',
                ],
                'expanded' => true,
                'multiple' => false,
        ])
        ->add('minute', ChoiceType::class, [
            'label' => 'Minute',
            'required' => true,
            'choices' => [
                '00' => '00',
                '15' => '15',
                '30' => '30',
                '45' => '45',
                ],
                'expanded' => true,
                'multiple' => false,
        ])
        ->add('allergie', ChoiceType::class, [
            'label' => "Vous avez des allergies ?",
            'choices' => [ 'Non' => false, 'Oui' => true],
            'expanded' => true,
        ])
        ->add('mentionDesAllergies', TextType::class, [
            'label' => "J´ai un ou plusieurs allergies :",
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Réserver',
        ])
        ->addEventListener(FormEvents::POST_SUBMIT, function (PostSubmitEvent $event): void { // Ajouter la date avant l´enrégistrement dans la DB
               
            // Récupérer les données du formulaire
            $data = $event->getData();

            // Définir la date
            $now = new DateTime('now');
            $data->setCreatedAt($now);

        });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
