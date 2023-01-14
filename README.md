# Additional Password Policy validators for TYPO3 CMS

**Note, that this extension is still under development and should not be used
in production.**

This extension for TYPO3 CMS contains additional Password Policy validators for usage in TYPO3 12+ projects.

## Included validators

### Pwned Password

#### Description:

This validator checks, if the given password is part of a known data breach on haveibeenpwned.com

#### Options: 
* none


#### Usage example 

```
$GLOBALS['TYPO3_CONF_VARS']['SYS']['passwordPolicies']['default']['validators'][\Derhansen\AddPwdPolicy\PasswordPolicy\Validator\PwnedPasswordValidator::class] = [
    'options' => [],
    'excludeActions' => [],
];
```
