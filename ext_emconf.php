<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Additional Password Policy validators',
    'description' => 'Additional password validators for usage in TYPO3 password policies',
    'category' => 'be',
    'author' => 'Torben Hansen',
    'author_email' => 'derhansen@gmail.com',
    'state' => 'stable',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'version' => '1.2.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-14.3.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
