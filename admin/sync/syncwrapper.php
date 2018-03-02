<?php
   if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once SITEPATH . '/admin/sync/items.php';
include_once SITEPATH . '/admin/sync/champions.php';
?>