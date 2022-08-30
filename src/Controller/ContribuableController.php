<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContribuableController extends AbstractController
{
    /**
     * @Route("/contribuable", name="app_contribuable")
     */
    public function index(): Response
    {
        return $this->render('contribuable/index.html.twig', []);
    }
}
