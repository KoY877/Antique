<?php

namespace App\Form;

use App\Entity\Allergie;
use App\Entity\User;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientInscriptionType extends AbstractType
{
    public function __construct(private  UserPasswordHasherInterface $passHasher)
    {
        
    }

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
            ->add('mentionDesAllergie', TextType::class, [
                'label' => "J'ai une ou plusieurs allergies : ",
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, function (PostSubmitEvent $event): void {
               
                // Récupérer les données du formulaire
                $data = $event->getData();
                $password = $event->getForm()->getData()->getPassword();

                $inscription = new User();
                
                $data->setPassword(
                    $this->passHasher->hashPassword($inscription, $password)
                );
        
                $data->setRawPassword( $password);

                // Role des clients
                $role = ['ROLE_USER'];
                $data->setRoles($role);

                // Définir la date
                $now = new DateTime('now');
                $data->setCreatedAt($now);

            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
