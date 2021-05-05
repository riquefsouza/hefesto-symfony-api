<?php

namespace App\Controller;

use App\Entity\AdmParameterCategory;
use App\Repository\AdmParameterCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdmParameterCategoryController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AdmParameterCategoryRepository
     */
    private $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdmParameterCategoryRepository $repository
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * @Route("/api/v1/admParameterCategory", methods={"POST"})
     */
    public function insert(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmParameterCategory = new AdmParameterCategory();
        $AdmParameterCategory->setDescription($dadosEmJson->description);
        $AdmParameterCategory->setOrder($dadosEmJson->order);

        $this->entityManager->persist($AdmParameterCategory);
        $this->entityManager->flush();

        return new JsonResponse($AdmParameterCategory);
    }

    /**
     * @Route("/api/v1/admParameterCategory", methods={"GET"})
     */
    public function findAll(): Response
    {
        $AdmParameterCategoryList = $this->repository->findAll();

        return new JsonResponse($AdmParameterCategoryList);
    }

    /**
     * @Route("/api/v1/admParameterCategory/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        return new JsonResponse($this->repository->find($id));
    }

    /**
     * @Route("/api/v1/admParameterCategory/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmParameterCategory = $this->repository->find($id);
        $AdmParameterCategory->setDescription($dadosEmJson->description);
        $AdmParameterCategory->setOrder($dadosEmJson->order);    

        $this->entityManager->flush();

        return new JsonResponse($AdmParameterCategory);
    }

    /**
     * @Route("/api/v1/admParameterCategory/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $AdmParameterCategory = $this->repository->find($id);
        $this->entityManager->remove($AdmParameterCategory);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
