<?php

function getConfig(){
    $pf = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR;
    $maintemplate = $pf . 'mainview' . DIRECTORY_SEPARATOR . 'main.php';
    $singletemplate = $pf . 'singleview' . DIRECTORY_SEPARATOR . 'main.php';
    $registertemplate = $pf . 'mainview' . DIRECTORY_SEPARATOR . '_registerform.php'; // Pfad zu deiner Registrierungsformular-Datei

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
            'register' => [ // Hier fügst du die Konfiguration für die Registrierungsseite hinzu
                'title' => 'Registrierung',
                'template' => $registertemplate,
            ],
            // Füge weitere Seiten nach Bedarf hinzu...
        ],
    ];
}
