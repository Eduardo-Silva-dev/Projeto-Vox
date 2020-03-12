<?php

namespace App\Repository;

use App\Entity\Empresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @method Empresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Empresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Empresa[]    findAll()
 * @method Empresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empresa::class);
    }

    /**
     * @param Empresa $empresa
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function insert(Empresa $empresa)
    {
        $this->getEntityManager()->persist($empresa);
        $this->getEntityManager()->flush();
    }

    /**
     * @return array
     */
    public function listAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param Empresa $empresa
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Empresa $empresa)
    {
        $this->getEntityManager()->persist($empresa);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $id
     * @return Empresa|null
     */
    public function listIdEmp(int $id): ?Empresa
    {
        return $this->find($id);
    }

    /**
     * @param Empresa $empresa
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Empresa $empresa)
    {
        $this->getEntityManager()->remove($empresa);
        $this->getEntityManager()->flush();
    }
}
