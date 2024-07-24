<?php

namespace App\Controller;

use App\Entity\Assurance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AssuranceController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/assurance/show", name="assurance_show", methods={"GET"})
     */
    public function show(): Response
    {
        return $this->render('assurance/index.html.twig', [
            'controller_name' => 'assuranceController',
        ]);
    }

    /**
     * @Route("/assurance/create", name="assurance_create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $numero = (string) $data['Numero'];
        $type = (string) $data['Type'];
        $agence = (string) $data['Agence'];
        $date = \DateTime::createFromFormat('Y-m-d', $data['Date']);
        if (!$date) {
            return $this->json([
                'error' => 'Invalid date format',
                'message' => 'Date must be in YYYY-MM-DD format.'
            ], Response::HTTP_BAD_REQUEST);
        }
        $archive = (bool) $data['archive'];
        $prix = (float) $data['prix'];

        $assurance = new Assurance();
        $assurance->setNumero($numero);
        $assurance->setType($type);
        $assurance->setAgence($agence);
        $assurance->setDate($date);
        $assurance->setArchive($archive);
        $assurance->setPrix($prix);

        $entityManager = $this->entityManager;
        $entityManager->persist($assurance);
        $entityManager->flush();

        return $this->render('assurance/create.html.twig', [
            'controller_name' => 'assuranceController',
        ]);
    }

    /**
     * @Route("/assurance/update", name="assurance_update", methods={"PUT"})
     */
    public function update(Request $request, Assurance $assurance): Response
    {
        $data = json_decode($request->getContent(), true);

        $assurance->setNumero($data['numero'] ?? $assurance->getNumero());
        $assurance->setType($data['type'] ?? $assurance->getType());
        $assurance->setAgence($data['agence'] ?? $assurance->getAgence());
        $assurance->setDate($data['date'] ?? $assurance->getDate());
        $assurance->setArchive($data['archive'] ?? $assurance->isArchive());
        $assurance->setPrix($data['prix'] ?? $assurance->getPrix());

        $entityManager = $this->entityManager;
        $entityManager->flush();

        return $this->render('assurance/update.html.twig', [
            'controller_name' => 'assuranceController',
        ]);
    }

    /**
     * @Route("/assurance/archive/{id}", name="assurance_archive", methods={"POST"})
     */
    public function archive(Assurance $assurance): Response
    {
        $assurance->setArchive(true);
        $this->entityManager->persist($assurance);
        $this->entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
