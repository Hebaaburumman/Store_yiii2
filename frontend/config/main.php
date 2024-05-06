<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'aliases' => [
        '@backend' => '/var/www/html/advanced/backend',
    ],
    
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            'savePath' => __DIR__ . '/../runtime', // a temporary folder on frontend

        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'currencyCode' => 'JD', // Replace 'USD' with your desired default currency code
        ],
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['login_debug'],
                    'logFile' => '@app/runtime/logs/login_debug.log',
                ],
            ],
            
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/uploads/', // Set a placeholder URL
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Custom rule to map URLs to the backend's uploads directory
                'uploads/<path:.*>' => '/var/www/html/advanced/backend/web/img/<path>',
            ],
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
       
        
    ],
    'params' => $params,

];
