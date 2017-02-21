<?php

namespace Apitic\AnimalsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimalsEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      $builder->addEventListener( FormEvents::PRE_SET_DATA, function(FormEvent $event) {
        $animal = $event->getData();

        if (null === $animal) {
          return;
        }

        $form = $event->getForm();
        switch ($animal->getType()->getId()) {
          case 1: /*Reptile*/
            $form->add('scale');
            break;
          case 2: /*Mammifère*/
            $form->add('fur');
            break;
          case 3: /*Oiseaux*/
            $form->add('feathers');
            break;
        }
      });

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'apitic_animalsbundle_animals_edit';
    }

    public function getParent()
    {
      return new AnimalsType();
  }
    
}
