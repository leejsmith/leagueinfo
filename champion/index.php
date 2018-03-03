<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$char = $_GET['char'];
$champ = $_GET['champ'];
$action = '';
if (!$char == '') {
    $action = 'list';
    if (!champ == ''){
        $action = 'champ';
    }
}
include_once SITEPATH . '/_site/layout/globals/global.head.php';
include_once SITEPATH . '/_site/layout/page.head.php';
switch ($action) {
    case 'list':

    case 'champ':

    default:

}
?>