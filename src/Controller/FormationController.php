<?php

namespace App\Controller;

use App\Entity\FormationSanitaire;
use App\Form\FormationSanitaireType;
use App\Repository\FormationSanitaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class FormationController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/formation', name: 'app_formation',methods:"GET")]
    public function index(FormationSanitaireRepository $formationSanitaireRepository): Response
    {
        if(!$this->getUser()){
            $this->addFlash('danger','besoin de login');
            return $this->redirectToRoute('app_login');
        }
        $formation = $formationSanitaireRepository->findAll();
        // dd($formation);
        return $this->render('formation/index.html.twig', compact('formation'));
    }
    #[Route('/formation/create', name: 'app_create',methods:["GET","POST"])]
    public function create(Request $request):Response{
        $FormationSanitaire =  new FormationSanitaire();
        $form = $this->createForm(FormationSanitaireType::class, $FormationSanitaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($FormationSanitaire);
            $this->em->flush();
            return $this->redirectToRoute('app_formation');
        }
        return $this->render('formation/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/formation/{id<[0-9]+>}/edit', name: 'app_show_formation',methods:["GET","POST"])]
    public function show(Request $request,FormationSanitaire $formationSanitaire):Response{
        $form = $this->createForm(FormationSanitaireType::class, $formationSanitaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('app_formation');
        }
        return $this->render('formation/edit.html.twig',[
            'formationSanitaire'=>$formationSanitaire,
            'forma'=>$form->createView()]);
    }
    #[Route('/formation/{id<[0-9]+>}/delete', name: 'app_delete',methods:["GET","POST"])]
//Security("is_granted('ROLE_ADMIN') and is_verified() and pin.getUser = user )"
    public function delete( FormationSanitaire $formationSanitaire): Response
    {
        $this->em->remove($formationSanitaire);
        $this->em->flush();
        return $this->redirectToRoute('app_formation');
    }
    #[Route('/formation/{id<[0-9]+>}/delete', name: 'app_deletee',methods:["GET","POST"])]
    //Security("is_granted('ROLE_ADMIN') and is_verified() and pin.getUser = user )"
        public function deletee( FormationSanitaire $formationSanitaire): Response
        {
            $this->em->remove($formationSanitaire);
            $this->em->flush();
            return $this->redirectToRoute('app_home');
        }
}
