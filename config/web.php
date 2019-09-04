<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'it-IT',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'translatemanager'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',

            // If this option is set to true, module sends email that contains a confirmation link that user must click to complete registration.
            'enableConfirmation' => true,

            // If this option is to true, users will be able to log in even though they didn't confirm his account.
            'enableUnconfirmedLogin' => false,

            // The time in seconds before a confirmation token becomes invalid. After expiring this time user have to request new confirmation token on special page.
            'confirmWithin' => 21600,

            // Cost parameter used by the Blowfish hash algorithm. The higher the value of cost, the longer it takes to generate the hash and to verify a password against it.
            'cost' => 12,

            // Yii2-user has special admin pages where you can manager registered users or create new user accounts. You can specify the username of users that will be able to access those pages.
            'admins' => ['admin'],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Module',
            'roles' => ['admin'],
            'root' => [
                '@app/views',
                '@app/models',
                '@app/controllers',
            ],
            'controllerMap' => [
                'language' => [
                    'class' => 'app\controllers\translatemanager\LanguageController',
                    'layout' => '//main',
                ],
            ],
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CGRPJ4L5vtmrBmzhOniXS5px2kosp8oA',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'xx-XX', // Developer language
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'cachingDuration' => 86400,
                    'enableCaching' => true,
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
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
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Component'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
