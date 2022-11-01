<?php

/**
 * Service to create MKT
 *
 * PHP version 7.4
 *
 * @author Mohan jadhav <mohan212jadhav@gmail.com>
 * 
 * @Note: MKT = Mean Kinetic temperature
 */

declare(strict_types=1);

namespace App\Services\MKT;

use DateTime;
use Exception;
use App\Services\ResultSetter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\{TemperatureDetails, MeanKineticTemperature};
use Symfony\Component\DependencyInjection\ContainerInterface;

class MKTCreator extends ResultSetter
{
    private ContainerInterface $container;
    
    private EntityManagerInterface $entityManager;

    /**
     * MKTCreator constructor
     *
     * @param ContainerInterface $container
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ContainerInterface $container,
        EntityManagerInterface $entityManager
    ) {
        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    /**
     * Read file for MKT calculation
     *
     * @param array $file
     * @return array
     */
    public function readFile(UploadedFile $file): array
    {
        $xlsxFile = $this->uploadFiles($file);
        $filePath = $this->container->getParameter('app.files_directory') . '/' . $xlsxFile['uniqeName'];
        $spreadsheet = IOFactory::load($filePath); // Here we are able to read from the excel file
        $row = $spreadsheet->getActiveSheet()->removeRow(1); // Remove first row of title 
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // Read data is turned into an array
        
        return $this->calculateMeanKineticTemperature($sheetData, $xlsxFile['dataSetName']);
    }

    /**
     * Calculate mean kinetic temperature
     *
     * @param array $sheetData
     * @param string $dataSetName
     *
     * @return array
     * @return Exception
     */
    private function calculateMeanKineticTemperature(array $sheetData, string $dataSetName): array
    {
        $numerator = MeanKineticTemperature::DELTA / MeanKineticTemperature::R; // i.e ΔR/R;
        $celsiusToKelvin = $temperature = $denominatorOfNumerator = $deltaExponential = [];
        foreach($sheetData as $rows) {
            if (empty($rows['A']) || empty($rows['B'])) {
                continue; // Skip the im complete pair of time & temprature
            }
            $celsiusToKelvin[] = number_format($rows['A'] + MeanKineticTemperature::DEFAULT_TEMP, 6); // conversion °C to °K
            $temperature[$rows['B']] = $rows['A'];
        }
        foreach($celsiusToKelvin as $value) {
            $denominatorOfNumerator[] = number_format(
                - MeanKineticTemperature::DELTA / (MeanKineticTemperature::R * $value), 6
            ); // Calculate the denominator Of numerator portion i.e −∆Η/RTn
        }
        foreach($denominatorOfNumerator as $value) {
            $deltaExponential[] = exp(floatval($value)); // power of −∆Η/RTn i.e 𝑒(−∆Η/RTn)
        }
        $sumOfDeltaExponential = array_sum($deltaExponential); // SUM of $deltaExponential values i.e [𝑒(−∆Η/RTn) + 𝑒(−∆Η/RTn)..]
        $logDenominator = $sumOfDeltaExponential / (count($celsiusToKelvin) + 1); // Log expression i.e 𝑒(−∆Η/RTn) + 𝑒(−∆Η/RTn)..n / N
        $negativeLog = -log($logDenominator); // Array count from 0 hence added 1.
        $kineticTemperature = $numerator / $negativeLog; // Final kinetic value in kelvin i.e (ΔR/R) / -ln(𝑒(−∆Η/RTn) + 𝑒(−∆Η/RTn)..n / N)
        $convertToCelsius = (float)($kineticTemperature - MeanKineticTemperature::DEFAULT_TEMP); // MKT = ($kineticTemperature - 273.2)
        $meanKineticTemperature = $this->saveKineticTemperature($convertToCelsius, $dataSetName);

        return $this->saveTemperatureDetails($meanKineticTemperature, $temperature);
    }

    /**
     * Save the mean kinetic temperature.
     *
     * @param float $kineticTemperature
     * @param string $dataSetName
     *
     * @return MeanKineticTemperature
     * @return Exception
     */
    private function saveKineticTemperature(float $kineticTemperature, string $dataSetName): MeanKineticTemperature
    {
        try {
            $meanKineticTemperature = new MeanKineticTemperature();      
            $meanKineticTemperature->setDataSetName($dataSetName)
                ->setActivationEnergy((float)MeanKineticTemperature::DELTA)
                ->setKineticTemperature($kineticTemperature)
                ->setIp($this->getClientIpAddress())
                ->setCreatedAt(new DateTime);

                $this->entityManager->persist($meanKineticTemperature);
                $this->entityManager->flush();

            return $meanKineticTemperature;
        } catch (FileException $exception) {
            throw new Exception('Erros on saving MKT.' . $exception);
        }
    }

    /**
     * Save temperature details
     *
     * @param MeanKineticTemperature $mkt
     * @param array $temperatures
     * 
     * @return array
     */
    private function saveTemperatureDetails(MeanKineticTemperature $mkt, array $temperatures): array
    {
        try {
            foreach($temperatures as $time => $temperature) {
                $temperatureDetails = new TemperatureDetails();
                $temperatureDetails->setKineticTemperature($mkt)
                    ->setTime($time)
                    ->setTemperature((float)$temperature);
                $this->entityManager->persist($temperatureDetails);
                $this->entityManager->flush();
            }

            return $this->successResult('MKT saved successfully');
        } catch (FileException $exception) {
            throw new Exception('Erros on saving MKT.' . $exception);
        }
    }

    /**
     * Get the real IP address of client
     *
     * @return string
     */
    public function getClientIpAddress(): string
    {
        switch (true) {
          case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
          case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
          case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
          default : return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * Upload xlsx file.
     *
     * @param UploadedFile $file
     *
     * @return array
     * @return Exception
     */
    private function uploadFiles(UploadedFile $file): array
    {
        try {
            $path = $this->container->getParameter('app.files_path');
            $uniqueName = md5(uniqid()) . '.' . $file->guessExtension();
            $fileName = $file->getClientOriginalName();
            $file->move($this->container->getParameter('app.files_directory'), $uniqueName);

            return ['filePath' => $path . '/' .$uniqueName, 'uniqeName' =>$uniqueName, 'dataSetName' => $fileName];
        } catch (FileException $exception) {
            throw new Exception('File upload getting errors.' . $exception);
        }
    }
}
