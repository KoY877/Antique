<?php

namespace App\Controller\Admin;

use App\Entity\NombreDeConvive;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;

class NombreDeConviveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NombreDeConvive::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            NumberField::new('nombreDePlaceDisponible'),
            DateField::new('createdAt')->hideOnForm(),
        ];
    }

    
    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL)
                    ->disable(Action::DELETE, Action::NEW);
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
                ->setPageTitle('index', 'Nombre de place disponible')
                ->setPageTitle('edit', 'Modifier le nombre de places disponibles');
    }
}
