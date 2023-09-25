<?php

namespace App\Controller;

use App\Entity\Entreprise;
use Symfony\Component\HttpFoundation\File\File;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entreprise")
 */
class EntrepriseController extends AbstractController
{
    /**
     * @Route("/", name="entreprise_index", methods={"GET"})
     */
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('entreprise/index.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(),
        ]);
    }

    /**

     * @Route("/new", name="entreprise_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {







        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $photo = $form->get('logo')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'photo' property to store the PDF file name
                // instead of its contents
                $entreprise->setlogo($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entreprise->setLogo($newFilename);
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/new.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entreprise_show", methods={"GET"})
     */
    public function show(Entreprise $entreprise): Response
    {
        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entreprise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entreprise $entreprise): Response
    {
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/edit.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entreprise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entreprise $entreprise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entreprise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entreprise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entreprise_index');
    }
}
