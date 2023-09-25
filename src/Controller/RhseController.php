<?php

namespace App\Controller;

use App\Entity\Rhse;
use App\Entity\User;
use App\Form\RhseType;
use App\Repository\RhseRepository;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator
/**
 * @Route("/rhse")
 */
class RhseController extends AbstractController
{
    /**
     * @Route("/", name="rhse_index", methods={"GET"})
     */
    public function index(RhseRepository $rhseRepository , Request $request, PaginatorInterface $paginator): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Rhse::class)->findBy([],['id' => 'asc']);

        $rhse= $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            2 // Nombre de résultats par page
        );

        return $this->render('rhse/index.html.twig', [
            'rhse' => $rhse,
        ]);

    }

    /**
     * @Route("/new", name="rhse_new", methods={"GET","POST"})
     */
    public function new(Request $request ): Response
    {
        $rhse= new Rhse();

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
            $user->setRoles(array("ROLE_RHSE"));
            $user->setEnabled(true);
            $rhse->setUser($user);
            $entityManager->persist($rhse);
            $entityManager->flush();

            $entityManager->persist($user);
            $entityManager->flush();





            return $this->redirectToRoute('rhse_index');
        }

        return $this->render('rhse/new.html.twig', [
            'rhse' => $rhse,

            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rhse_show", methods={"GET"})
     */
    public function show(Rhse $rhse): Response
    {
        return $this->render('rhse/show.html.twig', [
            'rhse' => $rhse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rhse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rhse $rhse): Response
    {


        $rhse =$this->getDoctrine()->getRepository(Rhse::class)->findOneBy(array("id"=>$rhse));
        $user=$rhse->getUser();

        $form2 = $this->createForm(RegistrationFormType::class, $user);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('rhse_index');
        }


        return $this->render('rhse/edit.html.twig', [
            'rhse' => $rhse
            ,

            'form2' => $form2->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="rhse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rhse $rhse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rhse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rhse_index');
    }
}
