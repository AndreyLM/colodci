<?php
return [
'class' => 'yii\web\UrlManager',
    'baseUrl' => '/',
//    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => true,
    'cache' => false,
//    'enableStrictParsing' => true,
    'rules' => [
        '' => 'site/index',
        '<_a:login|logout>' => 'site/<_a>',

        '<c_:[\w\-]>' => '<c_>/index',
        '<c_:[\w\-]>/<id:\d+>' => '<c_>/view',

        '<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];