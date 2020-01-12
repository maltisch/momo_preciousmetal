<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Task;

use TYPO3\CMS\Extbase\Object\ObjectManager;
use \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository;
use \MomoWebdevelopment\MomoPreciousmetal\Domain\Model\Pm;

class PmTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask
{
    /**
     * @return bool
     * @throws \Exception
     */
    public function execute()
    {
        $pmPrice = $this->getPmPrice();
        if ($pmPrice) {
            $this->savePmPrice($pmPrice);
            return true;
        }else {
            return false;
        }
    }

    /**
     * Get Pm price from Url
     * @return bool|mixed|string
     */
    protected  function getPmPrice()
    {
        $url = 'https://data-asg.goldprice.org/dbXRates/USD,EUR';
        $curl = curl_init();
        if ($curl) {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = json_decode($response, true);
            curl_close($curl);
            return $response;
        } else {
            return false;
        }
    }

    /**
     * Save Pm price to Db
     * @param $pmPrice
     * @throws \Exception
     */
    protected function savePmPrice($pmPrice)
    {

        $date = time();
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $pmRepository= $objectManager->get(PmRepository::class);

        foreach ($pmPrice['items'] as $pmRate ) {
            $pmEntity = GeneralUtility::makeInstance(Pm::class);
            $pmEntity->setDate($date);
            $pmEntity->setCurrency($pmRate['curr']);
            $pmEntity->setXauPrice(floatval($pmRate['xauPrice']));
            $pmEntity->setXauClose(floatval($pmRate['xauClose']));
            $pmEntity->setXagPrice(floatval($pmRate['xagPrice']));
            $pmEntity->setXagClose(floatval($pmRate['xagClose']));

            $pmRepository->add($pmEntity);
        }
        $objectManager->get(PersistenceManager::class)->persistAll();
    }
}

