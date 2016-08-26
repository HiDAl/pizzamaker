<?php

namespace PizzaMakerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PizzaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredients', 'entity', array(
                'multiple' => true,
                'expanded' => true,
                'property' => 'id',
                'class'    => 'PizzaMakerBundle\Entity\Ingredient'
            ))
            ->add('name')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'data_class' => 'PizzaMakerBundle\Entity\Pizza',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
