<?php

namespace MOTO\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmpleadoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('especialidad','choice', array(
                'choices' => array(
                    "1" => "Nutricionista",
                    "2" => "Entrenador",
                    "3" => "Ambos"
                )
            ))
            ->add('nombre')
            ->add('dniempleado')
            ->add('telefono')
            ->add('email')
            ->add('direccion')
            ->add('clave', 'password')
            ->add('privilegios', 'choice', array(
                'choices' => array(
                    "0" => "Regular",
                    "1" => "Administrador"
                    
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MOTO\PrincipalBundle\Entity\Empleado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moto_principalbundle_empleado';
    }
}
