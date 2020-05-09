<?php

namespace MOTO\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EjercicioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', null, array('required'=>false))
                ->add('series', null, array('required'=>false))
                ->add('repeticiones', null, array('required'=>false))
                ->add('peso', null, array('required'=>false))
                ->add('link', null, array('required'=>false))
                ->add('ejExistentes', 'entity', array('class' => 'MOTOPrincipalBundle:Ejercicio',
                    'mapped' => false,
                    'required' => false,
                    'empty_value' => 'Selecciona uno si quieres añadirlo a la sesion'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MOTO\PrincipalBundle\Entity\Ejercicio'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'moto_principalbundle_ejercicio';
    }

}
