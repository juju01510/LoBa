<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\Section;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use phpDocumentor\Reflection\Types\Boolean;

class SectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Section::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield TextEditorField::new('content');
        yield CollectionField::new('translations')
            ->setRequired(true)
            ->onlyWhenCreating()
            ->setLabel('Translation')
            ->setEntryType(TextEditorType::class)
            ->setHelp('IMPORTANT! Add ONE translation field for the title and ONE for the content!!!');
        yield CollectionField::new('translations')
            ->setRequired(true)
            ->onlyWhenUpdating()
            ->allowAdd(false)
            ->allowDelete(false)
            ->setLabel('Translation')
            ->setEntryType(TextEditorType::class);
        yield BooleanField::new('available')
            ->onlyOnForms();
        yield BooleanField::new('available')
            ->renderAsSwitch(false)
            ->onlyOnIndex();
        yield TextField::new('User')
            ->setLabel('Created by')
            ->hideOnForm();
    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add('available',);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new \LogicException('Currently logged in user is not an instance of User?!');
        }
        $entityInstance->setUser($user);

        parent::updateEntity($entityManager, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $this->getUser();
        if (!$entityInstance instanceof Section) {
            return;
        }
        $entityInstance->setUser($user);

        parent::persistEntity($entityManager, $entityInstance);
    }
}
