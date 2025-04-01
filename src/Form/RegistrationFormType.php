<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter a valid email',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Invalid Format',
                        'pattern' => '/^\\S+@\\S+\\.\\S+$/', // la plus complex "/^[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/"
                    ]),
                ],
                'label' => 'Mail',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your firstname',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Letters and - only...',
                        'pattern' => "/^[\p{L}\'\-]+$/u", // '^[a-zA-Z]'
                    ]),
                ],
                'label' => 'Firstname',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your lastname',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Letters, space and - only...',
                        'pattern' => "/^[\p{L}\'\- ]+$/u",
                    ]),
                ],
                'label' => 'Lastname',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your phone number',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Numbers, +, - and () only...',
                        'pattern' => "/^\+?[0-9\s\-\(\)]{7,20}$/",     // "/^\\+?[1-9][0-9]{7,14}$/"    ^(0|\+33)[1-9]( *[0-9]{2}){4}+$
                    ]),
                ],
                'label' => 'Phone',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('location', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your address',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Only letters, numbers and specifics caracters...',
                        'pattern' => "/^[\p{L}0-9\s,\.\'\-\/]+$/u",
                    ]),
                ],
                'label' => 'Location',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('zipcode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your zipcode',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Only letters and numbers...',
                        'pattern' => "/^[A-Za-z0-9\s\-]{3,12}$/",
                    ]),
                ],
                'label' => 'Postal code',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your city',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Only letters...',
                        'pattern' => "/^[\p{L}\'\-\s]+$/u", // '^[a-zA-Z]'
                    ]),
                ],
                'label' => 'City',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('country', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your country',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Only letters...',
                        'pattern' => "/^[\p{L}\'\-\s]+$/u", // '^[a-zA-Z]'
                    ]),
                ],
                'label' => 'Country',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('department', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your department',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Only letters...',
                        'pattern' => "/^[\p{L}\'\-\s]+$/u", // '^[a-zA-Z]'
                    ]),
                ],
                'label' => 'Department',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('region', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter your region',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'message' => 'Only letters...',
                        'pattern' => "/^[\p{L}\'\-\s]+$/u", // '^[a-zA-Z]'
                    ]),
                ],
                'label' => 'Region',
                'label_attr' => ['class' => 'my-2'],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
