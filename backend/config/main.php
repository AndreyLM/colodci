<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'aliases' => [
        '@static' => $params['staticHostInfo'],
        '@staticRoot' => $params['staticPath'],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'],
            'plugin' => [
                [
                    'class'=>'\mihaildev\elfinder\plugin\Sluggable',
                    'lowercase' => true,
                    'replacement' => '-'
                ]
            ],
            'roots' => [
                [
                    'baseUrl'=>'@static',
                    'basePath'=>'@staticRoot',
                    'path' => 'files/global',
                    'name' => 'Global'
                ],
            ],
        ],
    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => $params['cookieValidationKey'],

        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced',
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

        'backendUrlManager' => require __DIR__.'/urlManager.php',
        'frontendUrlManager' => require __DIR__.'/../../frontend/config/urlManager.php',
        'urlManager' => function() {
            return Yii::$app->get('backendUrlManager');
        },
    ],
    'as access' => [
        'class' => \yii\filters\AccessControl::className(),
        'except' => ['site/login'],
        'rules' => [
            [
                'actions' => ['signup'],
                'allow' => true,
                'roles' => ['?'],
            ],

            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];
