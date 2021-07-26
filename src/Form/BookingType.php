<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Cars;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_date', BirthdayType::class, [
                'widget' => 'single_text',
                'label' => 'Date de départ : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'mt-3 mb-3 combinedPickerInput'],              
            ])
            ->add('end_date', BirthdayType::class, [
                'widget' => 'single_text',
                'label' => 'Date de retour : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'mt-3 mb-3 combinedPickerInput'],              
            ])
            ->add('booking_date',  BirthdayType::class, [
                'widget' => 'single_text',
                'label' => 'Date du contrat : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'mt-3 mb-3 combinedPickerInput'],              
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,               
                'placeholder' => 'Choisir le client',
                'label' => 'Choisir le client : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control']
            ])
            ->add('car', EntityType::class, [
                'class' => Cars::class,               
                'placeholder' => 'Choisir la voiture',
                'label' => 'Choisir la voiture : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
