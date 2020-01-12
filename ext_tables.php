<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_momopreciousmetal_domain_model_pm', 'EXT:momo_preciousmetal/Resources/Private/Language/locallang_csh_tx_momopreciousmetal_domain_model_pm.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_momopreciousmetal_domain_model_pm');

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'MomoWebdevelopment.momoPreciousmetal',
            'tools',
            'PreciousmetalAdmin',
            '',
            [
                'PmBackend' => 'list, chart, importForm, import'
            ],
            [
                'access' => 'SystemMaintainer',
                'icon' => 'EXT:momo_preciousmetal/Resources/Public/Icons/user_plugin_pmlisting.svg',
                'labels' => 'EXT:momo_preciousmetal/Resources/Private/Language/locallang_mod.xlf',
            ]
        );
    }
);
