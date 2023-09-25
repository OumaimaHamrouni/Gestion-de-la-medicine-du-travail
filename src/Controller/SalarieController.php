<?php

namespace App\Controller;

use App\Entity\DossierMedical;
use App\Entity\Salarie;
use App\Entity\PosteDeTravail;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Component\HttpFoundation\File\File;

use App\Form\SalarieType;
use App\Repository\SalarieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator
/**
 *
 * @Route("/salarie")
 */
class SalarieController extends AbstractController
{
    /**
     *
     * @Route("/", name="salarie_index")
     */
    public function index( SalarieRepository $salarieRepository ,Request $request): Response
    {
        $salarie = $this->getDoctrine()->getRepository(Salarie::class)->findAll();
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des articles est vide,
        //c.a.d on affiche les salarie que lorsque l'utilisateur clique sur le bouton rechercher


        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le matricule de salarie tapé dans le formulaire
            $matricule = $propertySearch->getMatricule();
            if ($matricule!="")
                //si on a fourni une matricule de salarie on affiche le salarie ayant ce matricule
                $salarie= $this->getDoctrine()->getRepository(Salarie::class)->findBy(['matricule' => $matricule] );
            else
                //si si aucun matricule n'est fourni on affiche tous les articles
                $salarie = $this->getDoctrine()->getRepository(Salarie::class)->findAll();
        }
        return  $this->render('salarie/index.html.twig',[
            'form' =>$form->createView(),
            'salarie' => $salarie,
        ]);
    }

    /**
     * *
     * @Route("/new", name="salarie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $salarie = new Salarie();
        $form = $this->createForm(SalarieType::class, $salarie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('photo')->getData();

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
                $salarie->setphoto($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($salarie);
            $entityManager->flush();


            return $this->redirectToRoute('salarie_index');
        }

        return $this->render('salarie/new.html.twig', [
            'salarie' => $salarie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salarie_show", methods={"GET"})
     */
    public function show(Salarie $salarie): Response
    {
        return $this->render('salarie/show.html.twig', [
            'salarie' => $salarie,
        ]);
    }

    /**
     *
     * @Route("/{id}/edit", name="salarie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Salarie $salarie): Response

    {

        $poste_de_travail =$this->getDoctrine()->getRepository(PosteDeTravail::class)->findAll();

        $form = $this->createForm(SalarieType::class, $salarie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salarie_index');
        }

        return $this->render('salarie/edit.html.twig', [
            'salarie' => $salarie,
            'form' => $form->createView(),
            'poste_de_travail' => $poste_de_travail ,
        ]);
    }

    /**
     * @Route("/{id}", name="salarie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Salarie $salarie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $salarie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $dossier_medical = $this->getDoctrine()->getRepository(DossierMedical::class)->findBy(array("IDS" => $salarie));
            foreach ($dossier_medical as $dossier_medical) {
                $entityManager->remove($salarie);
                $entityManager->remove($dossier_medical);
                $entityManager->flush();

            }

            return $this->redirectToRoute('salarie_index');
        }
    }

}

