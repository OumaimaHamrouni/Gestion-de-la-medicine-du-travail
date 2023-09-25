<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\User;
use App\Form\AdminType;
use App\Repository\AdminRepository;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'admins' => $adminRepository->findAll(),
        ]);
    }
    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */

    /**
     * @Route("/new", name="admin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $admin= new Admin();

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
            $user->setRoles(array("ROLE_SUPER_ADMIN"));
            $user->setEnabled(true);
            $admin->setUser($user);
            $entityManager->persist($admin);
            $entityManager->flush();

            $entityManager->persist($user);
            $entityManager->flush();





            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/new.html.twig', [
            'admin' => $admin,

            'form2' => $form2->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="admin_show", methods={"GET"})
     */
    public function show(Admin $admin): Response
    {
        return $this->render('admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Admin $admin): Response
    {
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'admin' => $admin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Admin $admin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($admin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_index');
    }
}
