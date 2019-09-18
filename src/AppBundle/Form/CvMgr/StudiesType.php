<?php

namespace AppBundle\Form\CvMgr;

use AppBundle\Entity\CvMgr\CVCategories;
use AppBundle\Repository\CvMgr\CVCategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudiesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('vStudiesLevel',   EntityType::class, array(
            'label' => 'Level',
            'attr' => array('class'=>'form-control '),
            'class' => CVCategories::class,
            'query_builder' => function(CVCategoriesRepository  $r)  {
              return $r->getCVCategoriesQueryBuilder('Studies', 'study level');}
          ))
          ->add('vStudiesCentre',  TextType::class, array(
            'label' => 'Centre',
            'attr' => array('class'=>'form-control ')
          ))
          ->add('vCategory',   EntityType::class, array(
            'label' => 'Category',
            'attr' => array('class'=>'form-control '),
            'class' => CVCategories::class,
            'query_builder' => function(CVCategoriesRepository  $r)  {
              return $r->getCVCategoriesQueryBuilder('Studies', 'study category');}
          ))
          ->add('vStudiesCode',  EntityType::class, array(
            'label' => 'Family',
            'class' => CVCategories::class,
            'attr' => array('class'=>'form-control '),
            'query_builder' => function(CVCategoriesRepository  $r)  {
                 return $r->getCVCategoriesQueryBuilder('Studies', 'study family');}
          ))
          ->add('vDescription',  TextareaType::class, array(
            'label' => 'Description',
            'attr' => array('class'=>'form-control textarea')
          ))
          ->add('dStartDate',  TextType::class, array(
            'attr' => array('class'=>'form-control')
              ))
          ->add('dEndDate', TextType::class,  array(
            'attr' => array('class'=>'form-control')
          ))

          ->add('save', SubmitType::class, array('label' => 'Continue',  'attr' => array('class'=>'btn btn-primary')))
          ->add('saveAndAdd', SubmitType::class, array('label' => 'Save and Add another',  'attr' => array('class'=>'btn btn-secondary')))
        ;
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CvMgr\Studies'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_studies';
    }


}
