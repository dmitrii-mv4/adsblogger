<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'ru-RU',
    'components' => [

        'authManager' => ['class' => 'yii\rbac\PhpManager'],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BvJ_NczGqdaU1xTMO9ZLXZIoQZkzK7ii',
            'baseUrl'=> '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User', // авторизация и регистрация
            'enableAutoLogin' => true, // воставливает авторизацию по кукам "Запомнить меня"
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'<action:\w+>' => 'site/<action>',
                //'<action:(add_blogger|login|signup|logout)>' => 'site/<action>',
                'login'                 => 'site/login',
                'signup'                => 'site/signup',
                'logout'                => 'site/logout',
                'agreed'                => 'site/agreed',
                'work'                  => 'site/work',
                'filter'                => 'site/filter',
                
                'manager/ja'            => 'manager/ja',
                
                'blogger/view/<id>'     => 'blogger/view',
                'blogger/update/<id>'   => 'blogger/update',
                'blogger/delete/<id>'   => 'blogger/delete',

                'platform/view/<id>'     => 'platform/view',
                'platform/update/<id>'   => 'platform/update',
                'platform/delete/<id>'   => 'platform/delete',

                'project/view/<id>'     => 'project/view',
                'project/update/<id>'   => 'project/update',
                'project/delete/<id>'   => 'project/delete',

                'user/view/<id>'        => 'user/view',
                'user/update/<id>'      => 'user/update',
                'user/delete/<id>'      => 'user/delete',

                'category/view/<id>'    => 'category/view',
                'category/update/<id>'  => 'category/update',
                'category/delete/<id>'  => 'category/delete',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['149.126.16.222', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['149.126.16.222', '::1'],
    ];
}

return $config;
