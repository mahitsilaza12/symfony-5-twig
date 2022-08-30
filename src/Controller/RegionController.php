<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionType;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegionController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    #[Route('/region', name: 'app_region')]
    public function index(RegionRepository $regionRepository): Response
    {
        if(!$this->getUser()){
            $this->addFlash('danger','besoin de login');
            return $this->redirectToRoute('app_login');
        }
        $region = $regionRepository->findAll();
        return $this->render('region/index.html.twig',compact('region'));
    }
    #[Route('/region/create', name: 'app_create_region',methods:["GET","POST"])]
    public function create(Request $request):Response{
        $region =  new Region();
        $form=$this->createForm(RegionType::class,$region);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($region);
            $this->em->flush();
            $this->addFlash('info','ajouter avec success');
            return $this->redirectToRoute('app_region');
        }
        return $this->render('region/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/region/{id<[0-9]+>}/edit', name: 'app_show',methods:["GET","POST"])]
    public function show(Request $request,Region $region):Response{
        $form = $this->createForm(RegionType::class,$region);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_region');
        }
        return $this->render('region/edit.html.twig',[
            'region'=>$region,
            'forma'=>$form->createView()]);
    }
    #[Route('/region/{id<[0-9]+>}/delete', name: 'app_delete',methods:["GET","POST"])]
//Security("is_granted('ROLE_ADMIN') and is_verified() and pin.getUser = user )"
    public function delete( Region $region): Response
    {
        $this->em->remove($region);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_region');
    }
}
