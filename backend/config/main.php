<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'aliases' => [
        
          '@frontend' => '/var/www/html/advanced/frontend',
        
         '@backendWeb' => 'http://localhost:8080/backend/', // Adjust the URL as needed
        // Other aliases...
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'], // Set the login URL

            'identityCookie' => [
                'name' => '_identity-backend',
                'path' => '/backend', // Change cookie path
                'httpOnly' => true
            ],

            
        ],
        'session' => [
            'name' => 'advanced-backend',
            'savePath' => __DIR__ . '/../runtime',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'], // Include 'info' level for Yii::info() messages
                ],
        ],
    ],
    
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Define your URL rules here
                'category/list' => 'category/list',
                'backend/category/create' => 'category/create',
                'backend/category/store' => 'category/store',
                'backend/category/edit/<id:\d+>' => 'category/edit',
                'backend/category/update/<id:\d+>' => 'category/update',
                'backend/category/destroy/<id:\d+>' => 'category/destroy',
                'backend/site/index' => 'site/index',
                'backend' => 'site/index',
            ],
        ],
       
        
    ],
    'params' => $params,
];

