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
    'version' => '1.1.1',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.4.99',
            'php' => '8.1.0-8.3.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
