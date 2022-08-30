<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FormationSanitaireRepository;
use App\Repository\ActualiteRepository;


class HomeController extends AbstractController
{


     private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function index(FormationSanitaireRepository $formationSanitaireRepository): Response
    {
        $formation = $formationSanitaireRepository->findAll();
        // dd($formation);
        return $this->render('page/base.html.twig', compact('formation'));
    }

     /**
     * @Route("/logine", name="app_log")
     */
    public function log(): Response
    {
        return $this->render('home/auth/login.html.twig', [
        ]);
        
    }
     /**
     * @Route("/registera", name="app_reg")
     */
    public function registera(): Response
    {
        return $this->render('home/auth/register.html.twig', [
        ]);
        
    }
    #[Route('/pub', name: 'app_pub')]
    public function pub(ActualiteRepository $repository): Response
    {
        $actualite=$repository->findAll();
        return $this->render('page/public/home.html.twig',compact('actualite'));
    }
}
