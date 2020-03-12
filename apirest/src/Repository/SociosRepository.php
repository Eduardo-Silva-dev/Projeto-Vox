<?php

namespace App\Repository;

use App\Entity\Socios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Socios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Socios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Socios[]    findAll()
 * @method Socios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SociosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Socios::class);
    }


    /**
     * @return array
     */
    public function list(): array
    {
        return $this->findAll();
    }

    /**
     * @param int $id
     * @return Socios|null
     */
    public function listIdSoc(int $id): ?Socios
    {
        return $this->find($id);
    }

    /**
     * @param Socios $socio
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function insert(Socios $socio)
    {
        $this->getEntityManager()->persist($socio);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Socios $socio
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Socios $socio)
    {
        $this->getEntityManager()->persist($socio);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Socios $socio
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Socios $socio)
    {

        $this->getEntityManager()->remove($socio);
        $this->getEntityManager()->flush();
    }
}
