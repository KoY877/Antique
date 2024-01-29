<?php

namespace App\Form;

use App\Entity\Reservation;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSetDataEvent;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSetDataEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class ReservationType extends AbstractType
{
    public function __construct(private Security $security)
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();
        $nombreConvive = $user->getNombreDeConvives();
        $allergie = $user->getMentionDesAllergie();

        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom : ',
        ])
        ->add('nombreDeConvive', NumberType::class, [
            'label' => 'Nombres de convives :',
            'data' => $nombreConvive
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
        ->add('heurePrevue', ChoiceType::class, [
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
        ->add('minutePrevue', ChoiceType::class, [
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
        ->add('mentionDesAllergies', TextType::class, [
            'required' => false,
            'label' => 'J\'ai une ou plusieurs allergies : ',
            'data' => $allergie,
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Réserver',
        ])
        ->addEventListener(FormEvents::POST_SUBMIT, function (PostSubmitEvent $event): void {
               
            // Récupérer les données du formulaire
            $data = $event->getData();
           
            // Définir la date
            $now = new DateTime('now');
            $data->setCreatedAt($now);

        })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
