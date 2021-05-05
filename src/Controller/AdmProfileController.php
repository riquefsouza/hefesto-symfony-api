<?php

namespace App\Controller;

use App\Entity\AdmProfile;
use App\Repository\AdmProfileRepository;
use App\Service\AdmProfileService;
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
    /**
     * @var AdmProfileService
     */
    private $service;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdmProfileRepository $repository, AdmProfileService $service
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->service = $service;
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
        $this->service->setTransientList($AdmProfileList);

        return new JsonResponse($AdmProfileList);
    }

    /**
     * @Route("/api/v1/admProfile/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        $admProfile = $this->repository->find($id);

        if ($admProfile == null) {
            return new Response('', Response::HTTP_NOT_FOUND);
        } else {
            $this->service->setTransient($admProfile);
        }

        return new JsonResponse($admProfile);
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

    /**
     * @Route("/api/v1/mountMenu", methods={"GET"})
     */
    public function mountMenu(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $listaIdProfile = $dadosRequest;

        $menuItens = $this->service->mountMenuItem($listaIdProfile);

        return new JsonResponse($menuItens);
    }

    /**
     * @Route("/api/v1/findProfilesByPage/{pageId}", methods={"GET"})
     */
    public function findProfilesByPage(int $pageId): Response
    {
        $admProfileList = $this->service->findProfilesByPage($pageId);
        return new JsonResponse($admProfileList);
    }
    
    /**
     * @Route("/api/v1/findProfilesByUser/{userId}", methods={"GET"})
     */
    public function findProfilesByUser(int $userId): Response
    {
        $admProfileList = $this->service->findProfilesByUser($userId);
        return new JsonResponse($admProfileList);
    }

}
