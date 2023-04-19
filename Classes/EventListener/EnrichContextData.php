<?php

declare(strict_types=1);

/*
 * This file is part of the Extension "add_pwd_policy" for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Derhansen\AddPwdPolicy\EventListener;

use TYPO3\CMS\Backend\Authentication\PasswordReset;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\PasswordPolicy\Event\EnrichPasswordValidationContextDataEvent;
use TYPO3\CMS\FrontendLogin\Controller\PasswordRecoveryController;
use TYPO3\CMS\Setup\Controller\SetupModuleController;

class EnrichContextData
{
    public function __invoke(EnrichPasswordValidationContextDataEvent $event): void
    {
        // Add data for fe_users and be_users when password is changed using TYPO3 form engine/dataHandler
        if ($event->getInitiatingClass() === DataHandler::class) {
            $event->getContextData()->setData('currentMiddleName', $event->getUserData()['middle_name'] ?? '');
            $event->getContextData()->setData('currentEmail', $event->getUserData()['email'] ?? '');
        }

        // Add data for be_users when password is changed in setup module
        if ($event->getInitiatingClass() === SetupModuleController::class) {
            $event->getContextData()->setData('currentEmail', $event->getUserData()['email'] ?? '');
        }

        // Add data for fe_users when password is changed in ext:felogin using the password recovery function
        if ($event->getInitiatingClass() === PasswordRecoveryController::class) {
            $event->getContextData()->setData('currentEmail', $event->getUserData()['email'] ?? '');
        }

        // Add data for be_users when password is changed in ext:backend using the password recovery function
        if ($event->getInitiatingClass() === PasswordReset::class) {
            $event->getContextData()->setData('currentEmail', $event->getUserData()['email'] ?? '');
        }
    }
}
