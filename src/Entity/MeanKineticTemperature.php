<?php

/**
 * Entity to hold Mean Kinetic temperature attributes
 *
 * PHP version 7.4
 *
 * @author Mohan Jadhav <mohan212jadhav@gmail.com>
 */

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MeanKineticTemperatureRepository;

/**
 * @ORM\Table(name="mean_kinetic_temperature")
 * @ORM\Entity(repositoryClass=MeanKineticTemperatureRepository::class)
 */
class MeanKineticTemperature
{
    /**
     * Universal Gas constant value
     */
    const R = 0.008314472;

    /**
     * Activation Energy as Delta. (ΔR)
     * 
     * Note*: Given value is 83.144 but considered original value for more accurate result.
     */
    const DELTA = 83.14472;

    /**
     * Default temperature to convert °C to °K
     * 
     * Note*: Given value is 83.144 but considered original value for more accurate result.
     */
    const DEFAULT_TEMP = 273.2;

    /**
     * MIME types options for document validation
     */
    const MIMETYPES = [
        'application/vnd.ms-excel', // .ms-xlsx
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
    ];

    /**
     * MIME type error message
     */
    const MIMETYPE_MESSAGE = 'Please upload a valid file, allowed only .xlsx';

    /**
     * Black file error message
     */
    const EMPTY_MESSAGE = "Please upload a file, this field can't be empty";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dataSetName;

    /**
     * @ORM\Column(type="float")
     */
    private $activationEnergy;

    /**
     * @ORM\Column(type="float", precision=5, scale=2)
     */
    private $kineticTemperature;

    /**
     * @ORM\Column(type="string")
     */
    private $ip;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string
     */
    public function getDataSetName(): string
    {
        return $this->dataSetName;
    }

    /**
     * @param string $dataSetName
     * 
     * @return $this
     */
    public function setDataSetName(?string $dataSetName): self
    {
        $this->dataSetName = $dataSetName;

        return $this;
    }

    /**
     * @param float
     */
    public function getActivationEnergy(): float
    {
        return $this->activationEnergy;
    }

    /**
     * @param float $activationEnergy
     * 
     * @return $this
     */
    public function setActivationEnergy(float $activationEnergy): self
    {
        $this->activationEnergy = $activationEnergy;

        return $this;
    }

    /**
     * @param float
     */
    public function getKineticTemperature(): float
    {
        return $this->kineticTemperature;
    }

    /**
     * @param float $kineticTemperature
     * 
     * @return $this
     */
    public function setKineticTemperature(float $kineticTemperature): self
    {
        $this->kineticTemperature = $kineticTemperature;

        return $this;
    }

    /**
     * @param string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * 
     * @return $this
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * 
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
