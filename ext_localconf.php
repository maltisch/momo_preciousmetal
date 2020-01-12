<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'MomoWebdevelopment.MomoPreciousmetal',
            'Pmlisting',
            [
                'Pm' => 'list'
            ],
            // non-cacheable actions
            [
                'Pm' => 'list'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'MomoWebdevelopment.MomoPreciousmetal',
            'Pmchart',
            [
                'Pm' => 'chart'
            ],
            // non-cacheable actions
            [
                'Pm' => 'chart'
            ]
        );

    // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        pmlisting {
                            iconIdentifier = momo_preciousmetal-plugin-pmlisting
                            title = LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momo_preciousmetal_pmlisting.name
                            description = LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momo_preciousmetal_pmlisting.description
                            tt_content_defValues {
                                CType = list
                                list_type = momopreciousmetal_pmlisting
                            }
                         }
                    }
                show = *
                }
            }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		$iconRegistry->registerIcon(
		    'momo_preciousmetal-plugin-pmlisting',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:momo_preciousmetal/Resources/Public/Icons/user_plugin_pmlisting.svg']
        );

    }
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][MomoWebdevelopment\MomoPreciousmetal\Task\PmTask::class] = array(
    'extension' => $_EXTKEY,
    'title' => 'Get precious metal prices from json',
    'description' => 'PmTask json'
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][MomoWebdevelopment\MomoPreciousmetal\Task\PmTask1::class] = array(
    'extension' => $_EXTKEY,
    'title' => 'Get precious metal prices from url',
    'description' => 'PmTask1 website'
);
