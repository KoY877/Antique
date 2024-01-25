<?php

namespace App\Form;

use App\Entity\Allergie;
use App\Entity\User;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email: ',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' =>  true,
                'first_options' => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmer votre mot de passe :'] 
            ])
            ->add('nombreDeConvives', NumberType::class, [
                'label' => 'Nombres de convives :',
            ])
            ->add('mentionDesAllergies', EntityType::class, [
                    'class' => Allergie::class,
                    'choice_label' => 'nom',
                    'label' => 'Mention des allergies :',
                    'expanded' => false,
                    'multiple' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
