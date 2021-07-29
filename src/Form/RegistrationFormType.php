<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('firstname',  TextType::class, [
            'label' => 'Prénom : ',
            'label_attr'=>['class' => 'form-label'],
            'attr'=>['class' => 'form-control']
            
        ])
        ->add('lastname',  TextType::class, [
            'label' => 'Nom : ',
            'label_attr'=>['class' => 'form-label'],
            'attr'=>['class' => 'form-control']
        ])
             ///// add user form

            ->add('email',  EmailType::class, [
                'label' => 'Email : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                'label_format' => 'form.address.%name%'              
            ])
            //->add('roles')
            
            
            ->add('birthdate',  BirthdayType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control']              
            ])
            ->add('phone',  NumberType::class, [
                'label' => 'Numéro de téléphone : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                
                
            ])
            ->add('card',  TextType::class, [
                'label' => 'Carte d\'identité : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
               
            ])

            
            ->add('plainPassword', PasswordType::class, [

                'label' => 'Mot de passe : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                //'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'attr'=>['class' => 'form-check-input'],
                'label_attr'=>['class' => 'form-check-label'],
                
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
