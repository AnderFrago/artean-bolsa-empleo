<?php

namespace AppBundle\Form\UserMgr;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormerStudentsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       // $builder->add('vNif')->add('vName')->add('vSurnames')->add('vAddress')->add('dBirthDate')->add('bVehicle');
      $builder->add('vNif',  TextType::class, array(
        'label' => 'NIF',
        'attr' => array('class'=>'form-control  ')
      ))
        ->add('vName',  TextType::class, array(
          'label' => 'Name',
          'attr' => array('class'=>'form-control ')
        ))
        ->add('vSurnames',  TextType::class, array(
          'label' => 'Surnames',
          'attr' => array('class'=>'form-control')
        ))
        ->add('vAddress',  TextType::class, array(
          'label' => 'Address',
          'attr' => array('class'=>'form-control')
        ))
        ->add('dBirthDate',  DateType::class, array(
          'label' => 'BirthDate',
          'attr' => array('class'=>'form-control')
        ))
        ->add('bVehicle',  CheckboxType::class, array(
          'label' => 'Vehicle',
          'attr' => array('class'=>'form-control ')
        ))
        ->add('save', SubmitType::class, array('label' => 'Continue',  'attr' => array('class'=>'btn btn-primary')));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserMgr\FormerStudents'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_formerstudents';
    }


}
