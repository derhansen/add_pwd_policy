# Additional Password Policy validators for TYPO3 CMS

This extension for TYPO3 CMS contains additional Password Policy validators for
usage in TYPO3 12+ projects. It also adds an event listener for the
`EnrichPasswordValidationContextDataEvent` PSR-14 event, so the context data
used for password validation is extended with the users email-address.

## Included validators

### Pwned Password

#### Description:

This validator ensures, that the given password is not part of a known data
breach on haveibeenpwned.com

#### Options:
* none

#### Usage example

```
$GLOBALS['TYPO3_CONF_VARS']['SYS']['passwordPolicies']['default']['validators'][\Derhansen\AddPwdPolicy\PasswordPolicy\Validator\PwnedPasswordValidator::class] = [
    'options' => [],
    'excludeActions' => [],
];
```

### Does not contain username

#### Description:

This validator ensures, that the given password does not contain the users `username`.

#### Options:
* none

#### Usage example

```
$GLOBALS['TYPO3_CONF_VARS']['SYS']['passwordPolicies']['default']['validators'][\Derhansen\AddPwdPolicy\PasswordPolicy\Validator\NotUsernameValidator::class] = [
    'options' => [],
    'excludeActions' => [],
];
```

### Password deny list

This validator ensures, that the given password is not part of a configurable
list of denied passwords.

The password file must contain one password for each line.

#### Options:
* `passwordDenylistFilepath` Relative path to password file. EXT: notation is allowed.

#### Usage example

```
$GLOBALS['TYPO3_CONF_VARS']['SYS']['passwordPolicies']['default']['validators'][\Derhansen\AddPwdPolicy\PasswordPolicy\Validator\PasswordDenylistValidator::class] = [
    'options' => [
        'passwordDenylistFilepath' => 'EXT:add_pwd_policy/Resources/Private/Text/password_denylist.txt',
    ],
    'excludeActions' => [],
];
```
