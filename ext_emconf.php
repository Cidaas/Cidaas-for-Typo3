<?php

/**
 * Extension Manager/Repository config file for ext "cidaas".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Cidaas For Typo3',
    'description' => 'This extension allows you to log into a TYPO3 frontend via Cidaas. Cidaas stands for “Customer Identity as a Service” and delivers an out-of-the-box solution for standardized Access control and Identity management. Based on OAuth 2.0 and OpenID Connect Standards, the cidaas software can been seamlessly integrated into your business.',
    'category' => 'services',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
            'php' => '7.0.0-7.3.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Widas\\Cidaas\\' => 'Classes',
        ],
    ],
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'author' => 'Gopi Mallela',
    'author_email' => 'gopi.mallela@widas.in',
    'author_company' => 'Widas Concepts',
    'version' => '1.0.1',
];
