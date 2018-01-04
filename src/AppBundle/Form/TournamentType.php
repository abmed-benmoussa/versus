<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Library\StaticChoice;

/**
 * This is a form of entity Tournament
 *
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class TournamentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = new \DateTime();

        $builder
            ->add('name', Type\TextType::class, array(
                'label' => 'Nombre del Torneo',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-input-especial',
                    'placeholder' => 'Nombre del Torneo'
                )
            ))
            ->add('image', Type\FileType::class, array(
                'label' => '',
                'required'=> false,
            ))
            ->add('fechaInicio', Type\DateType::class, array(
                'label' => 'Fecha de Inicio',
                'widget' => 'single_text',
                'html5' => false,
                'required'=> true,
                'attr' => array(
                    'class' => 'form-control ct-input-bg input-lg input-inline datepicker',
                    'placeholder' => 'dd / mm / aaaa',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd',
                    'data-date-autoclose' => true,
                    'data-date-start-date' => $now->format('Y-m-d'),
                    'data-date-role' => 'init'
                )
            ))
            ->add('fechaFinal', Type\DateType::class, array(
                'label' => 'Fecha final',
                'widget' => 'single_text',
                'html5' => false,
                'required'=>true,
                'attr' => array(
                    'class' => 'form-control ct-input-bg input-lg input-inline datepicker',
                    'placeholder' => 'dd / mm / aaaa',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd',
                    'data-date-autoclose' => true,
                    'data-date-start-date' => $now->format('Y-m-d'),
                    'data-date-role' => 'end'
                )
            ))
            ->add('descripcion', Type\TextType::class, array(
                'label' => 'Descripcion',
                'attr'=> array(
                    'class' => 'form-name form-control ct-input-bg input-lg'
                ),
            ))
            // ->add('horario', Type\ChoiceType::class, array(
            //     'label'=>'Horario Disponible',
            //     'required'=>true,
            //     'attr'=> array(
            //         'class' => 'form-name form-control ct-input-bg input-lg'
            //     ),
            //     'choices' => array(
            //         '08:00' => new \DateTime('08:00'),
            //         '09:00' => new \DateTime('09:00'),
            //         '10:00' => new \DateTime('10:00'),
            //         '11:00' => new \DateTime('11:00'),
            //         '12:00' => new \DateTime('12:00'),
            //         '13:00' => new \DateTime('13:00'),
            //         '14:00' => new \DateTime('14:00'),
            //         '15:00' => new \DateTime('15:00'),
            //         '16:00' => new \DateTime('16:00'),
            //         '17:00' => new \DateTime('17:00'),
            //         '18:00' => new \DateTime('18:00'),
            //         '19:00' => new \DateTime('19:00'),
            //         '20:00' => new \DateTime('20:00'),
            //     )
            // ))
            // ->add('duracionPartido', Type\ChoiceType::class, array(
            //     'label'=>'Duración del partido',
            //     'required'=>true,
            //     'attr'=> array(
            //         'class' => 'form-name form-control ct-input-bg input-lg'
            //     ),
            //     'choices'  => array(
            //         "2T de 25 minutos"=> 25,
            //         "2T de 30 minutos" => 30,
            //         "2T de 35 minutos" => 35,
            //         "2T de 40 minutos" => 40,
            //         "2T de 45 minutos" => 45,
            //     )
            // ))
            ->add('partidosDia', Type\ChoiceType::class, array(
                'label' => 'Partidos por día',
                'required'=>true,
                'attr'=> array(
                    'class' => 'form-name form-control ct-input-bg input-lg'
                ),
                'choices' => StaticChoice\MatchesPerDayStaticChoice::choice()
            ))
            ->add('tournamentType', EntityType::class, array(
                'label'=>'Modalidad de Torneo',
                'required'=>true,
                'class' => 'BackendBundle:TournamentType',
                'placeholder' => 'Seleccione',
                'attr'=> array(
                    'class' => 'form-name form-control ct-input-bg input-lg',
                    'data-tournament-type-action' => '.tournament-mode',
                    'data-tournament-type-action-endpoint' => 'tournamenttypeaction',
                )
            ))
            ->add('numeroEquipos', Type\ChoiceType::class, array(
                'label' => 'Número De Equipos',
                'required'=>true,
                'attr'=> array(
                    'class' => 'form-name form-control ct-input-bg input-lg',
                ),
                'choices' => StaticChoice\TeamNumberStaticChoice::choice()
            ))
            ->add('addresses', Type\TextType::class, array(
                'label' => 'Dirección',
                'mapped' => false,
                'property_path' => null,
                'attr'=> array(
                    'readonly' => true,
                    'class' => 'form-name form-control ct-input-bg input-lg map-addresses',
                ),
            ))
            ->add('tournamentLocations', Type\CollectionType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => 'google-map-field-modal'
                ),
                'entry_type' => TournamentLocationType::class,
                'entry_options' => array('label' => false),
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ))

            ->add('teamsPerGroups', Type\ChoiceType::class, array(
                'label' => '',
                'required'=> false,
                'placeholder' => false,
                'attr' => array(
                    'class' => 'form-name form-control margintop-6 marginbottom-6 input-lg',
                    'data-value-format' => '{0} Equipos',
                    'data-dinamyc-team-groups' => "#backendbundle_tournament_numeroEquipos"
                ),
                'choices'  => StaticChoice\QualifiedTeamsStaticChoice::choice()
            ))
            ->add('qualifiedTeams', Type\ChoiceType::class, array(
                'label' => '',
                'required'=> false,
                'placeholder' => false,
                'attr' => array(
                    'class' => 'form-name form-control margintop-6 marginbottom-6 input-lg',
                    'data-value-format' => '{0} Equipo(s)',
                    'data-dinamyc-team-classify' => "#backendbundle_tournament_teamsPerGroups"
                ),
                'choices'  => StaticChoice\QualifiedTeamsStaticChoice::choice()
            ))
            ->add('groupMatchModality', Type\ChoiceType::class, array(
                'label' => 'Modalidad',
                'required' => false,
                'placeholder' => false,
                'attr' => array(
                    'class' => 'form-name form-control margintop-6 marginbottom-6 input-lg'
                ),
                'choices'  => StaticChoice\MatchTypeStaticChoice::choiceLess(
                    StaticChoice\MatchTypeStaticChoice::UNIQUE_MATCH
                )
            ))

            ->add('playoffMatchModality', Type\ChoiceType::class, array(
                'label' => 'Modalidad',
                'required' => false,
                'placeholder' => false,
                'attr' => array(
                    'class' => 'form-name form-control margintop-6 marginbottom-6 input-lg'
                ),
                'choices'  => StaticChoice\MatchTypeStaticChoice::choiceLess(
                    StaticChoice\MatchTypeStaticChoice::ONE_WAY_MATCHES
                )
            ))
            ->add('playoffInstance', Type\ChoiceType::class, array(
                'label' => 'Elección de playoff desde',
                'required' => false,
                'placeholder' => false,
                'attr' => array(
                    'class' => 'form-name form-control margintop-6 marginbottom-6 input-lg'
                ),
                'choices'  => StaticChoice\PlayoffFromStaticChoice::choice()
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Tournament',
            'addreses_choices' => array()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_tournament';
    }
}
