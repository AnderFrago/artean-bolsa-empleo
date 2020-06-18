<?php

namespace App\Form\OfferMgr;

use App\Entity\CvMgr\CVCategories;
use App\Repository\CvMgr\CVCategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('vOfferCode', TextType::class, [
            'label' => 'Offer code: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('vOfferType', EntityType::class, [
            'label' => 'Working time: ',
            'class' => CVCategories::class,
            'attr' => ['class' => 'form-control  '],
            'query_builder' => function(CVCategoriesRepository  $r)  {
              return $r->getCVCategoriesQueryBuilder('Work Experience', 'working time');}

          ])
          ->add('dActivationDate', TextType::class, [
            'label' => 'Activation date: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('dDueDate', TextType::class, [
            'label' => 'Due date: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('vPosition',  EntityType::class, [
            'label' => 'Position',
            'attr' => ['class'=>'form-control  '],
            'class' => CVCategories::class,
            'query_builder' => function(CVCategoriesRepository  $r)  {
              return $r->getCVCategoriesQueryBuilder('Work Experience', 'position');}

          ])
          ->add('ltextDescription', TextType::class, [
            'label' => 'Description: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('ltextDuties', TextType::class, [
            'label' => 'Funciones: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('ltextExperienceRequirements', TextType::class, [
            'label' => 'Experience requirements: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('vSalaray', TextType::class, [
            'label' => 'Salary: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('vLocation', TextType::class, [
            'label' => 'Location: ',
            'attr' => ['class' => 'form-control  '],
          ])
          ->add('save', SubmitType::class, array('label' => 'Continue',  'attr' => array('class'=>'btn btn-primary')))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\OfferMgr\Offers'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'App_offermgr_offers';
    }


}
