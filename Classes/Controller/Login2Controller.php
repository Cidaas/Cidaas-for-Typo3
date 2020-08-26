<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Widas\Cidaas\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\Query\Restriction\EndTimeRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\StartTimeRestriction;

class Login2Controller
{
    /**
     * Global oidc settings
     *
     * @var array
     */
    protected $settings;

    /**
     * TypoScript configuratoin of this plugin
     *
     * @var array
     */
    protected $pluginConfiguration;

    /**
     * @var ContentObjectRenderer will automatically be injected, if this controller is called as a plugin
     */
    public $cObj;

    public function __construct()
    {
        if (version_compare(TYPO3_version, '9.0', '<')) {
            $this->settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['cidaas']);
        } else {
            $this->settings = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['cidaas'] ?? [];
        }
    }

    /**
     * Main entry point for the OIDC plugin.
     *
     * If the user is not logged in, redirect to the authorization server to start the oidc process
     *
     * If the user has just been logged in and just came back from the authorization server, redirect the user to the
     * final redirect URL.
     *
     * @param string $_ ignored
     * @param array|null $pluginConfiguration
     */
    public function login($_ = '', $pluginConfiguration)
    {
        if (is_array($pluginConfiguration)) {
            $this->pluginConfiguration = $pluginConfiguration;
        }

        if (GeneralUtility::_GP('logintype') == 'login') {
            // performRedirectAfterLogin stops flow by emitting a redirect
            $this->performRedirectAfterLogin();
        }

        $this->performRedirectToLogin();
    }

    protected function performRedirectToLogin()
    {
        /** @var \Widas\Cidaas\Service\OAuthService $service */
        $service = GeneralUtility::makeInstance(\Widas\Cidaas\Service\OAuthService2::class);
        $service->setSettings($this->settings);

        $authorizationUrl = $service->getAuthorizationUrl();

        if (session_id() === '') {
            session_start();
        }

        $state = $service->getState();
        $_SESSION['oidc_state'] = $state;
        $_SESSION['oidc_login_url'] = GeneralUtility::getIndpEnv('REQUEST_URI');
        $_SESSION['oidc_authorization_url'] = $authorizationUrl;
        $_SESSION['oidc_referer'] = GeneralUtility::getIndpEnv('HTTP_REFERER');
        unset($_SESSION['oidc_redirect_url']); // The redirect will be handled by this plugin

        HttpUtility::redirect($authorizationUrl);
    }

    protected function performRedirectAfterLogin()
    {
         if (isset($this->pluginConfiguration['defaultRedirectPid'])) {
            $defaultRedirectPid = $this->pluginConfiguration['defaultRedirectPid'];
            if ((int)$defaultRedirectPid > 0) {
                HttpUtility::redirect($this->cObj->typoLink_URL(['parameter' => $defaultRedirectPid]));
            }
        }

        if (session_id() === '') {
            session_start();
        }
        $referer = $_SESSION['oidc_referer'];
        HttpUtility::redirect($referer);
    }

    protected function determineRedirectUrl()
    {
        if (!empty(GeneralUtility::_GP('redirect_url'))) {
            return GeneralUtility::_GP('redirect_url');
        }

        if (isset($this->pluginConfiguration['defaultRedirectPid'])) {
            $defaultRedirectPid = $this->pluginConfiguration['defaultRedirectPid'];
            if ((int)$defaultRedirectPid > 0) {
                return $this->cObj->typoLink_URL(['parameter' => $defaultRedirectPid]);
            }
        }

        return '/';
    }

    public function logout($_ = '', $pluginConfiguration)
    {
        if (is_array($pluginConfiguration)) {
            $this->pluginConfiguration = $pluginConfiguration;
        }


        $this->performRedirectToLogout();
    }

    protected function performRedirectToLogout()
    {

        if (session_id() === '') {
            session_start();
        }
        $logoutUrl = $this->settings['oidcEndpointLogout_b'];
        

        $user = $GLOBALS['TSFE']->fe_user->user['uid'];
                $userTable = 'fe_users';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($userTable);
        $queryBuilder->getRestrictions()->removeAll();
        $row = $queryBuilder
            ->select('*')
            ->from($userTable)
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($user, \PDO::PARAM_STR))
            )
            ->execute()
            ->fetch();

        // .'&post_logout_redirect_uri=http://localhost/index.php?logintype=logout'
        //HttpUtility::redirect($logoutUrl);
        $token = $row['access_token'];
        $url = $this->settings['baseUrl_b'];
        $logoutUrl .= '?access_token_hint='.$token.'&post_logout_redirect_uri='.$url.'index.php?logintype=logout';

        HttpUtility::redirect($logoutUrl);

    }
}
