<?php

namespace App\Controller\Admin;

use App\Entity\Project;
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

//        yield ImageField::new('media')
//        ->setUploadDir('build/images/');

//        return [
//            IdField::new('id'),
//            TextField::new('title'),
//            TextEditorField::new('description'),
//        ];
    }

}
