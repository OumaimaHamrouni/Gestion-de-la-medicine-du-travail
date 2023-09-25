<?php

namespace App\Controller;

use App\Entity\Risque;
use App\Entity\Evaluation;
use App\Form\RisqueType;
use App\Form\EvaluationType;
use App\Repository\RisqueRepository;
use App\Repository\EvaluationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/risque")
 */
class RisqueController extends AbstractController
{
    /**
     * @Route("/", name="risque_index", methods={"GET"})
     */
    public function index(RisqueRepository $risqueRepository): Response
    {
        return $this->render('risque/index.html.twig', [
            'risques' => $risqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="risque_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $risque = new Risque();
        $form = $this->createForm(RisqueType::class, $risque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($risque);
            $entityManager->flush();

            return $this->redirectToRoute('risque_index');
        }

        return $this->render('risque/new.html.twig', [
            'risque' => $risque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="risque_show", methods={"GET"})
     */
    public function show(Risque $risque): Response
    {
        return $this->render('risque/show.html.twig', [
            'risque' => $risque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="risque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Risque $risque): Response
    {
        $form = $this->createForm(RisqueType::class, $risque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('risque_index');
        }

        return $this->render('risque/edit.html.twig', [
            'risque' => $risque,
            'form' => $form->createView(),
        ]);
    }


}
