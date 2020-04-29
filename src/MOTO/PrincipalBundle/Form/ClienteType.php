<?php

namespace MOTO\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MOTO\PrincipalBundle\Entity\Plan;

class ClienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('dni')
            ->add('nombre')
            ->add('email')
            ->add('direccion')
            ->add('telefono')
            ->add('objetivo')
            ->add('clave')
            ->add('disponibilidad')
            ->add('observaciones')
            ->add('codplan', 'entity', array('class'=>'MOTOPrincipalBundle:Plan'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MOTO\PrincipalBundle\Entity\Cliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moto_principalbundle_cliente';
    }
}
