<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository;

class Chart
{
    /**
     * @param string $currency
     * @return array
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public static function getPmsLabelAndData($currency = 'EUR')
    {
        $startTime =  strtotime('-1 year');
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $pmRepository= $objectManager->get(PmRepository::class);
        $pms = $pmRepository->findPmByCurrencyAndStartTime($currency, $startTime);
        $query = $pms->getQuery();
        $query->setOrderings(['date' => QueryInterface::ORDER_ASCENDING]);
        $results = $query->execute();

        $data = array();
        foreach ($results as $pmRate) {
            $date = date('d.m.y', $pmRate->getDate());
            $data[$date] = $pmRate->getXauPrice();
        }

        return $data;
    }
}
