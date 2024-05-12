<?php

namespace App\Form;

use App\Entity\Dispo;
use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DispoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', null, [
                'widget' => 'single_text',
            ])
            ->add('dateFin', null, [
                'widget' => 'single_text',
            ])
            ->add('prixParJour')
            ->add('statut', ChoiceType::class,[
                'choices'=>[
                    'Disponible'=>'Disponible',
                    'Non disponible'=>'Non disponible',
                ]
            ])
           /* ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])*/
            ->add('vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => 'marque',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dispo::class,
        ]);
    }
}