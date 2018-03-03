<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/items/dao.php';

$url = SITEPATH . '/_site/json/items.json'; 
//$url = 'https://euw1.api.riotgames.com/lol/static-data/v3/items?locale=en_GB&itemListData=all&version='.$_SESSION['apiVersion'].'&tags=all&api_key='. $_SESSION['apiKey']; 

$item_info = file_get_contents($url);

$item_json = json_decode($item_info, false);

foreach ($item_json->data as $item) {
    $itemInfo = new ItemAdmin($item);
}

?>