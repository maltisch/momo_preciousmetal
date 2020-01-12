<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm',
        'label' => 'date',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'currency',
        'iconfile' => 'EXT:momo_preciousmetal/Resources/Public/Icons/tx_momopreciousmetal_domain_model_pm.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, date, currency, xau_price, xau_close, xau_open xag_price, xag_close',
    ],
    'types' => [
        '1' => ['showitem' => 'hidden, date, currency, xau_price, xau_close, xau_open, xag_price, xag_close'],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],

        'date' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 10,
                'eval' => 'required',
                'default' => time()
            ],
        ],
        'currency' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.currency',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'xau_price' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.xau_price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'xau_close' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.xau_close',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'xau_open' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.xau_open',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'xau_change' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.xau_change',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'xag_price' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.xag_price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'xag_close' => [
            'exclude' => false,
            'label' => 'LLL:EXT:momo_preciousmetal/Resources/Private/Language/locallang_db.xlf:tx_momopreciousmetal_domain_model_pm.xag_close',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],

    ],
];
