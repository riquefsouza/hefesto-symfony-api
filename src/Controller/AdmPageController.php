<?php

namespace App\Controller;

use App\Entity\AdmPage;
use App\Repository\AdmPageRepository;
use App\Service\AdmPageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AdmPageController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AdmPageRepository
     */
    private $repository;
    /**
     * @var AdmPageService
     */
    private $service;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdmPageRepository $repository, AdmPageService $service
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @Route("/api/v1/admPage", methods={"POST"})
     */
    public function insert(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmPage = new AdmPage();
        $AdmPage->setDescription($dadosEmJson->description);
        $AdmPage->setUrl($dadosEmJson->url);

        $this->entityManager->persist($AdmPage);
        $this->entityManager->flush();

        return new JsonResponse($AdmPage);
    }

    /**
     * @Route("/api/v1/admPage", methods={"GET"})
     */
    public function findAll(): Response
    {
        $AdmPageList = $this->repository->findAll();
        $this->service->setTransientList($AdmPageList);

        return new JsonResponse($AdmPageList);
    }

    /**
     * @Route("/api/v1/admPage/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        $admPage = $this->repository->find($id);

        if ($admPage == null) {
            return new Response('', Response::HTTP_NOT_FOUND);
        } else {
            $this->service->setTransient($admPage);
        }

        return new JsonResponse($admPage);
    }

    /**
     * @Route("/api/v1/admPage/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmPage = $this->repository->find($id);
        $AdmPage->setDescription($dadosEmJson->description);
        $AdmPage->setUrl($dadosEmJson->url);

        $this->entityManager->flush();

        return new JsonResponse($AdmPage);
    }

    /**
     * @Route("/api/v1/admPage/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $AdmPage = $this->repository->find($id);
        $this->entityManager->remove($AdmPage);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
