<?php

namespace App\Form;

use App\BusinessDataBundle\Entity\Coverage;
use App\BusinessDataBundle\Entity\RecourseToExerciseType;
use App\Entity\Alim;
use App\Entity\Groupe;
use App\Entity\SousGroupe;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousGroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $groupe = $options['data']['groupe'] ?? null;
        if (null !== $groupe) {
            $builder->add('groupe', EntityType::class, [
                'mapped' => false,
                'class' => Groupe::class,
                'choice_label' => 'groupe',
                'query_builder' => function (EntityRepository $r) use ($groupe) {
                    $qb = $r->createQueryBuilder('r');
                    $qb->where('r.id = :groupe')->setParameter('groupe', $groupe);

                    return $qb;
                }
            ]);
            $builder->add(
                'sousGroupe',
                EntityType::class,
                [
                    'mapped'        => false,
                    'class'         => SousGroupe::class,
                    'choice_label'  => 'sougr',
                    'query_builder' => function (EntityRepository $r) use ($groupe) {
                        $qb = $r->createQueryBuilder('r');
                        $qb->where('r.Groupe = :groupe')->setParameter('groupe', $groupe);

                        return $qb;
                    }
                ]
            )
                    ->add('submit', SubmitType::class);
        } else {
            $builder->add(
                'sousGroupe',
                EntityType::class,
                [
                    'mapped'        => false,
                    'class'         => SousGroupe::class,
                    'choice_label'  => 'sougr'
                ]
            )
                    ->add('submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => null,
            ]
        );
    }
}
