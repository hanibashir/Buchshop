<?php

function getConfig(){
    //$pf = '.' . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR;
    $pf = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR;
    $maintemplate = $pf . 'mainview' . DIRECTORY_SEPARATOR . 'main.php';
    $singletemplate = $pf . 'singleview' . DIRECTORY_SEPARATOR . 'main.php';
    return  [
        'general' => [
            'templatePath' => $pf
        ],
        'pages' => [
            'main' => [
                'title' => 'Wosny.net – Ihr Spezialist für Bücher und mehr!',
                'template' => $maintemplate,
            ],
            'single' => [
                'title' => 'Ein Einzelartikel',
                'template' => $singletemplate,
            ],
        ],
    ];
}
