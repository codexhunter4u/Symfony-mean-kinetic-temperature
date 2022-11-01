<?php

/**
 * Entity to hold Kinetic temperature details
 *
 * PHP version 7.4
 *
 * @author Mohan Jadhav <mohan212jadhav@gmail.com>
 */

namespace App\Entity;

use App\Repository\TemperatureDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="temperature_details")
 * @ORM\Entity(repositoryClass=TemperatureDetailsRepository::class)
 */
class TemperatureDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MeanKineticTemperature", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kineticTemperature;

    /**
     * @ORM\Column(type="string")
     */
    private $time;

    /**
     * @ORM\Column(type="float", precision=5, scale=2)
     */
    private $temperature;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return MeanKineticTemperature
     */
    public function getKineticTemperature(): MeanKineticTemperature
    {
        return $this->kineticTemperature;
    }

    /**
     * @param MeanKineticTemperature $kineticTemperature
     * 
     * @return $this
     */
    public function setKineticTemperature(MeanKineticTemperature $kineticTemperature): self
    {
        $this->kineticTemperature = $kineticTemperature;

        return $this;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     * 
     * @return $this
     */
    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     * 
     * @return $this
     */
    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }
}
