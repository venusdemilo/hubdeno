<?php

namespace App\Form;

use App\Entity\Sick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConsultationChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          ->add('type', ChoiceType::class, [
            'mapped'=>false,
            'expanded'=> true,
            'multiple'=> false,
            'label'=>'Type de consultation',
            'choices' => [

              'Paro initiale' => 'paro_initiale',
              'Paro motivation' => 'paro_motivation',
              'Paro nettoyage' => 'paro_nettoyage',
              'HubDeno initiale' => 'hubdeno_initiale',
              ]
          ])
          ->add('save', SubmitType::class, [
            'attr' => ['class' => 'save'],
          ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sick::class,
        ]);
    }
}
