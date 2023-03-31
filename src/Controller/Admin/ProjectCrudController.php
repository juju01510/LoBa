<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\User;
use App\Form\TranslationEditType;
use App\Form\TranslationProjectNewType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield TextEditorField::new('content');
        yield CollectionField::new('translations')
            ->setEntryType(TranslationProjectNewType::class)
            ->setFormTypeOptions([
                'by_reference' => false,
                'delete_empty' => true,
            ])
            ->onlyWhenCreating()
            ->setLabel('Translation')
            ->setRequired(true)
            ->setHelp('WARNING! Add ONE translation field for the title and ONE for the content!!!');

        yield CollectionField::new('translations')
            ->allowAdd(false)
            ->allowDelete(false)
            ->setEntryType(TranslationEditType::class)
            ->setFormTypeOptions([
                'by_reference' => false,
                'delete_empty' => true,
            ])
            ->onlyWhenUpdating()
            ->setLabel('Translation')
            ->setRequired(true);

        yield ImageField::new('icon')
            ->setRequired(false)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield ImageField::new('media')
            ->setRequired(false)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield TextField::new('user')
            ->setLabel('Created by')
            ->hideOnForm();
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
        if (!$entityInstance instanceof Project) {
            return;
        }
        $entityInstance->setUser($user);

        parent::persistEntity($entityManager, $entityInstance);
    }
}
