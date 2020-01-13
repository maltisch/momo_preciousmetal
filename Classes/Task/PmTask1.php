<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Task;

use TYPO3\CMS\Extbase\Object\ObjectManager;
use \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository;
use \MomoWebdevelopment\MomoPreciousmetal\Domain\Model\Pm;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class PmTask1 extends \TYPO3\CMS\Scheduler\Task\AbstractTask
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
        } else {
            return false;
        }
    }

    /**
     * Get Pm price from Urls
     * @return bool|mixed|string
     */
    protected  function getPmPrice()
    {
        $pmPriceArray = [];
        $pmPriceUrlArray = [
            'EUR' => "https://www.investing.com/currencies/xau-eur-historical-data",
            'USD' => "https://www.investing.com/currencies/xau-usd-historical-data"
        ];

        foreach ($pmPriceUrlArray as $currency => $url) {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:71.0) Gecko/20100101 Firefox/71.0");
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $dom = new \DomDocument;
            libxml_use_internal_errors(true);
            $dom->loadHTML($output);
            libxml_clear_errors();
            $table = $dom->getElementById('curr_table');
            $tbody = $table->getElementsByTagName('tbody');
            $trs = $tbody[0]->getElementsByTagName('tr');
            $tds = $trs->item(1)->getElementsByTagName('td');
            $pmPriceArray[] = [
                'curr' => $currency,
                'date' => $tds[0]->nodeValue,
                'price' => $tds[1]->nodeValue,
                'open' => $tds[2]->nodeValue,
                'change' => $tds[5]->nodeValue
            ];
        }

        return $pmPriceArray;
    }

    /**
     * Save Pm price to Db
     * @param $pmPrice
     * @throws \Exception
     */
    protected function savePmPrice($pmPrice)
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $pmRepository= $objectManager->get(PmRepository::class);

        foreach ($pmPrice as $pmRate ) {
            $pmEntity = GeneralUtility::makeInstance(Pm::class);
            $pmEntity->setDate(strtotime($pmRate['date']));
            $pmEntity->setCurrency($pmRate['curr']);
            $pmEntity->setXauPrice(floatval(str_replace(',', '', $pmRate['price'])));
            $pmEntity->setXauOpen(floatval(str_replace(',', '', $pmRate['open'])));
            $pmEntity->setXauChange($pmRate['change']);

            $pmRepository->add($pmEntity);
        }
        $objectManager->get(PersistenceManager::class)->persistAll();
    }
}

