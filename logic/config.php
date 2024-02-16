<?php

function getConfig(){
    $templates_pf = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
    $main_template = $templates_pf . 'main_view' . DIRECTORY_SEPARATOR . 'main.php';
    $single_template = $templates_pf . 'single_view' . DIRECTORY_SEPARATOR . 'main.php';
    $register_template = $templates_pf . 'auth' . DIRECTORY_SEPARATOR . '_registerform.php'; // Pfad zu deiner Registrierungsformular-Datei

    return  [
        'general' => [
            'templatePath' => $templates_pf
        ],
        'pages' => [
            'main' => [
                'title' => 'Wosny.net – Ihr Spezialist für Bücher und mehr!',
                'template' => $main_template,
            ],
            'single' => [
                'title' => 'Ein Einzelartikel',
                'template' => $single_template,
            ],
            'register' => [ // Hier fügst du die Konfiguration für die Registrierungsseite hinzu
                'title' => 'Registrierung',
                'template' => $register_template,
            ],
            // Füge weitere Seiten nach Bedarf hinzu...
        ],
    ];
}
