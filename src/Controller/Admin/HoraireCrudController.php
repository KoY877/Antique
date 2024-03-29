<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;

class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nomDuJour'),
            TextField::new('midi'),
            TextField::new('soir'),
            SlugField::new('slug')->setTargetFieldName('nomDuJour')->hideOnIndex(),
            DateField::new('createdAt')->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_EDIT, Action::INDEX)
                    ->add(Crud::PAGE_INDEX, Action::DETAIL)
                    ->add(Crud::PAGE_EDIT, Action::DETAIL);
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addFormEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addFormEventListener($formBuilder);
    }

    public function addFormEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
       return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->EventForm());
    }

    private function EventForm()
    {

        return function($event) {

            $form = $event->getForm();

            $form->getData()->setCreatedAt(new DateTime('now'));
        };
    
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
                ->setPageTitle('index', 'Heures d´ouverture')
                ->setPageTitle('edit', 'Modifier l´heure d´ouverture')
                ->setPageTitle('new', 'Créer une heure d´ouverture');
    }

}
