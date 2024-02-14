<?php
function getRoute(){
    $pf = getConfig()['general']['templatePath'];
    if (array_key_exists('page', $_GET)){
        $page = $_GET['page'];
    } else {
        $page = 'main';
    }

    switch ($page){
        case 'main':
            return getConfig()['pages']['main'];
        case 'single':
            return getConfig()['pages']['single'];
        default:
            return getConfig()['pages']['main'];
    }
}
