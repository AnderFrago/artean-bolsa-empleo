<?php

namespace App\Form\CvMgr;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OtherknowledgeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('vName',  TextType::class, array(
                            'label' => 'Name',
                            'attr' => array('class'=>'form-control  ')
                    ))
          ->add('vTitle',  TextType::class, array(
                  'label' => 'Degree',
                  'attr' => array('class'=>'form-control ')
                ))
          ->add('ltextDescription',  TextareaType::class, array(
            'label' => 'Description',
            'attr' => array('class'=>'form-control textarea')
          ))

          ->add('save', SubmitType::class, array('label' => 'Continue',  'attr' => array('class'=>'btn btn-primary')))
          ->add('saveAndAdd', SubmitType::class, array('label' => 'Save and Add another one',  'attr' => array('class'=>'btn btn-secondary')))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\CvMgr\Otherknowledge'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'App_otherknowledge';
    }


}
