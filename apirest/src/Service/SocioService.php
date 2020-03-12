<?php

namespace App\Service;


use App\Entity\Socios;
use App\Repository\EmpresaRepository;
use App\Repository\SociosRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SocioService
 * @package App\Service
 */
class SocioService extends AbstractController
{
    /**
     * @var SociosRepository
     */
    private $repository;

    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    /**
     * SocioService constructor.
     * @param SociosRepository $repository
     * @param EmpresaRepository $empresaRepository
     */
    public function __construct(
        SociosRepository $repository,
        EmpresaRepository $empresaRepository
    ) {
        $this->repository = $repository;
        $this->empresaRepository = $empresaRepository;
    }


    /**
     * @return array
     */
    public function listAll(): array
    {
        try {
            return $this->repository->list();
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param int $id
     * @return Socio|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function listIdSoc(int $id)
    {
        try {
            return $this->repository->listIdSoc($id);
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
        $empresa = $this->empresaRepository->find($data->empresa_id);

        $socio = new Socios();
        $socio->setNome($data->nome);
        $socio->setCpf($data->cpf);
        $socio->setTelefone($data->telefone);
        $socio->setEndereco($data->endereco);
        $socio->setCargo($data->cargo);
        $socio->setEmpresaId($empresa);

        try {
            $this->repository->insert($socio);
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
        $socio = $this->repository->listIdSoc($id);

        if (isset($data->nome)) {
            $socio->setNome($data->nome);
        }

        if (isset($data->cpf)) {
            $socio->setCpf($data->cpf);
        }

        if (isset($data->telefone)) {
            $socio->setTelefone($data->telefone);
        }

        if (isset($data->endereco)) {
            $socio->setEndereco($data->endereco);
        }

        if (isset($data->cargo)) {
            $socio->setCargo($data->cargo);
        }

        if (isset($data->empresaId)) {
            $socio->setEmpresaID($data->empresa_id_id);
        }

        try {
            $this->repository->update($socio);
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
        $socio = $this->repository->find($id);
        try {
            $this->repository->delete($socio);
        } catch (Exception $e) {
            return $e;
        }
    }
}
