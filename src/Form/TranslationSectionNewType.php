<?php

namespace App\Form;

use App\Entity\Translation;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationSectionNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keyword', ChoiceType::class, [
                'choices' => [
                    'Title' => 'section.title',
                    'Content' => 'section.content'
                ],
                'multiple' => false,
                'expanded' => true,
                'label' => 'Type'
            ])
            ->add('locale', HiddenType::class, [
                'data' => 'fr',
            ])
            ->add('value', TextEditorType::class, [
                'label' => 'Value',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Translation::class,
        ]);
    }
}
