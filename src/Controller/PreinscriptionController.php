<?php

namespace App\Controller;

use App\Entity\PreinscriptionUtilisateur;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PreinscriptionController extends AbstractController
{
    #[Route('/preinscription', name: 'app_preinscription')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $preinscription = new Utilisateur();
        $preinscription_form = $this->createForm(UtilisateurType::class, $preinscription);
        $preinscription_form->handleRequest($request);

        if ($preinscription_form->isSubmitted() && $preinscription_form->isValid()) {
            $cvFile = $preinscription_form->get('cv')->getData();

            if ($cvFile) {
                $newFilename = uniqid() . '.' . $cvFile->guessExtension();

                $cvFile->move(
                    $this->getParameter('cv_directory'),
                    $newFilename
                );

                $preinscription->setCv($newFilename);
            }

            $entityManager->persist($preinscription);
            $entityManager->flush();

            $utilisateurId = $preinscription->getId();
            $selectedFormations = $preinscription_form->get('formations')->getData();

            foreach ($selectedFormations as $selectedFormation) {
                $formationId = $selectedFormation->getId();

                if ($utilisateurId !== null && $formationId !== null) {
                    $preinscription_utilisateur = new PreinscriptionUtilisateur();
                    $preinscription_utilisateur->setIdUtilisateur($utilisateurId);
                    $preinscription_utilisateur->setIdFormation($formationId);
                    $preinscription_utilisateur->setStatus(0);

                    $entityManager->persist($preinscription_utilisateur);
                } else {
                    $this->addFlash('error', 'Impossible de récupérer l\'identifiant de l\'intervenant ou de la compétence.');
                }
            }

            $entityManager->flush();

            // return $this->redirectToRoute('homepage');
            return $this->render('preinscription/index.html.twig', [
                'form_success' => true,
            ]);
        }

        return $this->render('preinscription/index.html.twig', [
            'preinscription_form' => $preinscription_form->createView(),
            'form_success' => false,
        ]);
    }
}
