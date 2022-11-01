<?php

/**
 * Repository to perform DB operations for MeanKineticTemperatureRepository
 *
 * PHP version 7.4
 *
 * @author Mohan Jadhav <mohan212jadhav@gmail.com>
 */

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MeanKineticTemperature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MeanKineticTemperature>
 *
 * @method MeanKineticTemperature|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeanKineticTemperature|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeanKineticTemperature[]    findAll()
 * @method MeanKineticTemperature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeanKineticTemperatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeanKineticTemperature::class);
    }
}
