<?php

/**
 * Repository to perform DB operations for TemperatureDetailsRepository
 *
 * PHP version 7.4
 *
 * @author Mohan Jadhav <mohan212jadhav@gmail.com>
 */

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TemperatureDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TemperatureDetails>
 *
 * @method TemperatureDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemperatureDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemperatureDetails[]    findAll()
 * @method TemperatureDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemperatureDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemperatureDetails::class);
    }
}
