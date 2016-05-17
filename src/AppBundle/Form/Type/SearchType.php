<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class SearchType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('range', TextType::class, [
                'required' => false,
                'attr' =>
                    ['id' => 'range']
            ])
            ->add('serie', TextType::class, [
                'required' => false,
                'attr' =>
                    ['id' => 'serie']
            ])
            ->add('item_type', HiddenType::class)
            ->add('selected_range_alias', HiddenType::class)
            ->add('selected_serie_alias', HiddenType::class);

    }
    
}