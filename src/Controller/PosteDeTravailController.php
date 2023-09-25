<?php

namespace App\Controller;

use App\Entity\Risque;use App\Entity\PosteDeTravail;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Form\PosteDeTravailType;
use App\Repository\PosteDeTravailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/poste_de_travail")
 */
class PosteDeTravailController extends AbstractController
{
    /**
     * @Route("/", name="poste_de_travail_index", methods={"GET"})
     */
    public function index(PosteDeTravailRepository $posteDeTravailRepository , Request $request, PaginatorInterface $paginator): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(PosteDeTravail::class)->findBy([],['id' => 'asc']);

        $posteDeTravailRepository= $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );

        return $this->render('poste_de_travail/index.html.twig', [
            'poste_de_travails' => $posteDeTravailRepository,
        ]);

    }
    /**
     * @Route("/new", name="poste_de_travail_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $posteDeTravail = new PosteDeTravail();

        $risques=$this->getDoctrine()->getRepository(Risque::class)->findAll();


        $form = $this->createForm(PosteDeTravailType::class, $posteDeTravail);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($posteDeTravail);
            $entityManager->flush();

            $entityManager = $this->getDoctrine()->getManager();
            $total = 0;
            // if(isset($request->request->get('risque'))) //verifie si le tableau risque exite dams la requete post
            //  {
            $n=$request->request->get('risque');
            $total=count($n);
            //}
            for ($i=0;$i<$total;$i++)
            {
                $risque= $this->getDoctrine()->getRepository(Risque::class)->find($n[$i]);
                $evaluation = new Evaluation();

                $evaluation->setIDR($risque);
                $evaluation->setIDPT($posteDeTravail);
                $evaluation->setFreqance($request->request->get("freq".$risque->getId()));
                // recuperer la freq du risque  imput number  attrubut name= "freq{{risque.id}}"
                $evaluation->setEvaluation($request->request->get("eval".$risque->getId()));// recuperer la evaluation du risque imput number  attrubut name= "eval{{risque.id}}"
                $entityManager->persist($evaluation);

                $entityManager->flush();
            }
            return $this->redirectToRoute('poste_de_travail_index');
        }
        return $this->render('poste_de_travail/new.html.twig', [
            'poste_de_travail' => $posteDeTravail,
            'form' => $form->createView(),
            'risques' => $risques,
        ]);
    }


    /**
     * @Route("/{id}", name="poste_de_travail_show", methods={"GET"})
     */
    public function show(PosteDeTravail $posteDeTravail): Response
    {
        return $this->render('poste_de_travail/show.html.twig', [
            'poste_de_travail' => $posteDeTravail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="poste_de_travail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PosteDeTravail $posteDeTravail): Response
    {
        $risques=$this->getDoctrine()->getRepository(Risque::class)->findAll();
        $form = $this->createForm(PosteDeTravailType::class, $posteDeTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() )
            $entityManager = $this->getDoctrine()->getManager();



        $entityManager = $this->getDoctrine()->getManager();
        $total = 0;
        // if(isset($request->request->get('risque'))) //verifie si le tableau risque exite dams la requete post
        //  {
        $n=$request->request->get('risque');
        $total=count($n);
        //}
        for ($i=0;$i<$total;$i++)
        {$posteDeTravail =$this->getDoctrine()->getRepository(PosteDeTravail::class)->findOneBy(array("id"=>$posteDeTravail));

            $risque= $this->getDoctrine()->getRepository(Risque::class)->find($n[$i]);
            $evaluation = $this->getDoctrine()->getRepository(Evaluation::class)->findBy(array("ID_PT"=>$posteDeTravail));

            $evaluation->setFreqance($request->request->get("freq".$risque->getId()));
            // recuperer la freq du risque  imput number  attrubut name= "freq{{risque.id}}"
            $evaluation->setEvaluation($request->request->get("eval".$risque->getId()));// recuperer la evaluation du risque imput number  attrubut name= "eval{{risque.id}}"
            $entityManager->persist($evaluation);

            $entityManager->flush();


            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('poste_de_travail_index');
        }


        return $this->render('poste_de_travail/edit.html.twig', [
            'poste_de_travail' => $posteDeTravail,
            'form' => $form->createView(),

            'risques' => $risques,
        ]);
    }


}
