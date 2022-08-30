<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;


class ActualiteController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    #[Route('/actualite', name: 'app_actualite')]
    public function index(ActualiteRepository $repository): Response
    {
        // if(!$this->getUser()){
        //     $this->addFlash('danger','besoin de login');
        //     return $this->redirectToRoute('app_login');
        // }
        $actualite=$repository->findAll();
        return $this->render('actualite/index.html.twig', compact('actualite'));
    }
    #[Route('/actualite/create', name:'app_create_actualite', methods:["GET","POST"])]
    public function create(Request $request,UserRepository $useRepo):Response
    {
        $actualite = new Actualite();
        $form=$this->createForm(ActualiteType::class,$actualite);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $oskar = $useRepo->findOneBy(['email'=>'qwerty@gmail.com']);
            $actualite->setUser($oskar);
            $this->em->persist($actualite);
            $this->em->flush();
            $this->addFlash("info",'ajouter avec success');
            return $this->redirectToRoute('app_actualite');
        }
        return $this->render('actualite/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/actualite/{id<[0-9]+>}/edit', name:'app_show_actualite', methods:["GET","POST"])]
    public function show(Request $request,Actualite $actualite):Response{
        $form=$this->createForm(ActualiteType::class,$actualite);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_actualite');
        }
        return $this->render('commune/edit.html.twig',[
            'actualite'=>$actualite,
            'forma'=>$form->createView()]);
    }
    #[Route('/actualite/{id<[0-9]+>}/edit', name:'app_show_actualit', methods:["GET","POST"])]
    public function showpublic(Request $request,Actualite $actualite):Response{
        $form=$this->createForm(ActualiteType::class,$actualite);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_pub');
        }
        return $this->render('commune/edit.html.twig',[
            'actualite'=>$actualite,
            'forma'=>$form->createView()]);
    }
    #[Route('/actualite/{id<[0-9]+>}/delete', name: 'app_delete_actualite',methods:["GET","POST"])]
    public function delete( Actualite $actualite): Response
    {
        $this->em->remove($actualite);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_actualite');
    }
    #[Route('/actualite/{id<[0-9]+>}/delete', name: 'app_delete_actualit',methods:["GET","POST"])]
    public function deletepublic( Actualite $actualite): Response
    {
        $this->em->remove($actualite);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_pub');
    }
//    #[Route('/log', name: 'app_loh')]
//    public function log(): Response
//    {
//        return $this->render('page/public/auth.html.twig');
//    }

}
