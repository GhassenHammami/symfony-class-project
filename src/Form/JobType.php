<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Job;
use App\Repository\ImageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('company')
            ->add('description')
            ->add('expires_at', null, [
                'widget' => 'single_text',
            ])
            ->add('email')
            ->add('image', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'id',
                'query_builder' => function (ImageRepository $repo) {
                    return $repo->createQueryBuilder('i')
                        ->leftJoin('App\Entity\Job', 'j', 'WITH', 'j.image = i')
                        ->where('j.id IS NULL');
                },
                'placeholder' => 'Sélectionnez une image',
            ])
            ->add("Valider", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
