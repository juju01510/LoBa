<?php

namespace App\Controller\Admin;

use App\Entity\BgProject;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class BgProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BgProject::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->disable(Action::NEW)
            ->disable(Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('background1')
            ->setRequired(false)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield ImageField::new('background2')
            ->setRequired(false)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
    }
}
