<?php

namespace App\Form;

use App\Entity\User;
use Dom\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => "Votre email",
                'attr' => ["class" => "form-control"],
                'required' => true
            ])
            // ->add('roles')
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        "message" => "s'il vous plait, entrez un mot de passe"
                    ]),
                    new Length([
                        "min"=>6,
                        "minMessage"=> "Ton mot de passe doit faire {{ limit }} caractères",
                        "max" => 4096
                    ])
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => "Votre prénom",
                "attr" => [ "class" => "form-control"],
                'required' => true
            ])
            ->add('nom', TextType::class, [
                'label' => "Votre nom",
                "attr" => [ "class" => "form-control"],
                'required' => true
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
