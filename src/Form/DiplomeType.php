<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Form/DiplomeType.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 01/06/2021 08:08
 */

namespace App\Form;

use App\Entity\AnneeUniversitaire;
use App\Entity\Diplome;
use App\Entity\Personnel;
use App\Entity\TypeDiplome;
use App\Form\Type\YesNoType;
use App\Repository\PersonnelRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Umbrella\CoreBundle\Form\Entity2Type;

/**
 * Class DiplomeType.
 */
class DiplomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_diplome', EntityType::class, [
                'class' => TypeDiplome::class,
                'choice_label' => 'libelle',
                'label' => 'type_diplome',
            ])
            ->add('libelle', TextType::class, [
                'label' => 'libelle',
            ])
            ->add('sigle', TextType::class, [
                'label' => 'sigle',
            ])
            ->add('responsable_diplome', Entity2Type::class, [
                'class' => Personnel::class,
                'query_builder' => static function(PersonnelRepository $personnelRepository) {
                    return $personnelRepository->findAllOrder();
                },
                'choice_label' => 'display',
                'label' => 'responsable_diplome',
            ])
            ->add('assistant_diplome', Entity2Type::class, [
                'class' => Personnel::class,
                'query_builder' => static function(PersonnelRepository $personnelRepository) {
                    return $personnelRepository->findAllOrder();
                },
                'choice_label' => 'display',
                'label' => 'assistant_diplome',
            ])
            ->add('anneeUniversitaire', EntityType::class, [
                'label' => 'annee_courante',
                'class' => AnneeUniversitaire::class,
                'choice_label' => 'displayAnneeUniversitaire',
            ])
            ->add('code_diplome', TextType::class, [
                'label' => 'code_diplome',
            ])
            ->add('code_version', TextType::class, [
                'label' => 'code_version',
            ])
            ->add('code_departement', TextType::class, [
                'label' => 'code_departement',
            ])
            ->add('opt_nb_jours_saisie', TextType::class, [
                'label' => 'opt_nb_jours_saisie',
            ])
            ->add(
                'opt_dilpome_decale',
                YesNoType::class,
                [
                    'label' => 'opt_dilpome_decale',
                ]
            )
            ->add(
                'opt_suppr_absence',
                YesNoType::class,
                [
                    'label' => 'opt_suppr_absence',
                ]
            )
            ->add(
                'opt_methode_calcul',
                ChoiceType::class,
                [
                    'choices' => ['choice.moymodules' => 'moymodules', 'choice.moyues' => 'moyues'],
                    'expanded' => true,
                    'label' => 'opt_methode_calcul',
                    'choice_translation_domain' => 'form',
                ]
            )
            ->add(
                'opt_anonymat',
                YesNoType::class,
                [
                    'label' => 'opt_anonymat',
                ]
            )
            ->add(
                'opt_commentaires_releve',
                YesNoType::class,
                [
                    'label' => 'opt_commentaires_releve',
                ]
            )
            ->add(
                'opt_espace_perso_visible',
                YesNoType::class,
                [
                    'label' => 'opt_espace_perso_visible',
                ]
            )
            ->add('volume_horaire', TextType::class, [
                'label' => 'volume_horaire',
            ])
            ->add('code_celcat_departement', TextType::class, [
                'label' => 'code_celcat_departement',
            ]);
    }

    /**
     * @throws AccessException
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'         => Diplome::class,
            'translation_domain' => 'form',
        ]);
    }
}
