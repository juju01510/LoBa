<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\Project;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
        yield ImageField::new('icon')
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield TextEditorField::new('content');
        yield ImageField::new('media')
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
