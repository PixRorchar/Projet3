<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Repas;
use App\Entity\SousGroupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('groupe', EntityType::class, [
                'class' => Groupe::class,
                'placeholder' => '',
                'mapped' => false
            ])
        ;
        $formModifier = function (FormInterface $form, Groupe $groupe = null) {
            $sousGroupes = null === $groupe ? [] : $groupe->getSousGroupes();

            $form->add('sousGroupes', EntityType::class, [
                'class' => SousGroupe::class,
                'placeholder' => '',
                'choices' => $sousGroupes,
                'mapped' => false
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                dump($event->getData());
                $data = $event->getData();
                $formModifier($event->getForm(), $event->getForm()->getExtraData()['groupe'] ?? null);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Repas::class,
            'allow_extra_fields' => true,
            'csrf_protection' => false,

        ]);
    }
}
