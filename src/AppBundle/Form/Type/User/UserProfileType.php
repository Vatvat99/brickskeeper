<?php

namespace AppBundle\Form\Type\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserProfileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class)
            ->add('region', ChoiceType::class, [
                'choices' => [
                    'Alsace-Champagne-Ardenne-Lorraine' => 'Alsace-Champagne-Ardenne-Lorraine',
                    'Aquitaine-Limousin-Poitou-Charentes' => 'Aquitaine-Limousin-Poitou-Charentes',
                    'Auvergne-Rhône-Alpes' => 'Auvergne-Rhône-Alpes' ,
                    'Bourgogne-Franche-Comté' => 'Bourgogne-Franche-Comté',
                    'Bretagne' => 'Bretagne',
                    'Centre-Val de Loire' => 'Centre-Val de Loire',
                    'Corse' => 'Corse',
                    'Île-de-France' => 'Île-de-France',
                    'Languedoc-Roussillon-Midi-Pyrénées' => 'Languedoc-Roussillon-Midi-Pyrénées',
                    'Nord-Pas-de-Calais-Picardie' => 'Nord-Pas-de-Calais-Picardie',
                    'Normandie' => 'Normandie',
                    'Pays de la Loire' => 'Pays de la Loire',
                    'Provence-Alpes-Côte d\'Azur' => 'Provence-Alpes-Côte d\'Azur',
                ],
            ])
            ->add('message', TextareaType::class)
            ->add('file');
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\UserProfile',
        ]);
    }

}