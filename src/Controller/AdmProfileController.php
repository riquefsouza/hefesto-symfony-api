<?php

namespace App\Controller;

use App\Entity\AdmProfile;
use App\Repository\AdmProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AdmProfileController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AdmProfileRepository
     */
    private $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdmProfileRepository $repository
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * @Route("/api/v1/admProfile", methods={"POST"})
     */
    public function insert(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmProfile = new AdmProfile();
        $AdmProfile->setDescription($dadosEmJson->description);
        $AdmProfile->setAdministrator($dadosEmJson->administrator);
        $AdmProfile->setGeneral($dadosEmJson->general);

        $this->entityManager->persist($AdmProfile);
        $this->entityManager->flush();

        return new JsonResponse($AdmProfile);
    }

    /**
     * @Route("/api/v1/admProfile", methods={"GET"})
     */
    public function findAll(): Response
    {
        $AdmProfileList = $this->repository->findAll();

        return new JsonResponse($AdmProfileList);
    }

    /**
     * @Route("/api/v1/admProfile/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        return new JsonResponse($this->repository->find($id));
    }

    /**
     * @Route("/api/v1/admProfile/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmProfile = $this->repository->find($id);
        $AdmProfile->setDescription($dadosEmJson->description);
        $AdmProfile->setAdministrator($dadosEmJson->administrator);
        $AdmProfile->setGeneral($dadosEmJson->general);

        $this->entityManager->flush();

        return new JsonResponse($AdmProfile);
    }

    /**
     * @Route("/api/v1/admProfile/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $AdmProfile = $this->repository->find($id);
        $this->entityManager->remove($AdmProfile);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
