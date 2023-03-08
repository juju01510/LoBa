<?php

namespace App\Controller\Admin;

use App\Entity\Introduction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class IntroductionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Introduction::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextEditorField::new('content');

//        return [
//            IdField::new('id'),
//            TextField::new('title'),
//            TextEditorField::new('description'),
//        ];
    }

}
