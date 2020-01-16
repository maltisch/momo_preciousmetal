<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException;
use TYPO3\CMS\Core\Resource\Exception\FileOperationErrorException;
use MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository;
use MomoWebdevelopment\MomoPreciousmetal\Domain\Model\Pm;

class Import
{
    /**
     * Import CSV-File to pm table
     *
     */
    public static function importCsv(): void
    {
        $pmPriceJsonArray = [
            'EUR' => '/typo3conf/ext/momo_preciousmetal/Resources/Private/Data/xau_eur.csv',
            'USD' => '/typo3conf/ext/momo_preciousmetal/Resources/Private/Data/xau_usd.csv'
        ];

        foreach ($pmPriceJsonArray as $currency => $filepath) {
            $row = 1;
            $csvArray = array();
            $uploadFilename = Environment::getPublicPath() . $filepath;

            if (file_exists($uploadFilename)) {
                $handle = fopen($uploadFilename, "r");
                if ($handle) {
                    while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                        $num = count($data);
                        if ($row == 2) {
                            for ($c = 0; $c < $num; $c++) {
                                $csvColums[] = $data[$c];
                            }
                        }
                        if ($row > 2) {
                            $rowData = [];
                            for ($c = 0; $c < $num; $c++) {
                                // first column is date
                                if ($c === 0) {
                                    $data[$c] = strtotime($data[$c]);
                                }
                                $rowData[$csvColums[$c]] = trim($data[$c]);
                            }
                            $csvArray[] = $rowData;
                        }
                        $row++;
                    }
                    fclose($handle);

                    $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
                    $pmRepository = $objectManager->get(PmRepository::class);
                    if (is_array($csvArray) && count($csvArray)) {
                        foreach ($csvArray as $pmArray) {
                            $pm = GeneralUtility::makeInstance(Pm::class);
                            $pm->setCurrency($currency);
                            $pm->setDate(intval($pmArray['Date']));
                            $pm->setXauPrice(floatval(str_replace(',', '', $pmArray['Price'])));
                            $pm->setXauOpen(floatval(str_replace(',', '', $pmArray['Open'])));
                            $pm->setXauChange($pmArray['Change %']);
                            $pmRepository->add($pm);
                        }
                    } else {
                        throw new FileOperationErrorException('backend.pms.import.exception.operation');
                    }
                } else {
                    throw new FileOperationErrorException('backend.pms.import.exception.operation');
                }
            } else {
                throw new FileDoesNotExistException('backend.pms.import.exception.doesnotexist', 1579175044);
            }
        }
    }
}
