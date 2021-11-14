<?php

namespace App\Form;

use App\Entity\ContenuPages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContenuPagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu_text')
            ->add('id_image')
            ->add('created_at')
            ->add('updated_at')
            ->add('titre')
            ->add('pages')
            ->add('sections')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContenuPages::class,
        ]);
    }
}
