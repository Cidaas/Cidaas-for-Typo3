<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "cidaas".
 *
 * Auto generated 26-08-2020 08:15
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Cidaas For Typo3',
  'description' => 'If you would like to use a secure, scalable Identity and Access Management System along with Typo3, look no further.  This Extension allows you to use Cidaas as your Cloud based Identity System. You can have Cidaas perform Authentication and Authorization and access your TYPO3 frontend. Cidaas supports all standard protocols like OAuth 2.0 and OpenID Connect Standards. With easy to integrate SDK you should be able to secure your favourite Typo3 instance in no time!',
  'category' => 'services',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '10.0.0-10.4.99',
      'php' => '7.0.0-7.4.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'autoload' => 
  array (
    'psr-4' => 
    array (
      'Widas\\Cidaas\\' => 'Classes',
    ),
  ),
  'state' => 'stable',
  'uploadfolder' => false,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'author' => 'cidaas by Widas ID GmbH',
  'author_email' => 'developer@cidaas.de',
  'author_company' => 'cidaas by Widas ID GmbH',
  'version' => '2.0.2',
  'clearcacheonload' => false,
);

