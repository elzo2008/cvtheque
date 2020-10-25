<?php

namespace App\Form;

use App\Entity\Cv;
use App\Entity\Civilite;
use App\Entity\NiveauEtude;
use App\Entity\Region;
use App\Entity\SituationProfessionnelle;
use App\Entity\Specialiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('dateNaiss', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'))
            ->add('adresse')
            ->add('tel')
            ->add('mail')
            ->add('anneesExperience')
            ->add('civilite', EntityType::class,
                array('class' => Civilite::class, 'choice_label' => 'description', 'label' => 'CIVILITE'))
            ->add('niveauEtude', EntityType::class,
                array('class' => NiveauEtude::class, 'choice_label' => 'description', 'label' => 'NIVEAU ETUDE'))
            ->add('region', EntityType::class,
                array('class' => Region::class, 'choice_label' => 'description', 'label' => 'REGION'))
            ->add('situationProfessionnelle', EntityType::class,
                array('class' => SituationProfessionnelle::class, 'choice_label' => 'description', 'label' => 'SITUATION PROFESSIONNELLE'))
            ->add('specialiste', EntityType::class,
                array('class' => Specialiste::class, 'choice_label' => 'description', 'label' => 'SPECIALISTE'))
            ->add('motivation')
            ->add('cvFile', FileType::class, [
                    'required' => false 
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
}
