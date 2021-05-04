<?php

namespace App\Form;

use App\Entity\Alim;
use App\Entity\SousGroupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousGroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sougr', EntityType::class, [
                'class' => SousGroupe::class,
                'placeholder' => '',
            ]);

        $formModifier = function (FormInterface $form, SousGroupe $sougr = null) {
            $alim = null === $sougr ? [] : $sougr->getAlims();

            $form->add('alims', EntityType::class, [
                'class' => Alim::class,
                'placeholder' => '',
                'choices' => $alim,
            ]);

        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {

                $data = $event->getData();

                $formModifier($event->getForm(), $data);               
            }
        );

    /*    $builder->get('sougr')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $sougr = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $sougr);
            } 
        ); */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousGroupe::class,
        ]);
    }
}
