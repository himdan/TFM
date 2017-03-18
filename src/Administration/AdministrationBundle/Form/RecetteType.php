<?php

namespace Administration\AdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Administration\AdministrationBundle\Form\MediaType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecetteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('activeRecette', ChoiceType::class, array(
                'choices'  => array(
                    1 => 'Activé',
                    0 => 'Désactivé'
                ),
                'label' => 'budget','required'  => true,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')
            ))
            ->add('nomRecette', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'testcopie form-control input-sm','placeholder'=>'Titre')))
            ->add('preparationRecette', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('descriptionIngredientRecette', 'textarea', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm ckeditor','placeholder'=>'Titre')))
            ->add('descriptionRecette', 'textarea', array('required'  => false,'attr'=>array('class'=>'testcopie ckeditor')))
            ->add('cuissonRecette', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('rendementRecette', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('image', new MediaType(), array('required'  => false,'label' => 'budget'))
            ->add('ingredient','entity',array('multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Ingredient','required'  => false,'attr' => array('class' => 'has-error form-control input-sm chosen-select','data-placeholder' => '-- Choisir un/des ingredients --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('difficulte','entity',array('required' => false,'empty_value' => 'Choisissez une difficulte','class'=>'Administration\AdministrationBundle\Entity\Difficulte','attr' => array('class' => 'form-control input-sm chosen-select','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('nationalite','entity',array('required'  => false,'empty_value' => 'Choisissez une nationalité','class'=>'Administration\AdministrationBundle\Entity\Nationalite','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir un/des Theme --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('theme','entity',array('multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Theme','required'  => false,'attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir un/des Theme --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('prix','entity',array('required'  => false,'empty_value' => 'Choisissez un prix','class'=>'Administration\AdministrationBundle\Entity\Prix','attr' => array('class' => 'form-control input-sm chosen-select','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('menu','entity',array('required'  => false,'empty_value' => 'Choisissez un menu','class'=>'Administration\AdministrationBundle\Entity\Menu','attr' => array('class' => 'form-control input-sm chosen-select','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('typecuisson','entity',array('required'  => false,'empty_value' => 'Choisissez une nationalité','multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\TypeCuisson','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir un/des type cuisson --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('saison','entity',array('required'  => false,'empty_value' => 'Choisissez une nationalité','multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Saison','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir une/des saison --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('subcategorie','entity',array('empty_value' => 'Choisissez une nationalité','multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\SubCategorie','required'  => false,'attr' => array('class' => 'subcategorieclass form-control ','data-placeholder' => '-- Choisir une/des subcategorie --','title'=>'Veuillez renseigner l\'etat intial de projet')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Administration\AdministrationBundle\Entity\Recette'
        ));
    }
}
