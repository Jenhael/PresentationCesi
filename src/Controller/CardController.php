<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/card1", name="card1")
     */
    public function card1(): Response
    {
        // Redirige vers la page que vous voulez quand on clique sur la carte 1
        return $this->redirectToRoute('destination_for_card1');
    }

    /**
     * @Route("/card2", name="card2")
     */
    public function card2(): Response
    {
        // Redirige vers la page que vous voulez quand on clique sur la carte 2
        return $this->redirectToRoute('destination_for_card2');
    }
}