<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$letter = $_GET['letter'];
$champ = $_GET['champ'];
$action = '';
if (!$letter == '') {
    $action = 'list';
    if (!champ == ''){
        $action = 'champ';
    }
}
echo $letter . " - " . $champ;
include_once SITEPATH . '/_site/layout/globals/global.head.php';
include_once SITEPATH . '/_site/layout/page.head.php';

?>