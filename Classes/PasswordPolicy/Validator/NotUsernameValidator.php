<?php

declare(strict_types=1);

/*
 * This file is part of the Extension "add_pwd_policy" for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Derhansen\AddPwdPolicy\PasswordPolicy\Validator;

use TYPO3\CMS\Core\PasswordPolicy\Validator\AbstractPasswordValidator;
use TYPO3\CMS\Core\PasswordPolicy\Validator\Dto\ContextData;

class NotUsernameValidator extends AbstractPasswordValidator
{
    private const IDENTIFIER = 'notUsername';

    public function validate(string $password, ?ContextData $contextData = null): bool
    {
        $lang = $this->getLanguageService();

        if (!$contextData) {
            return true;
        }

        $usernameValues = [];
        if ($contextData->getNewUsername() !== '') {
            $usernameValues[] = strtolower($contextData->getNewUsername());
        }

        if ($contextData->getData('currentUsername') !== '') {
            $usernameValues[] = strtolower($contextData->getData('currentUsername'));
        }

        $isValid = true;

        foreach ($usernameValues as $usernameValue) {
            if (str_contains(strtolower($password), $usernameValue)) {
                $this->addErrorMessage(
                    self::IDENTIFIER,
                    $lang->sL('LLL:EXT:add_pwd_policy/Resources/Private/Language/locallang.xlf:error.notUsername')
                );

                $isValid = false;
                break;
            }
        }

        return $isValid;
    }

    public function initializeRequirements(): void
    {
        $this->addRequirement(
            self::IDENTIFIER,
            $this->getLanguageService()->sL('LLL:EXT:add_pwd_policy/Resources/Private/Language/locallang.xlf:requirement.notUsername')
        );
    }
}
