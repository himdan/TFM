<?php

namespace Administration\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SpecialiteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomSpecialite', 'text', array('required'=>true,'label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre','title'=>'ajout')))
            ->add('categorie','entity',array('multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Categorie','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir une categorie --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('statutSpecialite', ChoiceType::class, array(
                'choices'  => array(
                    1 => 'Activé',
                    0 => 'Désactivé'
                ),
                'label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')
            ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Administration\AdministrationBundle\Entity\Specialite'
        ));
    }
}
