<?php

namespace Administration\AdministrationBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Administration\AdministrationBundle\Form\MediaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nomArticle', 'text', array('label' => 'budget','required'  => false,'attr' => array('class' => 'form-control input-sm','placeholder'=>'Titre')))
            ->add('descriptionArticle', 'textarea', array('attr'=>array('class'=>'ckeditor')))
            ->add('image', new MediaType())

            ->add('typeArticle', ChoiceType::class, array(
                'choices'  => array(
                    'article' => 'article',
                    'video' => 'video'
                ),'attr' => array('class' => 'form-control input-sm','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('langue','entity',array('class'=>'Administration\AdministrationBundle\Entity\Langue','attr' => array('class' => 'form-control input-sm','title'=>'Veuillez renseigner l\'etat intial de projet')))
            ->add('topic','entity',array('class'=>'Administration\AdministrationBundle\Entity\Topic','attr' => array('class' => 'form-control input-sm','title'=>'Veuillez renseigner l\'etat intial de projet')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Administration\AdministrationBundle\Entity\Article'
        ));
    }
}
