<?php

namespace App\Controller;

use App\Entity\District;
use App\Form\DistrictType;
use App\Form\RegionType;
use App\Repository\DistrictRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DistrictController extends AbstractController
{

    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    #[Route('/district', name: 'app_district')]
    public function index(DistrictRepository $districtRepository): Response
    {
        if(!$this->getUser()){
            $this->addFlash('danger','besoin de login');
            return $this->redirectToRoute('app_login');
        }
        $district = $districtRepository->findAll();
        return $this->render('district/index.html.twig', compact('district'));
    }

    #[Route('/district/create', name: 'app_create_district',methods:["GET","POST"])]
    public function create(Request $request):Response{
        $district = new District();
        $form=$this->createForm(DistrictType::class,$district);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($district);
            $this->em->flush();
            $this->addFlash('info','ajouter avec success');
            return $this->redirectToRoute('app_district');

        }

        return $this->render('district/create.html.twig',['forma'=>$form->createView()]);
    }
    #[Route('/district/{id<[0-9]+>}/edit', name: 'app_show_district',methods:["GET","POST"])]
    public function show(Request $request,District $district):Response{
        $form=$this->createForm(DistrictType::class,$district);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','modification reussite avec success');
            return $this->redirectToRoute('app_district');
        }
        return $this->render('district/edit.html.twig',[
            'district'=>$district,
            'forma'=>$form->createView()]);
    }
    #[Route('/district/{id<[0-9]+>}/delete', name: 'app_delete_district',methods:["GET","POST"])]
//Security("is_granted('ROLE_ADMIN') and is_verified() and pin.getUser = user )"
    public function delete( District $district): Response
    {
        $this->em->remove($district);
        $this->em->flush();
        $this->addFlash('danger','suppression avec success');
        return $this->redirectToRoute('app_district');
    }
}
