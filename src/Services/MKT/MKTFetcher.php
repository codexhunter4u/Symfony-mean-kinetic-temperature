<?php

/**
 * Service to fetch the MKT
 *
 * PHP version 7.4
 *
 * @author Mohan jadhav <mohan212jadhav@gmail.com>
 */

declare(strict_types=1);

namespace App\Services\MKT;

use DateTime;
use Exception;
use App\Services\ResultSetter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\{TemperatureDetails, MeanKineticTemperature};

class MKTFetcher extends ResultSetter
{    
    private EntityManagerInterface $entityManager;

    /**
     * MKTFetcher constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get the MKT details
     *
     * @return array
     */
    public function getAllMKT(): array
    {
        return $this->entityManager->getRepository(MeanKineticTemperature::class)->findAll();
    }

    /**
     * Get the data set details for requested MKT
     * 
     * @param int $id
     *
     * @return array
     */
    public function getDataSet(int $id): array
    {
        return $this->entityManager->getRepository(TemperatureDetails::class)->findBy(['kineticTemperature' => $id]);
    }

    /**
     * Get mean kinetic temperature
     * 
     * @param int $id
     *
     * @return MeanKineticTemperature
     */
    public function getMKT(int $id): MeanKineticTemperature
    {
        return $this->entityManager->getRepository(MeanKineticTemperature::class)->find($id);
    }
}
