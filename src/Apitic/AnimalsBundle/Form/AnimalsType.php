<?php

namespace Apitic\AnimalsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimalsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name')
        ->add('type', 'entity', array(
          'class'    => 'ApiticAnimalsBundle:Types',
          'property' => 'name',
          'multiple' => false,
          'expanded' => false
          ))
        ->add('save', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
          'data_class' => 'Apitic\AnimalsBundle\Entity\Animals'
          ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'apitic_animalsbundle_animals';
    }
    
}
