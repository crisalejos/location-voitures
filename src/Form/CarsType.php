<?php

namespace App\Form;

use App\Entity\Cars;
use App\Entity\CarColor;
use App\Entity\CarBrand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('registration_number', NumberType::class, [
                'label' => 'Numéro de matricule : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                'label_format' => '0000000000',
                'help' => 'Ecrivez le numéro avec 10 chiffres'
            ])
            ->add('km', NumberType::class, [
                'label' => 'Kilometres : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                'label_format' => '00000000000',
                'help' => 'Ecrivez le numéro avec un maximum de 11 chiffres'
            ])
            ->add('brand', EntityType::class, [
                'class' => CarBrand::class,               
                'placeholder' => 'Choisir la marque',
                //'expanded' => true,   
                'label' => 'Choisir la marque de la voiture : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control']
                
            ])
            ->add('color', EntityType::class, [
                'class' => CarColor::class,               
                'placeholder' => 'Choisir la couleur',
                //'expanded' => true,   
                'label' => 'Choisir la couleur de la voiture : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control']               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
