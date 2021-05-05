<?php

namespace App\Controller;

use App\Entity\AdmParameter;
use App\Repository\AdmParameterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AdmParameterController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AdmParameterRepository
     */
    private $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdmParameterRepository $repository
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * @Route("/api/v1/admParameter", methods={"POST"})
     */
    public function insert(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmParameter = new AdmParameter();
        $AdmParameter->setDescription($dadosEmJson->description);
        $AdmParameter->setCode($dadosEmJson->code);
        $AdmParameter->setValue($dadosEmJson->value);
        $AdmParameter->setAdmParameterCategory($dadosEmJson->admParameterCategory);

        $this->entityManager->persist($AdmParameter);
        $this->entityManager->flush();

        return new JsonResponse($AdmParameter);
    }

    /**
     * @Route("/api/v1/admParameter", methods={"GET"})
     */
    public function findAll(): Response
    {
        $AdmParameterList = $this->repository->findAll();

        return new JsonResponse($AdmParameterList);
    }

    /**
     * @Route("/api/v1/admParameter/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        return new JsonResponse($this->repository->find($id));
    }

    /**
     * @Route("/api/v1/admParameter/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmParameter = $this->repository->find($id);
        $AdmParameter->setDescription($dadosEmJson->description);
        $AdmParameter->setCode($dadosEmJson->code);
        $AdmParameter->setValue($dadosEmJson->value);
        $AdmParameter->setAdmParameterCategory($dadosEmJson->admParameterCategory);

        $this->entityManager->flush();

        return new JsonResponse($AdmParameter);
    }

    /**
     * @Route("/api/v1/admParameter/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $AdmParameter = $this->repository->find($id);
        $this->entityManager->remove($AdmParameter);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
