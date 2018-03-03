<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/maps/dao.php';

$url = SITEPATH . '/_site/json/maps.json';
global $objDB;
$apiKeyArr = $objDB->getConnection()->query("SELECT confValue FROM tbl_SiteConfig WHERE confName = 'apiKey'");
$apiKey = $apiKeyArr->fetch_assoc()['confValue']; 
//$url = 'https://euw1.api.riotgames.com/lol/static-data/v3/maps?locale=en_GB&version='.$_SESSION['apiVersion'].'&api_key=' . $_SESSION['apiKey']; 

$map_info = file_get_contents($url);
$map_json = json_decode($map_info, false);

foreach ($map_json->data as $map) {
    $mapInfo = new MapAdmin($map);
}

?>