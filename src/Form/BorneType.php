<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Form/BorneType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 29/06/2021 09:03
 */

namespace App\Form;

use App\Entity\Borne;
use App\Entity\Departement;
use App\Entity\Semestre;
use App\Form\Type\DateRangeType;
use App\Form\Type\YesNoType;
use App\Repository\SemestreRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Umbrella\CoreBundle\Form\Choice2Type;

/**
 * Class BorneType.
 */
class BorneType extends AbstractType
{
    private ?Departement $departement;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->departement = $options['departement'];

        $builder
            ->add('icone', Choice2Type::class, [
                'label' => 'icone',
                'choices' => Borne::ICONES,
                'template_html' => '<span><i class="[[icone]] mr-2"></i> [[text]]</span>',
                'expose' => function($icone) {
                    return [
                        'icone' => Borne::ICONES_CHOICE[$icone],
                    ];
                },
            ])
            ->add('couleur', Choice2Type::class, [
                'label' => 'couleur',
                'choices' => Borne::COULEURS,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'message',
            ])
            ->add('url', TextType::class, [
                'label' => 'url',
                'required' => false,
                'input_prefix' => '<div class="input-group-text">HTTPS://</div>',
            ])
            //->add('dateRange', DateRangeType::class, ['label' => 'dateRange', 'mapped' => false, 'required' => true])
            ->add('dateRange', DateRangeType::class, ['label' => 'dateRange', 'mapped' => false, 'required' => true])
            ->add(
                'visible',
                YesNoType::class,
                [
                    'label' => 'visible',
                ]
            )
            ->add('semestres', EntityType::class, [
                'class' => Semestre::class,
                'label' => 'semestres_date',
                'choice_label' => 'libelle',
                'query_builder' => function(SemestreRepository $semestreRepository) {
                    return $semestreRepository->findByDepartementBuilder($this->departement);
                },
                'required' => true,
                'expanded' => true,
                'multiple' => true,
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, static function(FormEvent $event) {
                $borne = $event->getData();
                $form = $event->getForm();
                $dateRange = $form->get('dateRange')->getData();
                $borne->setDateDebutPublication($dateRange['from_date']);
                $borne->setDateFinPublication($dateRange['to_date']);
            })
            ->addEventListener(FormEvents::PRE_SET_DATA, static function(FormEvent $event) {
                $borne = $event->getData();
                $form = $event->getForm();
                $form->add('dateRange', DateRangeType::class, [
                    'label' => 'dateRange',
                    'mapped' => false,
                    'date_data' => [
                        'from' => $borne->getDateDebutPublication(),
                        'to' => $borne->getDateFinPublication(),
                    ],
                ]);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Borne::class,
            'departement' => null,
            'translation_domain' => 'form',
        ]);
    }
}
