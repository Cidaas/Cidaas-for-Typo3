<?php

defined('TYPO3_MODE') || die();

$tempColumns = [
    'tx_oidc_pattern' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:cidaas/Resources/Private/Language/locallang_db.xlf:fe_groups.tx_oidc_pattern',
        'config' => [
            'type' => 'input',
            'size' => 30,
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_groups', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_groups', 'tx_oidc_pattern');
