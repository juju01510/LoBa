<?php

namespace App\Controller\Admin;

use App\Entity\Introduction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class IntroductionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Introduction::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
