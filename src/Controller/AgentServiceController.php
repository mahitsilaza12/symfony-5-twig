<?php

namespace App\Controller;

use App\Entity\AgentService;
use App\Form\AgentServiceType;
use App\Repository\AgentServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentServiceController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    #[Route('/agentService', name: 'app_agent_service')]
    public function index(AgentServiceRepository $agentServiceRepository): Response
    {
        if(!$this->getUser()){
            $this->addFlash('danger','besoin de login');
            return $this->redirectToRoute('app_login');
        }
        $agent=$agentServiceRepository->findAll();
        return $this->render('agent_service/index.html.twig',compact('agent'));
    }
    #[Route('/agentService/create', name:'app_create_agent', methods:["GET","POST"])]
    public function create(Request $request):Response
    {
        $agent = new AgentService();
        $form=$this->createForm(AgentServiceType::class,$agent);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($agent);
            $this->em->flush();
            $this->addFlash("info",'ajouter avec success');
            return $this->redirectToRoute('app_agent_service');
        }
        return $this->render('agent_service/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/agentService/{id<[0-9]+>}/edit', name:'app_show_agent', methods:["GET","POST"])]
    public function show(Request $request,AgentService $agentService):Response{
        $form=$this->createForm(AgentServiceType::class,$agentService);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_agent_service');
        }
        return $this->render('agent_service/edit.html.twig',[
            'agentService'=>$agentService,
            'forma'=>$form->createView()]);
    }
    #[Route('/agentService/{id<[0-9]+>}/delete', name: 'app_delete_agent',methods:["GET","POST"])]
    public function delete( AgentService $agentService): Response
    {
        $this->em->remove($agentService);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_agent_service');
    }
}
