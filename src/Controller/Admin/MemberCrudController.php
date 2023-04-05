<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MemberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('firstname');
        yield TextField::new('lastname');
        yield TextField::new('position');
        yield ImageField::new('image')
            ->onlyWhenCreating()
            ->setRequired(true)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield ImageField::new('image')
            ->onlyWhenUpdating()
            ->setRequired(false)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
    }

}
