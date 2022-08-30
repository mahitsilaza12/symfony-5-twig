<?php

namespace App\Controller;

use App\Entity\ServiceOffert;
use App\Form\ServiceOffertType;
use App\Repository\ServiceOffertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    #[Route('/service', name: 'app_service')]
    public function index(ServiceOffertRepository $serviceOffertRepository): Response
    {
        if(!$this->getUser()){
            $this->addFlash('danger','besoin de login');
            return $this->redirectToRoute('app_login');
        }
        $service = $serviceOffertRepository->findAll();
        return $this->render('service/index.html.twig',compact('service'));
    }
    #[Route('/service/create', name: 'app_create_service',methods:["GET","POST"])]
    public function create(Request $request):Response{
        $service = new ServiceOffert();
        $form=$this->createForm(ServiceOffertType::class, $service);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($service);
            $this->em->flush();
            $this->addFlash('info','ajouter avec success');
            return $this->redirectToRoute('app_service');
        }
        return $this->render('service/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/service/{id<[0-9]+>}/edit', name: 'app_show_service',methods:["GET","POST"])]
    public function show(Request $request,ServiceOffert $serviceOffert):Response{
        $form = $this->createForm(ServiceOffertType::class,$serviceOffert);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_service');
        }
        return $this->render('service/edit.html.twig',[
            'serviceOffert'=>$serviceOffert,
            'forma'=>$form->createView()]);
    }
    #[Route('/service/{id<[0-9]+>}/delete', name: 'app_delete',methods:["GET","POST"])]
//Security("is_granted('ROLE_ADMIN') and is_verified() and pin.getUser = user )"
    public function delete( ServiceOffert $serviceOffert): Response
    {
        $this->em->remove($serviceOffert);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_service');
    }
}
