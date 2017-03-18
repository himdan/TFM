<?php

namespace Administration\AdministrationBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EtablissementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('adresseEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('image', new MediaType())
            ->add('postaleEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('telOneEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('telTwoEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('telThreeEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('emailEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('webEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('facebookEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))

            ->add('latEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('longEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('categorie','entity',array('multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Categorie','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir une categorie --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('region','entity',array('class'=>'Administration\AdministrationBundle\Entity\Region','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir une categorie --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('gouvernorat','entity',array('class'=>'Administration\AdministrationBundle\Entity\Gouvernorat','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir une categorie --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('filtre','entity',array('multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Filtre','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir une specialite --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('ambiance','entity',array('multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Ambiance','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir une ambiance --','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('specialite','entity',array('multiple'=>true,'class'=>'Administration\AdministrationBundle\Entity\Specialite','attr' => array('class' => 'form-control input-sm chosen-select','data-placeholder' => '-- Choisir un filtre --','title'=>'Veuillez renseigner l\'etat intial de projet')))

            ->add('horraireFromFirstEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('horraireToFirstEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('horraireFromSecondEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('horraireToSecondEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('budgetEtablissement', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))



        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Administration\AdministrationBundle\Entity\Etablissement'
        ));
    }
}
