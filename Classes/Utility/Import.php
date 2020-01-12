<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository;
use MomoWebdevelopment\MomoPreciousmetal\Domain\Model\Pm;

class Import
{
    /**
     * Import CSV-File to pm table
     * @return bool
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public static function importCSV()
    {
        $result = true;
        $pmPriceJsonArray = [
            'EUR' => '/typo3conf/ext/momo_preciousmetal/Resources/Private/Data/xau_eur.csv',
            'USD' => '/typo3conf/ext/momo_preciousmetal/Resources/Private/Data/xau_usd.csv'
        ];

        foreach ($pmPriceJsonArray as $currency => $filepath) {
            $row = 1;
            $csvArray = array();
            $uploadFilename = Environment::getPublicPath() . $filepath;
            $handle = fopen($uploadFilename, "r");
            if ($handle) {
                while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                    $num = count($data);
                    if ($row == 2){
                        for ($c=0; $c < $num; $c++) {
                            $csvColums[] = $data[$c];
                        }
                    }
                    if ($row > 2) {
                        $rowData = [];
                        for ($c = 0; $c < $num; $c++) {
                            // first column is date
                            if($c === 0) {
                                $data[$c] = strtotime($data[$c]);
                            }
                            $rowData[$csvColums[$c]] = trim($data[$c])	;
                        }
                        $csvArray[] = $rowData;
                    }
                    $row++;
                }
                fclose($handle);

                $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
                $pmRepository= $objectManager->get(PmRepository::class);
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
                }else {
                    $result = false;
                }

            }else {
                $result = false;
            }

        }

        return $result;
    }
}
