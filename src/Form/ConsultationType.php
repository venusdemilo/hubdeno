<?php

namespace App\Form;

use App\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
              'label' => 'Type de consultation',
              'disabled'=>true,
              'choices' => [
                'Paro initiale' => 'paro_initiale',
                'Paro motivation' => 'paro_motivation',
                'Paro nettoyage' => 'paro_nettoyage',
                'HubDeno initiale' => 'hubdeno_initiale',
                ]
              ])


            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $consultation = $event->getData();
                $form = $event->getForm();
                $data = $event->getData();
                $type = $data->getType();
                /////////////////////////
                if ($type == 'hubdeno_initiale') {
                    $form->add('etiologieTraitementHubdenoInitiale', ChoiceType::class, [
                  'label' => 'Motif du traitement IRO ou anti-angiogénique',
                  'mapped' => false,
                  'choices' => [
                    'Votre choix' => '',
                    'carcinome des cellules rénales'=>'carcinome des cellules rénales',
                    'carcinome hépato-cellulaire'=>'carcinome hépato-cellulaire',
                    'carcinome coloréctal métastatique'=>'carcinome coloréctal métastatique',
                    'glioblastome'=>'glioblastome',
                    'métastases osseuses' => 'métastases osseuses',
                    'ostéoporose' => 'ostéoporose',
                    'tumeur neuro-endocrine du pancréas' => 'tumeur neuro-endocrine du pancréas',
                    'tumeur stromale gastro-intestinale' => 'tumeur stromale gastro-intestinale',
                    'autre motif' => 'autre motif',
                  ]
                  ])
                  ->add('debutTraitementHubdenoInitiale', CheckboxType::class, array(
                    'mapped' => false,
                    'label' => 'Le traitement a-t\'il débuté?',
                    'required' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ))
                  ->add('dateDebutTraitementHubdenoInitiale', DateType::class, [
                    'widget' => 'single_text',
                    'label' => 'Date de début du traitement',
                    'mapped' => false,
                  ])
                  ->add('finTraitementHubdenoInitiale', CheckboxType::class, array(
                    'mapped' => false,
                    'label' => 'Le traitement est-t\'il achevé?',
                    'required' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ))
                  ->add('dateFinTraitementHubdenoInitiale', DateType::class, [
                    'widget' => 'single_text',
                    'label' => 'Date de fin du traitement',
                    'mapped' => false,
                  ])
                  ->add('tumeurPrimitiveHubdenoInitiale', ChoiceType::class, array(
                  'mapped'=>false,
                  'label'=>'Localisation cancer primitif',
                  'choices' => [
                    'Votre choix ...' => '',
                    'estomac'=>'estomac',
                    'foie' => 'foie',
                    'hémopathie maligne' => 'hémopathie maligne',
                    'intestin'=>'intestin',
                    'oesophage' => 'oesophage',
                    'ORL'=>'ORL',
                    'pancréas' => 'pancréas',
                    'peau'=>'peau',
                    'poumon' => 'poumon',
                    'sein' => 'sein',
                    'système squelettique' => 'système squelettique',
                    'système nerveux' => 'système nerveux',
                    'prostate' => 'prostate',
                    'rein' => 'rein',
                    'vessie' => 'vessie',
                    'autre type de cancer' => 'autre type de cancer',
                  ]
                  ))


                  ->add('localisationMetastaseHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Localisation métastases',
                    'help' => 'Séparez chaque localisation par des virgules',
                  ))
                  ->add('therapeutiqueMedicamenteuseHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Thérapeutique médicamenteuse',
                    'help' => 'Séparez chaque item par des virgules',
                  ))
                  ->add('therapeutiqueChirurgicaleHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Thérapeutique chirurgicale?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])
                  ->add('typeDeChirurgieHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Type de chirurgie',
                    'help' => 'Séparez chaque chirurgie par des virgules',
                  ))
                  ->add('radioTherapieHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Radiothérapie?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])
                  ->add('localisationRadioTherapieHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Localisation radiothérapie',
                    'help' => 'Séparez chaque localisation par des virgules',
                  ))
                  ->add('etatGeneralHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'radio-inline'],
                  'label' => 'Etat général',
                  'expanded' => true,
                  'multiple' => false,
                  'mapped' => false,
                  'choices' => [
                    'bon' => 'bon',
                    'moyen' => 'moyen',
                    'mauvais' => 'mauvais',
                  ]
                  ])
                  ->add('pronosticHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'radio-inline'],
                  'label' => 'Pronostic',
                  'expanded' => true,
                  'multiple' => false,
                  'mapped' => false,
                  'choices' => [
                    'bon' => 'bon',
                    'moyen' => 'moyen',
                    'mauvais' => 'mauvais',
                  ]
                  ])
                  ->add('maladieChroniqueHubdenoInitiale', CheckboxType::class, array(
                    'mapped' => false,
                    'label' => 'Maladies chroniques?',
                    'required' => false,
                  ))
                  ->add('typeMaladieChroniqueHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Types de maladies chroniques',
                    'help'=> 'Séparez chaque type par des virgules',
                  ))
                  ->add('risqueInfectieuxHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Risques infectieux?',
                    'required' => false,
                    'mapped' => false,
                  ])
                  ->add('typeRisqueInfectieuxHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Types de risque infectieux',
                    'help'=> 'Séparez chaque type par des virgules',
                  ))
                  ->add('antiAngiogeniqueAssocieHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Thérapie anti-angiogénique associée ou antérieure?',
                    'required' => false,
                    'mapped' => false,
                  ])
                  ->add('iroAssocieHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Thérapie IRO associée ou antérieure?',
                    'required' => false,
                    'mapped' => false,
                  ])
                  ->add('typeIroAssocieHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Types IRO associé',
                    'help'=> 'Séparez chaque type par des virgules',
                  ))
                  ->add('existanceChirurgienDentisteTraitantHubdenoInitiale', CheckboxType::class, [

                    'label'    => 'Existence d\'un chirurgien-dentiste traitant?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',

                  ])
                  ->add('nomChirurgienDentisteTraitantHubdenoInitiale', textType::class, array(
                    'mapped' => false,
                    'label' => 'Nom du chirurgien-dentiste traitant',
                  ))

                  ->add('regulariteSuiviDentaireHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'radio-inline'],
                  'label' => 'Régularité du suivi dentaire',
                  'expanded' => true,
                  'multiple' => false,
                  'mapped' => false,
                  'choices' => [
                    'deux fois par an' => 'bon',
                    'une fois par an' => 'moyen',
                    'de temps à autres' => 'mauvais',
                  ]
                  ])
                  ->add('prothAmovibleHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Présence de prothèse amovible?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])
                  ->add('anodontieHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Toutes les dents absentes?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])

                  ->add('stade0SymptomesNonSpecifiquesHubdenoInitiale', ChoiceType::class, [
                  'label' => 'Symptômes non spécifiques',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'help' => 'Plusieurs choix possibles',
                  'choices' => [
                    'douleur dentaire sans cause dentaire' => 'douleur dentaire sans cause dentaire',
                    'douleur osseuse sourde irradiant la mandibule jusqu\'à l\'ATM' => 'douleur osseuse sourde irradiant la mandibule jusqu\'à l\'ATM',
                    'douleur sinusienne associée à une inflammation de la paroi sinusienne' => 'douleur sinusienne associée à une inflammation de la paroi sinusienne',
                    'fonction neurosensorielle altérée' => 'fonction neurosensorielle altérée',
                  ]
                  ])
                  ->add('stade0SignesCliniquesNonSpecifiquesHubdenoInitiale', ChoiceType::class, [
                  'label' => 'Signes cliniques non spécifiques',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'help' => 'Plusieurs choix possibles',
                  'choices' => [
                    'perte de dents sans cause explicite (parodontopathie)' => 'perte de dents sans cause explicite (parodontopathie)',
                    'fistule peri-apicale ou parodontale sans nécrose pulpaire ou parodontopathie' => 'fistule peri-apicale ou parodontale sans nécrose pulpaire ou parodontopathie',
                  ]
                  ])
                  ->add('stade0ElementsRadiologiquesHubdenoInitiale', ChoiceType::class, [
                  'label' => 'Eléments radiologiques',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'help' => 'Plusieurs choix possibles',
                  'choices' => [
                    'résorption osseuse sans parodontopathie identifiable' => 'résorption osseuse sans parodontopathie identifiable',
                    'modification des trabéculations osseuses' => 'modification des trabéculations osseuses',
                    'région d\'ostéosclérose' => 'région d\'ostéosclérose',
                    'épaississement ou obscurcissement du LAD' => 'épaississement ou obscurcissement du LAD'
                  ]
                  ])
                  ->add('stade0OnmHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'ONM stade 0 présente?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])
                  ->add('stade0LocalisationSextantOnmHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation par sextants ONM stade 0',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'help' => 'Plusieurs choix possibles',
                  'choices' => [
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                  ]
                  ])

                  ->add('onmHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Os exposé en bouche?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])
                  ->add('localisationSextantOnmHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation ONM par Lextants',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,

                  'choices' => [
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                  ]
                  ])
                  ->add('stadeOnmHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'radio-inline'],
                  'label' => 'Stade évolution ONM',
                  'expanded' => true,
                  'multiple' => false,
                  'mapped' => false,
                  'choices' => [
                    'Stade 1' => '1',
                    'Stade 2' => '2',
                    'Stade 3' => '3',
                    'Stade 4' => '4',

                  ]
                  ])
                  ->add('foyersInfectieuxHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Foyers infectieux dentaires patents non traitables (dents à extraire)?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])
                  ->add('secteur1LocalisationFoyersInfectieuxHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 1',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '18' => '18',
                    '17' => '17',
                    '16' => '16',
                    '15' => '15',
                    '14' => '14',
                    '13' => '13',
                    '12' => '12',
                    '11' => '11'
                  ]
                  ])
                  ->add('secteur2LocalisationFoyersInfectieuxHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 2',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '24' => '24',
                    '25' => '25',
                    '26' => '26',
                    '27' => '27',
                    '28' => '28'
                  ]
                  ])
                  ->add('secteur3LocalisationFoyersInfectieuxHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 3',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '31' => '31',
                    '32' => '32',
                    '33' => '33',
                    '34' => '34',
                    '35' => '35',
                    '36' => '36',
                    '37' => '37',
                    '38' => '38'
                  ]
                  ])
                  ->add('secteur4LocalisationFoyersInfectieuxHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 4',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '48' => '48',
                    '47' => '47',
                    '46' => '46',
                    '45' => '45',
                    '44' => '44',
                    '43' => '43',
                    '42' => '42',
                    '41' => '41'
                  ]
                  ])

                  ->add('localisationSextantOnmHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation ONM par sextants',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                  ]
                  ])

                  ->add('dentsConservablesATraiterHubdenoInitiale', CheckboxType::class, [
                    'label'    => 'Dents conservables à traiter en soins courants?',
                    'required' => false,
                    'mapped' => false,
                    'help' => 'Cochez si réponse affirmative',
                  ])
                  ->add('secteur1LocalisationDentsConservablesATraiterHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 1',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '18' => '18',
                    '17' => '17',
                    '16' => '16',
                    '15' => '15',
                    '14' => '14',
                    '13' => '13',
                    '12' => '12',
                    '11' => '11'
                  ]
                  ])
                  ->add('secteur2LocalisationDentsConservablesATraiterHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 2',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '24' => '24',
                    '25' => '25',
                    '26' => '26',
                    '27' => '27',
                    '28' => '28'
                  ]
                  ])
                  ->add('secteur3LocalisationDentsConservablesATraiterHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 3',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '31' => '31',
                    '32' => '32',
                    '33' => '33',
                    '34' => '34',
                    '35' => '35',
                    '36' => '36',
                    '37' => '37',
                    '38' => '38'
                  ]
                  ])
                  ->add('secteur4LocalisationDentsConservablesATraiterHubdenoInitiale', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'Localisation en secteur 4',
                  'expanded' => true,
                  'multiple' => true,
                  'mapped' => false,
                  'choices' => [
                    '48' => '48',
                    '47' => '47',
                    '46' => '46',
                    '45' => '45',
                    '44' => '44',
                    '43' => '43',
                    '42' => '42',
                    '41' => '41'
                  ]
                  ])
                  ;
                } //end hubdenotype

                /////////////////////////
                if ($type == 'paro_initiale') {
                    $form->add('facteursGenerauxInitialeParo', ChoiceType::class, [
                  'required' => false,
                  'expanded' => true,
                  'multiple' => true,
                  'label' => 'Facteurs généraux aggravants',
                  'choices' => [
                    'diabète' => 'diabète',
                    'chimiothérapie' => 'chimiothérapie',
                    'grossesse' => 'grossesse',
                    'hépatite' => 'hépatite',
                    'immuno-déficience' => 'immuno-déficience',
                    'inflammation articulaire' => 'inflammation articulaire',
                    'maladie de Crohn' => 'maladie de Crohn',
                    'ménopause'=> 'ménopause',
                    'radiothérapie' => 'radiothérapie',
                    'rectocolite' => 'rectocolite',
                    'troubles cardio-vasculaires' => 'troubles cardio-vasculaires',

                  ]
                ])
                  ->add('anamneseInitialeParo', ChoiceType::class, [
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'choices' => [
                      'brossettes' => 'brossettes',
                      'bain de bouche' => 'bain de bouche',
                      'abcès des gencives' => 'abcès des gencives',
                    ]
                  ])
                  ->add('douleurGingivaleInitialeParo', CheckboxType::class, [
                    'label'    => 'Douleur gingivale?',
                    'required' => false,
                  ])
                  ->add('hyperSensibiliteDentinaireInitialeParo', CheckboxType::class, [
                    'label'    => 'Hyper sensibilité dentinaire?',
                    'required' => false,
                  ])
                  ->add('prescriptionDesensibilisantInitialeParo', CheckboxType::class, [
                    'label'    => 'Prescription désensibilisant?',
                    'required' => false,
                  ])
                  ->add('mauvaiseHaleineSubjectiveInitialeParo', CheckboxType::class, [
                    'label'    => 'Mauvaise haleine subjective?',
                    'required' => false,
                  ])
                  ->add('mobiliteDentaireSubjectiveInitialeParo', CheckboxType::class, [
                    'label'    => 'Mobilités dentaires subjective?',
                    'required' => false,
                  ])
                  ->add('migrationDentaireSubjectiveInitialeParo', CheckboxType::class, [
                    'label'    => 'Migrations dentaires subjective?',
                    'required' => false,
                  ])
                  ->add('indiceSaignementInitialeParo', ChoiceType::class, [
                  'expanded' => true,
                  'multiple' => false,
                  'choices' => [
                    'sang sur l\'oreillet' => '4',
                    'en mangeant' => '3',
                    'au brossage' => '2',
                    'de temps en temps' => 1,
                    'jamais' => 0
                  ]
                  ])
                  ->add('tabacInitialeParo', ChoiceType::class, [
                  'label' => 'Consommation de tabac',
                  'expanded' => true,
                  'multiple' => false,
                  'choices' => [
                    'consommation active' => 'consommation active',
                    'sevrage en cours' => 'sevrage en cours',
                    'sevré' => 'sevré',
                    'jamais' => 'jamais'
                  ]
                  ])
                  ->add('secteur1MobiliteCliniqueInitialeParo', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'secteur 1',
                  'expanded' => true,
                  'multiple' => true,
                  'choices' => [
                    '18' => '18',
                    '17' => '17',
                    '16' => '16',
                    '15' => '15',
                    '14' => '14',
                    '13' => '13',
                    '12' => '12',
                    '11' => '11'
                  ]
                  ])
                  ->add('secteur2MobiliteCliniqueInitialeParo', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'secteur 2',
                  'expanded' => true,
                  'multiple' => true,
                  'choices' => [
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '24' => '24',
                    '25' => '25',
                    '26' => '26',
                    '27' => '27',
                    '28' => '28'
                  ]
                  ])
                  ->add('secteur3MobiliteCliniqueInitialeParo', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'secteur 3',
                  'expanded' => true,
                  'multiple' => true,
                  'choices' => [
                    '31' => '31',
                    '32' => '32',
                    '33' => '33',
                    '34' => '34',
                    '35' => '35',
                    '36' => '36',
                    '37' => '37',
                    '38' => '38'
                  ]
                  ])
                  ->add('secteur4MobiliteCliniqueInitialeParo', ChoiceType::class, [
                  'label_attr'  => ['class' => 'checkbox-inline checkbox-switch'],
                  'label' => 'secteur 4',
                  'expanded' => true,
                  'multiple' => true,
                  'choices' => [
                    '48' => '48',
                    '47' => '47',
                    '46' => '46',
                    '45' => '45',
                    '44' => '44',
                    '43' => '43',
                    '42' => '42',
                    '41' => '41'
                  ]
                  ])
                  ->add('nombreSiteSondesInitialeParo', IntegerType::class, [
                    'label' => 'Nombre de sites sondés',
                  ])
                  ->add('nombrePointSaignementInitialeParo', IntegerType::class, [
                    'label' => 'Nombre de points de saignement',
                  ])
                  ->add('nombrePoche3mmInitialeParo', IntegerType::class, [
                    'label' => 'Nombre de poches = 3mm',
                  ])
                  ->add('nombrePoche5mmInitialeParo', IntegerType::class, [
                    'label' => 'Nombre de poches > 5mm',
                  ])
                  ->add('dentsPerduesParMPInitialeParo', ChoiceType::class, [
                  'label_attr'  => ['class' => 'radio-inline'],
                  'label' => 'Pertes de dents liées à la maladie parodontale?',
                  'expanded' => true,
                  'multiple' => false,
                  'choices' => [
                    'oui' => true,
                    'non' => false,
                  ]
                  ])
                  ->add('dentsMajoritairementConservablesInitialeParo', ChoiceType::class, [
                  'label_attr'  => ['class' => 'radio-inline'],
                  'label' => 'Dents majoritairement conservables?',
                  'expanded' => true,
                  'multiple' => false,
                  'choices' => [
                    'oui' => true,
                    'non' => false,
                  ]
                  ])
                  ->add('evolutionInitialeParo', ChoiceType::class, [
                  'label_attr'  => ['class' => 'radio-inline'],
                  'label' => 'Depuis quand évolue la maladie',
                  'expanded' => true,
                  'multiple' => false,
                  'choices' => [
                    'Tout début' => true,
                    'Depuis plus d\'un an' => false,
                  ]
                  ])

                ;
                } //end paro_initi
            }) // end eventListener
            ->add('observation')
            ->add('save', SubmitType::class, [
              'attr' => ['class' => 'save'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
