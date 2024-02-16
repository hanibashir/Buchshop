<?php
require_once '.' . DIRECTORY_SEPARATOR . 'logic' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'connection.php';
include '.' . DIRECTORY_SEPARATOR . 'logic' . DIRECTORY_SEPARATOR . 'config.php';
include '.' . DIRECTORY_SEPARATOR . 'logic' . DIRECTORY_SEPARATOR . 'router.php';
$config = getConfig();
$templates_pf = '.' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
$single_pf = '.' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'single_view' . DIRECTORY_SEPARATOR;
$main_pf = '.' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'main_view' . DIRECTORY_SEPARATOR;
$components_pf = '.' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR;
$auth_pf = '.' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR;
$view = getRoute();
$title = $view['title'];


include $templates_pf . '_header.php';
include $components_pf . '_seitenheader.php';
include $components_pf . '_navsuchfeld.php';
include $components_pf . '_navkategorien.php';
include $view['template'];
//include $pf . '_ueberuns.php';
include $templates_pf . '_footer.php';