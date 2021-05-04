<?php

namespace App\Form;

use App\Entity\Alim;
use App\Entity\Groupe;
use App\Entity\SousGroupe;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $sousGroupe = $options['data']['sousGroupe'] ?? null;
        $groupe = $options['data']['groupe'] ?? null;
        if (null !== $sousGroupe) {
            $builder->add('groupe', EntityType::class, [
                'mapped' => false,
                'class' => Groupe::class,
                'choice_label' => 'groupe',
                'query_builder' => function (EntityRepository $r) use ($groupe) {
                    $qb = $r->createQueryBuilder('r');
                    $qb->where('r.id = :sousGroupe')->setParameter('sousGroupe', $groupe);

                    return $qb;
                }
            ])->add(
                'sousGroupe',
                EntityType::class,
                [
                    'mapped'        => false,
                    'class'         => SousGroupe::class,
                    'choice_label'  => 'sougr',
                    'query_builder' => function (EntityRepository $r) use ($sousGroupe) {
                        $qb = $r->createQueryBuilder('r');
                        $qb->where('r.id = :sousGroupe')->setParameter('sousGroupe', $sousGroupe);

                        return $qb;
                    }
                ]
            );
            $builder->add(
                'alims',
                EntityType::class,
                [
                    'mapped'        => false,
                    'class'         => Alim::class,
                    'choice_label'  => 'code',
                    'query_builder' => function (EntityRepository $r) use ($sousGroupe) {
                        $qb = $r->createQueryBuilder('r');
                        $qb->where('r.SousGroupe = :sousGroupe')->setParameter('sousGroupe', $sousGroupe);

                        return $qb;
                    }
                ]
            )
                    ->add('submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
