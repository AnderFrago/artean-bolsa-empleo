<?php

namespace App\Form\UserMgr;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeersType extends AbstractType {

  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('vCIF', TextType::class, [
        'label' => 'CIF: ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('vName', TextType::class, [
        'label' => 'Nombre: ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('vLogo', TextType::class, [
        'label' => 'Logo: ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('vDescription', TextType::class, [
        'label' => 'Descripción: ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('vContactName', TextType::class, [
        'label' => 'Persona de contacto (Nombre): ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('vContactPhone', TextType::class, [
        'label' => 'Telefono de contacto:: ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('vContactMail', TextType::class, [
        'label' => 'Email de contacto: ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('vLocation', TextType::class, [
        'label' => 'Localización: ',
        'attr' => ['class' => 'form-control'],
      ])
      ->add('nNumberOfWorkers', TextType::class, [
        'label' => 'Número de trabajadores: ',
        'attr' => ['class' => 'form-control'],
      ])

      ->add('save', SubmitType::class, array('label' => 'Continue',  'attr' => array('class'=>'btn btn-primary')));
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => 'App\Entity\UserMgr\Employeers',
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix() {
    return 'App_usermgr_employeers';
  }


}
