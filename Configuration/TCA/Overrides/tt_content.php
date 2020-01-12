<?php
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MomoWebdevelopment.MomoPreciousmetal',
    'Pmlisting',
    'Precious metal rates as table'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MomoWebdevelopment.MomoPreciousmetal',
    'PmChart',
    'Precious metal rates as chart'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['momopreciousmetal_pmlisting'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['momopreciousmetal_pmchart'] = 'recursive,select_key,pages';
