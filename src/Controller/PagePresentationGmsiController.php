<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class PagePresentationCesiController extends AbstractController
{
    /**
     * @Route("/page-presentation-cesi", name="page_presentation_cesi")
     */
    #[Route('/PagePresentationGmsi', name: 'PagePresentationGmsi')]
    public function index(): Response
    {
        // Your code logic goes here
        
        return $this->render('PagePresentationGmsi/index.html.twig', [
            'controller_name' => 'PagePresentationGmsiController',
        ]);
    }
}