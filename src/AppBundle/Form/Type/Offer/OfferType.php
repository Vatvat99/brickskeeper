<?php

namespace AppBundle\Form\Type\Offer;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OfferType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Echange' => 'Echange',
                    'Vente' => 'Vente'
                ],
                'expanded' => true,
                'multiple' => true
            ])
            ->add('title', TextType::class)
            ->add('price', TextType::class)
            ->add('description', TextareaType::class)
            ->add('minifigures', EntityType::class, [
                'class' => 'AppBundle\Entity\Minifigure',
                'choice_label' => 'name',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('mf')
                        ->orderBy('mf.name', 'ASC');
                },
                'mapped' => false,
                'required' => false,
            ])
            ->add('sets', EntityType::class, [
                'class' => 'AppBundle\Entity\Set',
                'choice_label' => function($set) {
                    return $set->getName() . ' (' . $set->getNumber() . ')';
                },
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('st')
                        ->orderBy('st.name', 'ASC');
                },
                'mapped' => false,
                'required' => false,
            ])
            /*->add('offer_items', CollectionType::class, [
                'entry_type' => OfferItemType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])*/
            ->add('offer_pictures', CollectionType::class, [
                'entry_type'   => OfferPictureType::class,
                'allow_add'    => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Offer',
        ]);
    }

}