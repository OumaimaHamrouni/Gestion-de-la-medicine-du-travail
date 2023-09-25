<?php

namespace App\Controller;
use App\Entity\Observation;
use App\Entity\Visite;
use App\Entity\DossierMedical;
use App\Form\ObservationType;
use App\Form\VisiteType;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/visite")
 */
class VisiteController extends AbstractController
{



    /**
     * @Route("/", name="visite_index", methods={"GET"})
     */
    public function index(VisiteRepository $visiteRepository): Response
    {
        return $this->render('visite/index.html.twig', [
            'visites' => $visiteRepository->findAll(),
        ]);
    }


    /**
     * @Route("/newE", name="visite_newE", methods={"GET","POST"})
     */
    public function newE(Request $request): Response
    {
        $visite = new Visite();
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);
        $observation = new Observation();
        $form2 = $this->createForm(ObservationType::class, $observation);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&& $form2->isSubmitted() && $form2->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $visite->setType("VISITE D'EMBOUCHE");
            $visite->setIdo($observation);
            $entityManager->persist($visite);
            $entityManager->flush();


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($observation);
            $entityManager->flush();

            return $this->redirectToRoute('visite_index');
        }

        return $this->render('visite/newE.html.twig', [
            'visite' => $visite,
            'observation' => $observation,
            'form' => $form->createView(),
            'form2'=>$form2->createView(),
        ]);
    }
    /**
     * @Route("/newP", name="visite_newP", methods={"GET","POST"})
     */
    public function newP(Request $request): Response
    {
        $visite = new Visite();
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);
        $observation = new Observation();
        $form2 = $this->createForm(ObservationType::class, $observation);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&& $form2->isSubmitted() && $form2->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $visite->setType("visite périodique");
            $visite->setIdo($observation);
            $entityManager->persist($visite);
            $entityManager->flush();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($observation);
            $entityManager->flush();

            return $this->redirectToRoute('visite_index');
        }

        return $this->render('visite/newP.html.twig', [
            'visite' => $visite,
            'observation' => $observation,
            'form' => $form->createView(),
            'form2'=>$form2->createView(),
        ]);
    }

    /**
     * @Route("/newR", name="visite_newR", methods={"GET","POST"})
     */
    public function newR(Request $request): Response
    {
        $visite = new Visite();
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);
        $observation = new Observation();
        $form2 = $this->createForm(ObservationType::class, $observation);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&& $form2->isSubmitted() && $form2->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $visite->setType("visite de reprise");
            $visite->setIdo($observation);
            $entityManager->persist($visite);

            $entityManager->flush();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($observation);

            $entityManager->flush();



            return $this->redirectToRoute('visite_index');
        }

        return $this->render('visite/newR.html.twig', [
            'visite' => $visite,
            'observation' => $observation,
            'form' => $form->createView(),
            'form2'=>$form2->createView(),
        ]);
    }





    /**
     * @Route("/{id}", name="visite_show", methods={"GET"})
     */
    public function show(Visite $visite): Response
    {
        return $this->render('visite/show.html.twig', [
            'visite' => $visite,

        ]);
    }

    /**
     * @Route("/{id}/edit", name="visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Visite $visite ): Response
    {


        $visite =$this->getDoctrine()->getRepository(Visite::class)->findOneBy(array("id"=>$visite));
        $observation=$visite->getIdo();
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);
        $form2 = $this->createForm(ObservationType::class, $observation);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&&$form2->isSubmitted() && $form2->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('visite_index');
        }


        return $this->render('visite/edit.html.twig', [
            'visite' => $visite
            ,
            'form' => $form->createView(),
            'form2' => $form2->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Visite $visite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($visite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visite_index');
    }
}
