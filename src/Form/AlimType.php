<?php

namespace App\Form;

use App\Entity\Alim;
use App\Entity\Groupe;
use App\Entity\SousGroupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libal', EntityType::class, [
                'class' => 'App\Entity\Alim',
                'choice_label' => 'libal'
            ])
            ->getForm();

        /*
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();

                $data = $event->getData();

                $groupe = $data->getGroupe();
                
                $sousgroupe = null === $groupe ? [] : $groupe->getAvailableSousGroupe();

                $form->add('sousgroupe', EntityType::class, [
                    'class' => SousGroupe::class,
                    'placeholder' => '',
                    'choices' => $sousgroupe,
                ]);
            }
        );
        */
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Alim::class,
            'method' => 'POST',
        ]);
    }
}
