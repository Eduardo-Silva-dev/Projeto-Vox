<?php

namespace App\Service;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use App\Repository\SocioRepository;
use App\Repository\SociosRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Exception;

/**
 * Class EmpresaService
 * @package App\Service
 */
class EmpresaService extends AbstractController
{
    /**
     * @var EmpresaRepository
     */
    private $repository;

    /**
     * @var SocioRepository
     */
    private $socioRepository;

    /**
     * EmpresaService constructor.
     * @param EmpresaRepository $empresaRepository
     * @param SocioRepository $socioRepository
     */
    public function __construct(
        EmpresaRepository $empresaRepository,
        SociosRepository $socioRepository
    ) {
        $this->repository = $empresaRepository;
        $this->socioRepository = $socioRepository;
    }

    /**
     * @return array
     */
    public function list(): array
    {
        try {
            return $this->repository->listAll();
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param int $id
     * @return Empresa|null
     */
    public function listIdEmp(int $id): ?Empresa
    {
        try {
            return $this->repository->listIdEmp($id);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param Request $request
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function insert(Request $request)
    {
        $data = json_decode($request->getContent(), false);

        $empresa = new Empresa();
        $empresa->setRazaoSocial($data->razaoSocial) ?? null;
        $empresa->setCnpj($data->cnpj);
        $empresa->setNomeFantasia($data->nomeFantasia ?? null);
        $empresa->setEndereco($data->endereco ?? "");

        try {
            $this->repository->insert($empresa);
            return;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * @param int $id
     * @param Request $request
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(int $id, Request $request)
    {
        $data = json_decode($request->getContent());
        $empresa = $this->repository->listIdEmp($id);

        if (isset($data->nomeFantasia)) {
            $empresa->setNomeFantasia($data->nomeFantasia);
        }

        if (isset($data->cnpj)) {
            $empresa->setCnpj($data->cnpj);
        }

        if (isset($data->razaoSocial)) {
            $empresa->setRazaoSocial($data->razaoSocial);
        }

        if (isset($data->endereco)) {
            $empresa->setEndereco($data->endereco);
        }
        try {
            $this->repository->update($empresa);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * @param int $id
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(int $id)
    {
        $empresa = $this->repository->find($id);
        try{
            $this->repository->delete($empresa);
        }catch(Exception $e){
            return $e;
        }
    }
}
