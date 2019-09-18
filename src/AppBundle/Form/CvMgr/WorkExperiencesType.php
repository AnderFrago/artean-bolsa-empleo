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

class WorkExperiencesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('vPosition',  EntityType::class, [
                            'label' => 'Position',
                            'attr' => ['class'=>'form-control  '],
                            'class' => CVCategories::class,
                            'query_builder' => function(CVCategoriesRepository  $r)  {
                              return $r->getCVCategoriesQueryBuilder('Work Experience', 'position');}

          ])
          ->add('vEmployer',  TextType::class, [
                      'label' => 'Company',
                      'attr' => ['class'=>'form-control ']
          ])
          ->add('vLocation',  TextType::class, [
                  'label' => 'Location',
                  'attr' => ['class'=>'form-control ']
          ])
          ->add('ltextDuties',  TextareaType::class, [
            'label' => 'Duties',
            'attr' => ['class'=>'form-control textarea']
          ])
          ->add('dStartDate', TextType::class, [
            'label' => 'Start date',
            'attr' =>['class'=>'form-control  ']
          ])
          ->add('dEndDate', TextType::class, [
            'label' => 'End date',
            'attr' => ['class'=>'form-control  ']
          ])
          ->add('save', SubmitType::class, ['label' => 'Continue',  'attr' => ['class'=>'btn btn-primary']])
          ->add('saveAndAdd', SubmitType::class, ['label' => 'Save and Add another', 'attr' => ['class'=>'btn btn-secondary']])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\CvMgr\WorkExperiences'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_workexperiences';
    }


}
