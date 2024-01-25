<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Composer\Semver\Constraint\Constraint;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(public UserPasswordHasherInterface $userPassword)
    {
        
    }
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_EDIT, Action::INDEX)
                    ->add(Crud::PAGE_INDEX, Action::DETAIL)
                    ->add(Crud::PAGE_EDIT, Action::DETAIL);   
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email', 'Email', [
                'type' => EmailType::class,

            ]),
            TextField::new('password')
                        ->setFormType(RepeatedType::class)
                        ->setFormTypeOptions([
                            'type' => PasswordType::class,
                            'first_options' => ['label' => 'Mot de passe'],
                            'second_options' => ['label' => 'Confirmation du mot de passe'],
                            'mapped' => true,
                        ])
                        ->setRequired($pageName === Crud::PAGE_NEW)
                        ->onlyOnForms(),
        ];

        return $fields;
    }
    
    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
       return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

    private function hashPassword()
    {

        return function($event) {

            $form = $event->getForm();

            if (!$form->isValid())
            {
                return;
            }

            $password = $form->get('password')->getData();

            if ($password == null) {
                return;
            }

            $user = new User();
            $hash = $this->userPassword->hashPassword($user, $password);

            $form->getData()->setPassword($hash);

            $form->getData()->setRawPassword($hash);

            $form->getData()->setRoles(["ROLE_ADMIN"]);

            $form->getData()->setCreatedAt(new DateTime('now'));
        };
    
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
                ->setPageTitle('index', 'Utilisateurs')
                ->setPageTitle('edit', 'Editer les Utilisateurs')
                ->setPageTitle('new', 'Créer un utilisateur');
    }
}
