<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/_includes/classes/class.navigation.php';
$nav = new Navigation();
$nav->rebuildNavigationCache();
//$nav->getNavigationCache();
var_dump($nav->getNavigation());
?>