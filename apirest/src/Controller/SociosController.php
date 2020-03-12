<?php

namespace App\Controller;

use App\Service\SocioService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/socios", name="socio")
 */
class SociosController extends AbstractController
{
    /**
     * @var SocioService
     */
    private $service;

    /**
     * socioController constructor.
     * @param SocioService $socioService
     */
    public function __construct(SocioService $socioService)
    {
        $this->service = $socioService;
    }

    /**
     * @Route("/", name="listAll", methods={"GET"})
     * @return JsonResponse
     */
    public function listAll() : JsonResponse
    {
        $socios = $this->service->listAll();

        return $this->json(['data' => $socios]);
    }

    /**
     * @Route("/{id}", name="listar", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function list(int $id) : JsonResponse
    {
        $socio = $this->service->listIdSoc($id);
        
        return $this->json(['data' => $socio]);
    }

    /**
     * @Route("/", name="insert",methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function insert(Request $request): JsonResponse
    {
        $this->service->insert($request);
        
        return $this->json(['data' => 'Socio Cadastrado com Sucesso!']);
    }

    /**
     * @Route("/{id}", name="update", methods={"PUT", "PATCH"})
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $this->service->update($id, $request);

        return $this->json(['data' => 'Socio atualizado com sucesso']);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param int $id
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);

        return $this->json(['data' => 'Deletado com sucesso']);
    }
}
