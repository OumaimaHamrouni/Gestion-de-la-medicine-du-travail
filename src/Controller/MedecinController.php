<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\User;
use App\Form\MedecinType;
use App\Repository\MedecinRepository;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator
/**
 * @Route("/medecin")
 */
class MedecinController extends AbstractController
{
    /**
     * @Route("/", name="medecin_index", methods={"GET"})
     */
    public function index(MedecinRepository $medecinRepository , Request $request, PaginatorInterface $paginator): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Medecin::class)->findBy([],['id' => 'asc']);

        $medecin= $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            2 // Nombre de résultats par page
        );

        return $this->render('medecin/index.html.twig', [
            'medecin' => $medecin,
        ]);

    }

    /**
     * @Route("/new", name="medecin_new", methods={"GET","POST"})
     */
    public function new(Request $request ): Response
    {
        $medecin = new Medecin();

        $user = new User();
        $form2 = $this->createForm( RegistrationFormType::class, $user);
        $form2->handleRequest($request);

        if ( $form2->isSubmitted() && $form2->isValid()) {
            $photo = $form2->get('photo')->getData();

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
                $user->setphoto($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $user->setRoles(array("ROLE_MEDECIN"));
            $user->setEnabled(true);
            $medecin->setUser($user);
            $entityManager->persist($medecin);
            $entityManager->flush();

            $entityManager->persist($user);
            $entityManager->flush();





            return $this->redirectToRoute('medecin_index');
        }

        return $this->render('medecin/new.html.twig', [
            'medecins' => $medecin,

            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medecin_show", methods={"GET"})
     */
    public function show(Medecin $medecin): Response
    {
        return $this->render('medecin/show.html.twig', [
            'medecin' => $medecin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medecin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medecin $medecin): Response
    {


        $medecin =$this->getDoctrine()->getRepository(Medecin::class)->findOneBy(array("id"=>$medecin));
        $user=$medecin->getUser();

        $form2 = $this->createForm(RegistrationFormType::class, $user);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('medecin_index');
        }


        return $this->render('medecin/edit.html.twig', [
            'medecin' => $medecin
            ,

            'form2' => $form2->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="medecin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medecin $medecin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medecin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medecin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medecin_index');
    }
}
