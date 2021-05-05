<?php

namespace App\Controller;

use App\Entity\AdmMenu;
use App\Repository\AdmMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AdmMenuController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AdmMenuRepository
     */
    private $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdmMenuRepository $repository
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * @Route("/api/v1/admMenu", methods={"POST"})
     */
    public function insert(Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmMenu = new AdmMenu();
        $AdmMenu->setDescription($dadosEmJson->description);
        $AdmMenu->setOrder($dadosEmJson->order);
        $AdmMenu->setAdmMenuParent($dadosEmJson->admMenuParent);
        $AdmMenu->setAdmPage($dadosEmJson->admPage);

        $this->entityManager->persist($AdmMenu);
        $this->entityManager->flush();

        return new JsonResponse($AdmMenu);
    }

    /**
     * @Route("/api/v1/admMenu", methods={"GET"})
     */
    public function findAll(): Response
    {
        $AdmMenuList = $this->repository->findAll();

        return new JsonResponse($AdmMenuList);
    }

    /**
     * @Route("/api/v1/admMenu/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        return new JsonResponse($this->repository->find($id));
    }

    /**
     * @Route("/api/v1/admMenu/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $dadosRequest = $request->getContent();
        $dadosEmJson = json_decode($dadosRequest);

        $AdmMenu = $this->repository->find($id);
        $AdmMenu->setDescription($dadosEmJson->description);
        $AdmMenu->setOrder($dadosEmJson->order);
        $AdmMenu->setAdmMenuParent($dadosEmJson->admMenuParent);
        $AdmMenu->setAdmPage($dadosEmJson->admPage);

        $this->entityManager->flush();

        return new JsonResponse($AdmMenu);
    }

    /**
     * @Route("/api/v1/admMenu/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $AdmMenu = $this->repository->find($id);
        $this->entityManager->remove($AdmMenu);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}