<?php

namespace Administration\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SignalRecetteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('texteSignalRecette')
            ->add('objetSignalRecette')
            
            ->add('niveauSignalRecette', ChoiceType::class, array(
                'choices'  => array(
                    'Faible' => 'Faible',
                    'Moyen' => 'Moyen',
                    'Grave' => 'Grave'
                ),
                'label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')
            ));
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Administration\AdministrationBundle\Entity\SignalRecette'
        ));
    }
}
