<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ["class"=>"form-control mb-2"]] )
            ->add('prenom', TextType::class, ['attr' => ["class"=>"form-control mb-2"]])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'n° rue - rue - code postal - ville'
                ]
            ])
            ->add('telephone', TelType::class, ['attr' => ["class"=>"form-control mb-2"],
            'constraints' => [
                    new Length(['max' => 10, 'maxMessage' => 'Le numéro de téléphone ne doit pas dépasser {{ limit }} chiffres.'])
                ]])
                ->add('email', EmailType::class, [
                    'attr' => ["class"=>"form-control mb-2"],
                    'constraints' => [
                        new NotBlank(['message' => 'Veuillez entrer une adresse email.']),
                        new Email(['message' => 'L\'adresse email "{{ value }}" n\'est pas valide.']),
                    ],
                ])
            ->add('disciplines', ChoiceType::class, [
                'choices' => [
                    'jiu-jitsu brésilien' => 'jiu-jitsu brésilien',
                    'vale tudo' => 'vale tudo',
                    'self-défense' => 'self-défense',
                    'atemi ju-jutsu' => 'atemi ju-jutsu',
                    'mushin-ryu' => 'mushin-ryu',
                    'zen hakko kaï' => 'zen hakko kaï',
                ],
                'attr' => ['class' => 'form-control custom-select mb-2']
            ])
            ->add('rib', FileType::class, [
                'label' => 'Fichier RIB',
                'attr' => ['class' => 'form-control mb-2'],
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['application/pdf', 'application/x-pdf'],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier PDF valide.',
                    ]),
                ],
            ])
            ->add('commentaires', TextareaType::class, ['attr' => ["class"=>"form-control", 'style' => 'height:200px'], 'required' => false])

            ->add("envoyer" , SubmitType::class , ["label"=> isset($options["label"]) ? $options["label"]  : "envoyer" , "attr" => [ "class" => "btn btn-outline-info mt-2 px-3" ]])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
