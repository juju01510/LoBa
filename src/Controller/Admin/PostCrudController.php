<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield DateField::new('dateCreated')
            ->hideOnForm();
        yield DateTimeField::new('dateCreated')
            ->onlyOnForms();
        yield TextEditorField::new('content');
        yield ImageField::new('media')
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');

//        return [
//            IdField::new('id'),
//            TextField::new('title'),
//            TextEditorField::new('description'),
//        ];
    }
}
