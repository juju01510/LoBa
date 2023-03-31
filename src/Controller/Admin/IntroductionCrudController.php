<?php

namespace App\Controller\Admin;

use App\Entity\Introduction;
use App\Entity\User;
use App\Entity\Translation;
use App\Form\TranslationEditType;
use App\Repository\TranslationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use phpDocumentor\Reflection\Types\Static_;

class IntroductionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Introduction::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->disable(Action::NEW)
            ->disable(Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextEditorField::new('content');
        yield CollectionField::new('translations')
            ->onlyWhenUpdating()
            ->allowAdd(false)
            ->allowDelete(false)
            ->setEntryType(TranslationEditType::class)
            ->setFormTypeOptions([
                'by_reference' => false, // permet de ne pas passer la collection par référence
                'delete_empty' => true, // permet de supprimer les traductions vides lors de l'édition
            ])
            ->setLabel('Translation')
            ->setRequired(true);
        yield ImageField::new('background')
            ->setRequired(false)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield ImageField::new('background2')
            ->setRequired(false)
            ->setUploadDir('public/uploads/images')
            ->setBasePath('uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield TextField::new('User')
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
        if (!$entityInstance instanceof Introduction) {
            return;
        }
        $entityInstance->setUser($user);

        parent::persistEntity($entityManager, $entityInstance);
    }
}
