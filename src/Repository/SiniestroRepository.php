<?php

namespace App\Repository;

use App\Entity\Siniestro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Siniestro>
 */
class SiniestroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Siniestro::class);
    }

    // Ejemplo de método personalizado opcional
    public function findByFecha(\DateTime $fecha): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.fecha = :fecha')
            ->setParameter('fecha', $fecha)
            ->getQuery()
            ->getResult();
    }
}
