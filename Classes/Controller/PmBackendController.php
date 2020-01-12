<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Controller;

use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository;
use MomoWebdevelopment\MomoPreciousmetal\Utility\Chart;
use MomoWebdevelopment\MomoPreciousmetal\Utility\Import;

/**
 * PmBackend controller class
 */
class PmBackendController extends AbstractBackendController
{
    /**
     * pm repository
     *
     * @var PmRepository
     */
    protected $pmRepository;

    /**
     * Import pm repository by dependency injection
     *
     * @param PmRepository $pmRepository
     */
    public function injectPmRepository(PmRepository $pmRepository): void
    {
        $this->pmRepository = $pmRepository;
    }

    /**
     * Initialize view
     *
     * @param ViewInterface
     */
    protected function initializeView(ViewInterface $view): void
    {
        if ($view instanceof BackendTemplateView) {
            /** @var BackendTemplateView $view */
            parent::initializeView($view);
            $this->generateMenu();
        }
    }

    /**
     * Initialize action
     */
    public function initializeAction(): void
    {
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $querySettings->setIgnoreEnableFields(true);
        $this->pmRepository->setDefaultQuerySettings($querySettings);
    }

    /**
     * List all pms
     */
    public function listAction(): void
    {
        $pms_eur = $this->pmRepository->findPmByCurrencyAndStartTime('EUR');
        $pms_usd = $this->pmRepository->findPmByCurrencyAndStartTime('USD');

        $this->view->assign('pms_eur', $pms_eur);
        $this->view->assign('pms_usd', $pms_usd);
    }

    /**
     * Show Line-Chart
     */
    public function chartAction(): void
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

    /**
     *  Show Importform
     */
    public function importFormAction(): void
    {

    }

    /**
     *  Do Import
     */
    public function importAction(): void
    {
        $result = Import::importCSV();
        $message = $result ? 'Successfull' : 'Does not Work';
        $severity = $result ? AbstractMessage::OK : AbstractMessage::ERROR;
        $this->addFlashMessage(
            $message,
            $message,
            $severity,
            true
        );
        $this->redirect('list');
    }
}
