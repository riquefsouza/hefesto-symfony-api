<?php

namespace App\Controller;

use App\Entity\AdmUser;
use App\Repository\AdmUserRepository;
use App\Service\AdmUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AdmUserController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AdmUserRepository
     */
    private $repository;
    /**
     * @var AdmUserService
     */
    private $service;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdmUserRepository $repository, AdmUserService $service
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @Route("/api/v1/admUser", methods={"POST"})
     */
    public function insert(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmUser = new AdmUser();
        $AdmUser->setActive($dadosEmJson->active);
        $AdmUser->setEmail($dadosEmJson->email);
        $AdmUser->setLogin($dadosEmJson->login);
        $AdmUser->setName($dadosEmJson->name);
        $AdmUser->setPassword($dadosEmJson->password);

        $this->entityManager->persist($AdmUser);
        $this->entityManager->flush();

        return new JsonResponse($AdmUser);
    }

    /**
     * @Route("/api/v1/admUser", methods={"GET"})
     */
    public function findAll(): Response
    {
        $AdmUserList = $this->repository->findAll();
        $this->service->setTransientList($AdmUserList);

        return new JsonResponse($AdmUserList);
    }

    /**
     * @Route("/api/v1/admUser/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        $admUser = $this->repository->find($id);

        if ($admUser == null) {
            return new Response('', Response::HTTP_NOT_FOUND);
        } else {
            $this->service->setTransient($admUser);
        }

        return new JsonResponse($admUser);
    }

    /**
     * @Route("/api/v1/admUser/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmUser = $this->repository->find($id);
        $AdmUser->setActive($dadosEmJson->active);
        $AdmUser->setEmail($dadosEmJson->email);
        $AdmUser->setLogin($dadosEmJson->login);
        $AdmUser->setName($dadosEmJson->name);
        $AdmUser->setPassword($dadosEmJson->password);

        $this->entityManager->flush();

        return new JsonResponse($AdmUser);
    }

    /**
     * @Route("/api/v1/admUser/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $AdmUser = $this->repository->find($id);
        $this->entityManager->remove($AdmUser);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
