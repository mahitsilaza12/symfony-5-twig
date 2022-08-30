<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Form\CommuneType;
use App\Repository\CommuneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommuneController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    #[Route('/commune', name: 'app_commune')]
    public function index(CommuneRepository $communeRepository): Response
    {
        if(!$this->getUser()){
            $this->addFlash('danger','besoin de login');
            return $this->redirectToRoute('app_login');
        }
        $commune= $communeRepository->findAll();
        // dd($commune);
        return $this->render('commune/index.html.twig', compact('commune'));
    }
    #[Route('/commune/create', name:'app_create_commune', methods:["GET","POST"])]
    public function create(Request $request):Response
    {
     $commune = new Commune();
     $form=$this->createForm(CommuneType::class,$commune);
     $form->handleRequest($request);
     if($form->isSubmitted() && $form->isValid()){
         $this->em->persist($commune);
         $this->em->flush();
         $this->addFlash("info",'ajouter avec success');
         return $this->redirectToRoute('app_commune');
     }
     return $this->render('commune/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/commune/{id<[0-9]+>}/edit', name:'app_show_communer', methods:["GET","POST"])]
    public function show(Request $request,Commune $commune):Response{
        $form=$this->createForm(CommuneType::class,$commune);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_commune');
        }
        return $this->render('commune/edit.html.twig',[
            'commune'=>$commune,
            'forma'=>$form->createView()]);
    }
    #[Route('/commune/{id<[0-9]+>}/delete', name: 'app_delete_commune',methods:["GET","POST"])]
    public function delete( Commune $commune): Response
    {
        $this->em->remove($commune);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_commune');
    }
}
