<?php

namespace App\Controller;

use App\Entity\CompetIntervenants;
use App\Entity\DiplomeIntervenants;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $intervenantId = $user->getId();
            $selectedCompetences = $form->get('competances')->getData();

            foreach ($selectedCompetences as $selectedCompetence) {
                $competanceId = $selectedCompetence->getId();

                if ($intervenantId !== null && $competanceId !== null) {
                    $compet_intervenants = new CompetIntervenants();
                    $compet_intervenants->setIdIntervenant($intervenantId);
                    $compet_intervenants->setIdCompetances($competanceId);

                    $entityManager->persist($compet_intervenants);
                } else {
                    $this->addFlash('error', 'Impossible de récupérer l\'identifiant de l\'intervenant ou de la compétence.');
                }
            }

            $selectedDiplomes = $form->get('diplomes')->getData();

            foreach ($selectedDiplomes as $selectedDiplome) {
                $diplome = new DiplomeIntervenants();
                $diplome->setIdIntervenant($intervenantId);
                $diplome->setNomDiplome($selectedDiplome);

                $entityManager->persist($diplome);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
