<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\SousGroupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groupe')
            ->add('code')
        ;

        $formModifier = function (FormInterface $form, Groupe $group = null) {
            $alim = null === $group ? [] : $group->getSousGroupes();

            $form->add('alims', EntityType::class, [
                'class' => SousGroupe::class,
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,
        ]);
    }
}
