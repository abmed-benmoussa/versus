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

/**
 * This is a form of entity Player
 *
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class PlayerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', Type\TextType::class, array(
                'label' => 'Nombre',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-addon-especial',
                    'placeholder' => 'Nombre'
                ),
            ))
            ->add('lastName', Type\TextType::class, array(
                'label' => 'Apellido',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-addon-especial',
                    'placeholder' => 'Nombre'
                ),
            ))
            ->add('birthday', Type\DateType::class, array(
                'label' => 'Edad',
                'widget' => 'single_text',
                'html5' => false,
                'required'=> false,
                'attr' => array(
                    'class' => 'form-control ct-input-bg input-lg input-inline datepicker',
                    'placeholder' => 'dd / mm / aaaa',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd',
                    'data-date-autoclose' => true,
                )
            ))
            ->add('email', Type\EmailType::class, array(
                'label' => 'Correo electrónico',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-addon-especial',
                    'placeholder' => 'miemail@correo.com'
                ),
            ))
            ->add('document', Type\TextType::class, array(
                'label' => 'Cedula',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-addon-especial',
                    'placeholder' => 'Cedula'
                ),
            ))
            ->add('phoneNumber', Type\TextType::class, array(
                'label' => 'Teléfono',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-addon-especial',
                    'placeholder' => 'Teléfono'
                ),
            ))
            ->add('shirtNumber', Type\IntegerType::class, array(
                'label' => 'Número de Camiseta',
                'attr'=> array(
                    'class' => 'form-name form-control input-lg  ct-addon-especial',
                    'placeholder' => 'Número de Camiseta',
                    'min' => 0,
                    'max' => 99
                ),
            ))
            ->add('positions', EntityType::class, array(
                'label' => 'Posiciones',
                'required'=> true,
                'class' => 'BackendBundle:PlayerPosition',
                'expanded' => false,
                'multiple' => true,
                'attr'=> array(
                    'class' => 'form-name form-control ct-input-bg input-lg',
                )
            ))
            ->add('isCaptain', Type\ChoiceType::class, array(
                'label' => 'Es Capitan?',
                'required' => true,
                'attr'=> array(
                    'class' => 'form-name form-control ct-input-bg input-lg'
                ),
                'choices' => array(
                    'Si' => true,
                    'No' => false
                )
            ))
            ->add('image', Type\FileType::class, array(
                'label' => '',
                'required'=> false,
                'attr'=> array(
                    'accept' => 'image/*',
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
            'data_class' => 'AppBundle\Model\Player'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_player';
    }


}
