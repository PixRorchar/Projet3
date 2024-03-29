<?php

namespace App\Controller;

use App\Entity\Alim;
use App\Entity\Groupe;
use App\Entity\Repas;
use App\Entity\SousGroupe;
use App\Form\AlimType;
use App\Form\RepasType;
use App\Form\SousGroupeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepasController extends AbstractController
{
    /**
     * @Route("/repas", name="repas")
     */
    public function index(): Response
    {
        return $this->render('repas/index.html.twig', [
            'controller_name' => 'RepasController',
        ]);
    }

    /**
     * @Route("/repas2", name="repas2")
     */
    public function declaration_repas(Request $request, EntityManagerInterface $manager): Response
    {

        $repas = new Repas();

        $form = $this->createForm(RepasType::class, $repas);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //return $this->redirectToRoute('main/index.html.twig');
        }

        return $this->render('main/repas2.html.twig', [
            'form' => $form->createView(),
        ]);




        /*
        $alim = new Alim();

        $form = $this->createFormBuilder($alim)
            ->add('libal', EntityType::class, [
                'class' => 'App\Entity\Alim',
                'choice_label' => 'libal'
            ])
            ->getForm();

        $sousgroupe = new SousGroupe();

        $form2 = $this->createFormBuilder($sousgroupe)
            ->add('sougr', EntityType::class, [
                'class' => 'App\Entity\SousGroupe',
                'choice_label' => 'sougr'
            ])
            ->getForm();

        $groupe = new Groupe();

        $form3 = $this->createFormBuilder($groupe)
            ->add('groupe', EntityType::class, [
                'class' => 'App\Entity\Groupe',
                'choice_label' => 'groupe'
            ])
            ->getForm();

        $form->handleRequest($request);
        $form2->handleRequest($request);
        $form3->handleRequest($request);

        return $this->render('main/repas.html.twig', [
            'formAlim' => $form->createView(),
            'formSougr' => $form2->createView(),
            'formGroupe' => $form3->createView()
        ]);
        */
    }
}
