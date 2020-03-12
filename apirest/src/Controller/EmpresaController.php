<?php

namespace App\Controller;

use App\Service\EmpresaService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/empresa", name="empresa")
 */
class EmpresaController extends AbstractController
{
    /**
     * @var EmpresaService
     */
    private $service;

    /**
     * EmpresaController constructor.
     * @param EmpresaService $empresaService
     */
    public function __construct(
        EmpresaService $empresaService
    ) {
        $this->service = $empresaService;
    }

    /**
     * @Route("/", name="listAll", methods={"GET"})
     */
    public function listAll()
    {
        $empresas = $this->service->list();

        return $this->json([
            'data' => $empresas
        ]);
    }

    /**
     * @Route("/{id}", name="listar", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function list(int $id): JsonResponse
    {
        $empresa = $this->service->listIdEmp($id);

        return $this->json([
            'data' => $empresa
        ]);
    }

    /**
     * @Route("/", name="insert", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert(Request $request): JsonResponse
    {
        $this->service->insert($request);

        return $this->json([
            'data' => 'Empresa cadastrada com sucesso'
        ]);
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

        return $this->json(['data' => 'Empresa atualizada com sucesso']);
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
