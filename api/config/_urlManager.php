<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // Api
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'question',
        ],
    ]
];
