<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer; // ne pas oublier ce Use
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\HttpFoundation\Request;

class UserType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        // method to fetch Security and use it in this class
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('email')
         ->add('roles')

            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                [$this, 'onPreSetData']
            )
            ->add('isVerified')
            ;

        $builder->get('roles')
         ->addModelTransformer(new CallbackTransformer(
             function ($json) {
                 // transform the json to a string
                 $str = json_encode($json);
                 $str = strtr($str, array(
                                 "["=>"", // on enlève les crochets
                                 "]"=>"",
                                 "\""=>"", //on enlève les guillemets
                               ));
                 return $str;
             },
             function ($str) {
                 // transform the string back to an array
                 return explode(',', $str);
             }
         ));
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    public function onPreSetData(FormEvent $event)
    {   // Affiche le champ password seulement pour la création d'un nouvel utilisateur 😏
        $user = $event->getData();
        $form = $event->getForm();
        if (!$user || null === $user->getId()) { // if is a new user
            $form->add('password');
        }
        // Si ce n’est pas un ROLE_ADMIN on retire l'affichage des rôles
        $connectedUser= $this->security->getUser(); // we use the Security service
        $str = json_encode($connectedUser->getRoles()); // transform the json to a string
        if (! str_contains($str, 'ROLE_ADMIN')) {
            $form -> remove('roles');
        }
    }
}
