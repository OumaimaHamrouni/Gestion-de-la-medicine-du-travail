<?php

namespace App\Controller;



use App\Entity\Enquette;
use App\Entity\Accident;
use App\Form\EnquetteType;
use App\Form\AccidentType;
use App\Repository\EnquetteRepository;
use App\Repository\AccidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/enquette")
 */
class EnquetteController extends AbstractController

{   /**
 * @Route("/calendar", name="enquette/calendar", methods={"GET"})
 */
    public function calendar(): Response
    {
        return $this->render('enquette/calendar.html.twig');
    }




    /**
     * @Route("/new", name="enquette_new", methods={"GET","POST"})
     */
    public function new(Request $request ): Response
    {
        $enquette = new Enquette();
        $form = $this->createForm(EnquetteType::class, $enquette);
        $form->handleRequest($request);
        $accident = new Accident();
        $form2 = $this->createForm(AccidentType::class, $accident);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&& $form2->isSubmitted() && $form2->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $enquette->setIda($accident);
               $entityManager->persist($enquette);
            $entityManager->flush();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accident);
            $entityManager->flush();

            return $this->redirectToRoute('enquette/calendar');
        }

        return $this->render('enquette/new.html.twig', [
            'enquette' => $enquette,
            'accident' => $accident,
            'form' => $form->createView(),
            'form2'=>$form2->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="enquette_show", methods={"GET"})
     */
    public function show(Enquette $enquette): Response
    {
        return $this->render('enquette/show.html.twig', [
            'enquette' => $enquette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enquette_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enquette $enquette): Response
    {


        $enquette =$this->getDoctrine()->getRepository(Enquette::class)->findOneBy(array("id"=>$enquette));
        $accident=$enquette->getIda();
        $form = $this->createForm(EnquetteType::class, $enquette);
        $form->handleRequest($request);
        $form2 = $this->createForm(AccidentType::class, $accident);
        $form2->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()&&$form2->isSubmitted() && $form2->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('enquette/calendar');
        }


        return $this->render('enquette/edit.html.twig', [
            'enquette' => $enquette
            ,
            'form' => $form->createView(),
            'form2' => $form2->createView(),

        ]);
    }


}
