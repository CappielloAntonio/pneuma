<?php

use yii\helpers\Url;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'it-IT',
    'name' => 'Template',
    'timeZone' => 'Europe/Rome',
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

            // Faccio in modo che le classi dell'estensione User puntino al layout vuoto, quello senza sidebar o header
            'controllerMap' => [
                'security' => 'app\modules\user\controllers\SecurityController',
                'registration' => [
                    'class' => 'dektrium\user\controllers\RegistrationController',
                    'layout' => '//main-login'
                ],
                'recovery' => [
                    'class' => 'dektrium\user\controllers\RecoveryController',
                    'layout' => '//main-login'
                ],
            ],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Module',
            'roles' => ['admin'],
            'root' => [
                '@app/modules',
                '@app/views',
                '@app/models',
                '@app/controllers',
            ],
            'controllerMap' => [
                'language' => [
                    'class' => 'app\modules\translation\controllers\LanguageController',
                    'layout' => '//main',
                ],
            ],
        ],
        'system' => [
            'class' => 'app\modules\system\Module',
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
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error'],
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
        ],
        'user' => [
            'loginUrl' => 'user/login'
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
