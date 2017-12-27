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

/**
 * This is a form of entity Team
 *
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class TeamType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', Type\TextType::class, array(
                'label' => 'Nombre del Equipo',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-input-especial',
                    'placeholder' => 'Nombre del Equipo'
                ),
            ))
            ->add('image', Type\FileType::class, array(
                'label' => '',
                'required'=> false,
                'attr'=> array(
                    'accept' => 'image/*',
                ),
            ))
            ->add('color', Type\HiddenType::class, array(
                'label' => '',
                'required'=> false,
            ))
            ->add('playersfile', Type\FileType::class, array(
                'label' => '',
                'mapped' => false,
                'property_path' => null,
                "required" => false,
                'attr'=> array(
                    'accept' => 'application/vnd.openxmlformats-off icedocument.spreadsheetml.sheet, application/vnd.ms-excel',
                    'data-file-trigger' => '#trigger-players-file'
                ),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Team'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_equipos';
    }


}
