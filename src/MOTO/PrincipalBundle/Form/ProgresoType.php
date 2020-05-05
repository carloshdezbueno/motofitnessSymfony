<?php

namespace MOTO\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProgresoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imagen', 'file')
            ->add('peso')
            ->add('medidas')
            ->add('fecha');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MOTO\PrincipalBundle\Entity\Progreso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moto_principalbundle_progreso';
    }
}
