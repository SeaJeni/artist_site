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

    'modules' => [

        'files' => [
            'class' => 'floor12\files\Module',
            'storage' => '@app/storage',
            'cache' => '@app/storage_cache',
            'token_salt' => 'some_token_salt',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',

        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['/site/start'],

        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],
        'urlManagerFrontEnd' => [

            'class' => 'yii\web\urlManager',
            'baseUrl' => 'http://julia/frontend/web/site/signup',
            'enablePrettyUrl' => true,
            'showScriptName' => false,

        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => yii\twig\ViewRenderer::class,
                    'cachePath' => '@runtime/Twig/cache',
                    // Array of twig options:
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => ['class' => '\yii\helpers\Html'],
                    ],
                    'uses' => ['yii\bootstrap'],
                ],

            ],

        ],

        'timezoneDetector' => [
            'class' => 'Dater\TimezoneDetector',
        ],
    ],
    'on ' . yii\base\Application::EVENT_BEFORE_REQUEST => function ($event) {
        $clientTimezone = Yii::$app->timezoneDetector->getClientTimezone(); // часовой пояс пользователя
        if (isset($clientTimezone)) Yii::$app->timeZone = $clientTimezone;
    },

    'params' => $params,
];
