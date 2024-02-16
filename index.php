<?php
include '.' . DIRECTORY_SEPARATOR . 'logic' . DIRECTORY_SEPARATOR . 'config.php';
include '.' . DIRECTORY_SEPARATOR . 'logic' . DIRECTORY_SEPARATOR . 'router.php';
$config = getConfig();
$pf = '.' . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR . 'singleview' . DIRECTORY_SEPARATOR;
$view = getRoute();
$title = $view['title'];

include $pf . '../_header.php';
include $pf . '_seitenheader.php';
include $pf . '../components/_navsuchfeld.php';
include $pf . '../components/_navkategorien.php';
include $view['template'];
include $pf . '_ueberuns.php';
include $pf . '../_footer.php';