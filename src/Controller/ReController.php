<?php

namespace App\Controller;

use App\Entity\Re;
use App\Entity\User;
use App\Form\ReType;
use App\Repository\ReRepository;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/re")
 */
class ReController extends AbstractController
{
    /**
     * @Route("/", name="re_index", methods={"GET"})
     */
    public function index(ReRepository $reRepository): Response
    {
        return $this->render('re/index.html.twig', [
            'res' => $reRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="re_new", methods={"GET","POST"})
     */
    public function new(Request $request ): Response
    {
        $re= new Re();
        $form = $this->createForm( ReType::class, $re);
        $form->handleRequest($request);
        $user = new User();
        $form2 = $this->createForm( RegistrationFormType::class, $user);
        $form2->handleRequest($request);

        if ( $form2->isSubmitted() && $form2->isValid() && $form->isSubmitted() && $form->isValid()) {
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
            $user->setRoles(array("ROLE_RE"));
            $user->setEnabled(true);
            $re->setUser($user);
            $entityManager->persist($re);
            $entityManager->flush();

            $entityManager->persist($user);
            $entityManager->flush();





            return $this->redirectToRoute('re_index');
        }

        return $this->render('re/new.html.twig', [
            're' => $re,
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="re_show", methods={"GET"})
     */
    public function show(Re $re): Response
    {
        return $this->render('re/show.html.twig', [
            're' => $re,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="re_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Re $re): Response
    {


$re =$this->getDoctrine()->getRepository(Re::class)->findOneBy(array("id"=>$re));
$user=$re->getUser();
$form = $this->createForm(ReType::class, $re);
$form->handleRequest($request);
$form2 = $this->createForm(RegistrationFormType::class, $user);
$form2->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()&&$form2->isSubmitted() && $form2->isValid()) {

$this->getDoctrine()->getManager()->flush();
return $this->redirectToRoute('re_index');
}


return $this->render('re/edit.html.twig', [
    're' => $re
    ,
    'form' => $form->createView(),
    'form2' => $form2->createView(),

]);
}

    /**
     * @Route("/{id}", name="re_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Re $re): Response
    {
        if ($this->isCsrfTokenValid('delete'.$re->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($re);
            $entityManager->flush();
        }

        return $this->redirectToRoute('re_index');
    }
}
