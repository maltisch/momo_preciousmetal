<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Domain\Repository;

use \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/***
 *
 * This file is part of the "Precious metal" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Masod Mohmand <masod@momo-webdevelopment.de>
 *
 ***/

/**
 * The repository for Pms
 */
class PmRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function initializeObject(): void
    {
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * Find pm by currency and startTime
     *
     * @param string $currency
     * @param bool|int  $startTime
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findPmByCurrencyAndStartTime($currency, $startTime = false)
    {
        $startTime = $startTime ?: strtotime('-6 year');
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                [
                    $query->greaterThanOrEqual('date', $startTime),
                    $query->like('currency', $currency)
                ]
            )
        );
        $query->setOrderings(['date' => QueryInterface::ORDER_DESCENDING]);

        return $query->execute();
    }
}
