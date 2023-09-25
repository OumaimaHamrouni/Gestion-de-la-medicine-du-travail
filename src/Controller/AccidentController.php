<?php

namespace App\Controller;

use App\Entity\Accident;
use App\Form\AccidentType;
use App\Repository\AccidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accident")
 */
class AccidentController extends AbstractController
{
    /**
     * @Route("/", name="accident_index", methods={"GET"})
     */
    public function index(AccidentRepository $accidentRepository): Response
    {
        $accident = $accidentRepository->accident();


        return $this->render('accident/index.html.twig', [
            'accident' => $accident
        ]);
    }


    /**
     * @Route("/new", name="accident_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accident = new Accident();
        $form = $this->createForm(AccidentType::class, $accident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accident);
            $entityManager->flush();

            return $this->redirectToRoute('accident_index');
        }

        return $this->render('accident/new.html.twig', [
            'accident' => $accident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accident_show", methods={"GET"})
     */
    public function show(Accident $accident): Response
    {
        return $this->render('accident/show.html.twig', [
            'accident' => $accident,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="accident_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accident $accident): Response
    {
        $form = $this->createForm(AccidentType::class, $accident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accident_index');
        }

        return $this->render('accident/edit.html.twig', [
            'accident' => $accident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accident_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Accident $accident): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accident->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accident);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accident_index');
    }
}
