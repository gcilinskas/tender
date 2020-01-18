<?php

namespace App\Repository;

use App\Entity\Tender;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tender|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tender|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tender[]    findAll()
 * @method Tender[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TenderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tender::class);
    }
}
