<?php

declare(strict_types=1);

/*
 * This file is part of the Extension "add_pwd_policy" for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Derhansen\AddPwdPolicy\PasswordPolicy\Validator;

use Derhansen\AddPwdPolicy\Service\PwnedPasswordsService;
use TYPO3\CMS\Core\PasswordPolicy\Validator\AbstractPasswordValidator;
use TYPO3\CMS\Core\PasswordPolicy\Validator\Dto\ContextData;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PwnedPasswordValidator extends AbstractPasswordValidator
{
    private const IDENTIFIER = 'pwnedPassword';

    public function validate(string $password, ?ContextData $contextData = null): bool
    {
        $lang = $this->getLanguageService();
        $pwnedPasswordService = GeneralUtility::makeInstance(PwnedPasswordsService::class);

        $isValid = true;

        $pwnedPasswordAmount = $pwnedPasswordService->checkPassword($password);
        if ($pwnedPasswordAmount > 0) {
            $this->addErrorMessage(
                self::IDENTIFIER,
                sprintf(
                    $lang->sL('LLL:EXT:add_pwd_policy/Resources/Private/Language/locallang.xlf:error.pwnedPassword'),
                    $pwnedPasswordAmount
                )
            );

            $isValid = false;
        }

        return $isValid;
    }

    public function initializeRequirements(): void
    {
        $this->addRequirement(
            self::IDENTIFIER,
            $this->getLanguageService()->sL('LLL:EXT:add_pwd_policy/Resources/Private/Language/locallang.xlf:requirement.pwnedPassword')
        );
    }
}
