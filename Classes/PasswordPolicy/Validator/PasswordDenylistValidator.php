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
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PasswordDenylistValidator extends AbstractPasswordValidator
{
    private const IDENTIFIER = 'passwordDenylist';

    public function validate(string $password, ?ContextData $contextData = null): bool
    {
        $lang = $this->getLanguageService();

        $passwordDenylistPath = $this->getPasswordDenylistPath();
        if ($passwordDenylistPath === '') {
            return true;
        }

        $deniedPasswords = file($passwordDenylistPath, FILE_IGNORE_NEW_LINES);

        $isValid = true;
        if (is_array($deniedPasswords) && in_array($password, $deniedPasswords, true)) {
            $this->addErrorMessage(
                self::IDENTIFIER,
                $lang->sL('LLL:EXT:add_pwd_policy/Resources/Private/Language/locallang.xlf:error.passwordDenylist')
            );

            $isValid = false;
        }

        return $isValid;
    }

    public function initializeRequirements(): void
    {
        if ($this->getPasswordDenylistPath() !== '') {
            $this->addRequirement(
                self::IDENTIFIER,
                $this->getLanguageService()->sL('LLL:EXT:add_pwd_policy/Resources/Private/Language/locallang.xlf:requirement.passwordDenylist')
            );
        }
    }

    private function getPasswordDenylistPath(): string
    {
        $passwordDenylistPath = GeneralUtility::getFileAbsFileName($this->options['passwordDenylistFilepath'] ?? '');

        if (is_file($passwordDenylistPath)) {
            return $passwordDenylistPath;
        }

        return '';
    }
}
