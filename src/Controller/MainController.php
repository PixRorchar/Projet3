<?php

namespace App\Controller;

use App\Entity\Alim;
use App\Entity\Candidat;
use App\Entity\Groupe;
use App\Entity\SousGroupe;
use App\Form\AlimType;
use App\Form\GroupeType;
use App\Form\SousGroupeType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/deroulement", name="deroulement")
     */
    public function show_deroulement(): Response
    {
        return $this->render('main/deroulement.html.twig', []);
    }

    /**
     * @Route("/exemple", name="exemple")
     */
    public function show_exemple(): Response
    {
        return $this->render('main/exemple.html.twig', []);
    }

    /**
     * @Route("/Rgpd", name="rgpd")
     */
    public function show_rgpd(): Response
    {
        return $this->render('main/rgpd.html.twig', []);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function show_inscription(Request $request, EntityManagerInterface $manager)
    {
        $candidat = new Candidat();

        $form = $this->createFormBuilder($candidat)
            ->add('Age', IntegerType::class)
            ->add('Sexe', ChoiceType::class, [
                'choices' => [
                    'Femme' => 1,
                    'Homme' => 2,
                    'Autre' => 3,
                ]
            ])
            ->add('Poids', IntegerType::class)
            ->add('Taille', IntegerType::class)
            ->add('Tel', IntegerType::class)
            ->add('email', EmailType::class)
            ->add('email_confirm', EmailType::class)
            ->add('mdp', PasswordType::class)
            ->add('mdp_confirm', PasswordType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidat->setCreatedAt(new \DateTime());

            $manager->persist($candidat);
            $manager->flush();

            return $this->redirectToRoute('deroulement');
        }

        return $this->render('main/inscription.html.twig', [
            'formInscription' => $form->createView()
        ]);
    }

    /**
     * @Route("/repas2", name="repas")
     */
    public function declaration_repas(Request $request, EntityManagerInterface $manager)
    {

        $alim = new Alim();

        $form = $this->createForm(SousGroupeType::class, $alim);

        $form->handleRequest($request);

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

    /**
     * @Route("/test", name="test")
     */
    public function test(Request $request, EntityManagerInterface $em): Response
    {
        $alim = new Alim();
        $form =$this->createForm(GroupeType::class, $alim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alim);
            $em->flush();

            return $this->redirectToRoute('main/test.html.twig', array('id' => $alim->getId()));
        }

        return $this->render('main/test.html.twig', [
            'alim' => $alim,
            'FormRepas' => $form->createView()
        ]);
    }
}
