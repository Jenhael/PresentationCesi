<?php

namespace App\Controller;

use App\Entity\Modules;
use App\Entity\PositionIntervenant;
use App\Entity\User;
use App\Form\PositionIntervenantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EspaceIntervenantController extends AbstractController
{
    #[Route('/espace-intervenant', name: 'app_espace_intervenant')]
    #[IsGranted('ROLE_USER')]
    public function show(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userId = $user->getId();

        $user = $entityManager->getRepository(User::class)->find($userId);
        $inscriptionIntervenant = $user->getUserRelation();

        $position_intervenant = new PositionIntervenant();
        $position_intervenant_form = $this->createForm(PositionIntervenantType::class, $position_intervenant);
        $position_intervenant_form->handleRequest($request);

        if ($position_intervenant_form->isSubmitted() && $position_intervenant_form->isValid()) {
            $selectedModules = $position_intervenant_form->get('modules')->getData();
            $selectedFormations = $position_intervenant_form->get('formations')->getData();

            $formationId = $selectedFormations->getId();
            foreach ($selectedModules as $moduleId) {
                $existingRecord = $entityManager->getRepository(PositionIntervenant::class)->findOneBy([
                    'id_intervenant' => $userId,
                    'id_formation' => $formationId,
                    'id_module' => $moduleId
                ]);

                if (!$existingRecord) {
                    $position_intervenant = new PositionIntervenant();
                    $position_intervenant->setIdIntervenant($userId);
                    $position_intervenant->setIdFormation($formationId);
                    $position_intervenant->setIdModule($moduleId);

                    $entityManager->persist($position_intervenant);
                }
            }


            $entityManager->flush();

            return $this->redirectToRoute('app_espace_intervenant');
        }

        $conn = $entityManager->getConnection();
        $sql = 'SELECT *, GROUP_CONCAT(DISTINCT modules.nom) AS modules, GROUP_CONCAT(DISTINCT modules.id) AS module_ids
        FROM position_intervenant
        JOIN user ON position_intervenant.id_intervenant = user.id
        JOIN formations ON position_intervenant.id_formation = formations.id
        JOIN modules ON position_intervenant.id_module = modules.id 
        WHERE user.id = :userId
        GROUP BY user.id, position_intervenant.id_formation';

        $resultSet = $conn->executeQuery($sql, ['userId' => $userId]);

        $data = $resultSet->fetchAllAssociative();

        return $this->render('espace_intervenant/index.html.twig', [
            'inscriptionIntervenant' => $inscriptionIntervenant,
            'controller_name' => 'EspaceIntervenantController',
            'position_intervenant_form' => $position_intervenant_form->createView(),
            'data' => $data,
        ]);
    }

    #[Route('/delete', name: 'delete_row', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userId = $user->getId();

        if ($request->request->has('deleteModule')) {
            $idToDelete = $request->request->get('deleteModule');
            $column = "id_module";
            $this->deleteRow($idToDelete, $entityManager, $column, $userId);
        } elseif ($request->request->has('deleteFormation')) {
            $idToDelete = $request->request->get('deleteFormation');
            $column = "id_formation";
            $this->deleteRow($idToDelete, $entityManager, $column, $userId);
        }

        return $this->redirectToRoute('app_espace_intervenant');
    }

    /**
     * @param int $idToDelete
     * @param EntityManagerInterface $entityManager
     * @param string $column
     * @param int $userId
     */
    private function deleteRow(int $idToDelete, EntityManagerInterface $entityManager, string $column, int $userId): void
    {
        $positionIntervenants = $entityManager->getRepository(PositionIntervenant::class)->findBy([$column => $idToDelete]);

        if (empty($positionIntervenants)) {
            throw $this->createNotFoundException('No PositionIntervenant found for ' . $column . ' ' . $idToDelete);
        }

        foreach ($positionIntervenants as $positionIntervenant) {
            if ($positionIntervenant->getIdIntervenant() === $userId) {
                $entityManager->remove($positionIntervenant);
            }
        }

        $entityManager->flush();
    }

    #[Route('/test', name: 'get_test', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function getHelloWorld(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $id_formation = $requestData['id_formation'];

        $modulesRepository = $entityManager->getRepository(Modules::class);
        $modules = $modulesRepository->findBy(['id_formation' => $id_formation]);

        $moduleData = [];
        foreach ($modules as $module) {
            $moduleData[] = [
                'id' => $module->getId(),
                'nom' => $module->getNom()
            ];
        }

        return new JsonResponse($moduleData);
    }

    #[Route('/gerer-les-intervenants', name: 'gerer_les_intervenants')]
    #[IsGranted('ROLE_USER')]
    public function gerer_intervenants(EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userId = $user->getId();

        $user = $entityManager->getRepository(User::class)->find($userId);
        $inscriptionIntervenant = $user->getUserRelation();

        $conn = $entityManager->getConnection();
        $sql1 = 'SELECT inscription_intervenant.*, 
        GROUP_CONCAT(DISTINCT competances.nom) AS competances_names, 
        GROUP_CONCAT(DISTINCT diplome_intervenants.nom_diplome) AS diplome_concat
        FROM inscription_intervenant
        LEFT JOIN user ON inscription_intervenant.id = user.user_relation_id
        LEFT JOIN compet_intervenants ON user.id = compet_intervenants.id_intervenant
        LEFT JOIN competances ON compet_intervenants.id_competances = competances.id
        LEFT JOIN diplome_intervenants ON user.id = diplome_intervenants.id_intervenant
        GROUP BY user.id';
        $resultSet = $conn->executeQuery($sql1);
        $data1 = $resultSet->fetchAllAssociative();

        $sql2 = 'SELECT *, GROUP_CONCAT(DISTINCT modules.nom) AS modules, GROUP_CONCAT(DISTINCT modules.id) AS module_ids
        FROM position_intervenant
        JOIN user ON position_intervenant.id_intervenant = user.id
        JOIN formations ON position_intervenant.id_formation = formations.id
        JOIN modules ON position_intervenant.id_module = modules.id 
        GROUP BY user.id, position_intervenant.id_formation';

        $resultSet = $conn->executeQuery($sql2);
        $data2 = $resultSet->fetchAllAssociative();

        $session->set('export_data', $data1);

        return $this->render('espace_intervenant/gerer_intervenants.html.twig', [
            'inscriptionIntervenant' => $inscriptionIntervenant,
            'data1' => $data1,
            'data2' => $data2
        ]);
    }
    #[Route('/export-excel', name: 'export_excel')]
    #[IsGranted('ROLE_USER')]
    public function exportToCSV(SessionInterface $session): Response
    {
        $data = $session->get('export_data', []);

        if (empty($data)) {
            return new Response('No data to export.', Response::HTTP_NO_CONTENT);
        }

        $customColumnNames = [
            'email' => 'Email',
            'civilite' => 'Civilite',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'date_de_naissance' => 'Date de Naissance',
            'adresse' => 'Adresse',
            'code_postal' => 'Code Postal',
            'ville' => 'Ville',
            'telephone' => 'Telephone',
            'diplome_concat' => 'Diplome',
            'competances_names' => 'Competences',
        ];

        $outputBuffer = fopen('php://temp', 'r+');

        fprintf($outputBuffer, chr(0xEF) . chr(0xBB) . chr(0xBF));

        $header = array_map(function ($columnName) use ($customColumnNames) {
            return $customColumnNames[$columnName];
        }, array_diff(array_keys($data[0]), ['id', 'roles', 'password', 'user_relation_id', 'diplome_relation_id']));

        $header[] = $customColumnNames['competances_names'];

        fputcsv($outputBuffer, $header, ';');

        foreach ($data as $rowData) {
            $filteredRowData = array_diff_key($rowData, array_flip(['id', 'roles', 'password', 'user_relation_id', 'diplome_relation_id']));

            $filteredRowData[] = $rowData['competances_names'];

            fputcsv($outputBuffer, $filteredRowData, ';');
        }

        rewind($outputBuffer);

        $csvContent = stream_get_contents($outputBuffer);

        fclose($outputBuffer);

        $response = new Response($csvContent);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="les_intervenants.csv"');

        return $response;
    }

    #[Route('/gerer-les-preinscription', name: 'gerer_les_preinscription')]
    #[IsGranted('ROLE_USER')]
    public function gerer_preinscriptions(EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $userId = $user->getId();

        $user = $entityManager->getRepository(User::class)->find($userId);
        $inscriptionIntervenant = $user->getUserRelation();

        $conn = $entityManager->getConnection();
        $sql = ' SELECT GROUP_CONCAT(DISTINCT formations.formation) AS formations_names, utilisateur.*, preinscription_utilisateur.*
        FROM preinscription_utilisateur
        JOIN utilisateur ON utilisateur.id_utilisateur = preinscription_utilisateur.id_utilisateur
        JOIN formations ON preinscription_utilisateur.id_formation = formations.id
        GROUP BY utilisateur.id_utilisateur';
        $resultSet = $conn->executeQuery($sql);

        $data = $resultSet->fetchAllAssociative();
        // $session->set('export_data', $data);

        return $this->render('espace_intervenant/gerer_preinscriptions.html.twig', [
            'inscriptionIntervenant' => $inscriptionIntervenant,
            'data' => $data,
        ]);
    }
}
