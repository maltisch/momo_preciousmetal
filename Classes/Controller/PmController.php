<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Controller;

use MomoWebdevelopment\MomoPreciousmetal\Utility\Chart;

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
 * PmController
 */
class PmController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * pmRepository
     *
     * @var \MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository
     * @inject
     */
    protected $pmRepository = null;

    /**
     * List pm table
     *
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function listAction()
    {
        $pms_eur = $this->pmRepository->findPmByCurrencyAndStartTime('EUR');
        $pms_usd = $this->pmRepository->findPmByCurrencyAndStartTime('USD');

        $this->view->assign('pms_eur', $pms_eur);
        $this->view->assign('pms_usd', $pms_usd);
    }

    /**
     *  Show pm chart
     */
    public function chartAction ()
    {
        $dataAndLabels = Chart::getPmsLabelAndData();
        $data_eur = array_values($dataAndLabels);
        $labels_eur = array_keys($dataAndLabels);
        $dataAndLabels = Chart::getPmsLabelAndData('USD');
        $data_usd = array_values($dataAndLabels);
        $labels_usd = array_keys($dataAndLabels);

        $this->view->assign('data_eur', $data_eur);
        $this->view->assign('labels_eur', $labels_eur);
        $this->view->assign('data_usd', $data_usd);
        $this->view->assign('labels_usd', $labels_usd);
    }
}
