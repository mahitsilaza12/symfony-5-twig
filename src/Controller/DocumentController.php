<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    #[Route('/document', name: 'app_document')]
    public function index(DocumentRepository $documentRepository): Response
    {
        if(!$this->getUser()){
            $this->addFlash('danger','besoin de login');
            return $this->redirectToRoute('app_login');
        }
        $document = $documentRepository->findAll();
        return $this->render('document/index.html.twig',compact('document'));
    }
    #[Route('/document/create', name: 'app_create_document',methods:["GET","POST"])]
    public function create(Request $request):Response{
        $document = new Document();
        $form=$this->createForm(DocumentType::class,$document);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($document);
            $this->em->flush();
            $this->addFlash('info','ajouter avec success');
            return $this->redirectToRoute('app_document');
        }
        return $this->render('document/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/document/{id<[0-9]+>}/edit', name: 'app_show_document',methods:["GET","POST"])]
    public function show(Request $request,Document $document):Response{
        $form=$this->createForm(DocumentType::class,$document);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_document');
        }
        return $this->render('document/edit.html.twig',[
            'document'=>$document,
            'forma'=>$form->createView()]);
    }
    #[Route('/document/{id<[0-9]+>}/delete', name: 'app_delete_document',methods:["GET","POST"])]
//Security("is_granted('ROLE_ADMIN') and is_verified() and pin.getUser = user )"
    public function delete( Document $document): Response
    {
        $this->em->remove($document);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_document');
    }
}
