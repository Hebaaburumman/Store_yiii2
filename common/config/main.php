<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@backendWeb' => 'http://localhost:8080/backend/web/', // Adjust the URL as needed
            // Other aliases...
       
         '@commonImg' => '@common/web/img/',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'security' => [
            'passwordHashStrategy' => 'password_hash', // Use bcrypt algorithm
            // Other security component configurations can go here
        ],
    ],
];
