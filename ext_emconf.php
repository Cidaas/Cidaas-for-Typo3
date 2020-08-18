<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "cidaas".
 *
 * Auto generated 09-07-2020 09:26
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
      'typo3' => '8.7.0-9.5.99',
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
  'author_company' => 'Widas Concepts',
  'version' => '1.0.7',
  'clearcacheonload' => false,
);

