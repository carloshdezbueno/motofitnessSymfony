<?php

namespace MOTO\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EjercicioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('series')
            ->add('repeticiones')
            ->add('peso')
            ->add('link')
            ->add('codigosesion', 'entity', array('class'=>'MOTOPrincipalBundle:Sesion'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MOTO\PrincipalBundle\Entity\Ejercicio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moto_principalbundle_ejercicio';
    }
}
