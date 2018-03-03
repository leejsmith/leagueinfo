<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/champion/dao.php';

$url = SITEPATH . '/_site/json/champions.json'; 
//$url = 'https://euw1.api.riotgames.com/lol/static-data/v3/champions?locale=en_GB&version=' . $_SESSION['apiVersion'] . '&champListData=all&tags=all&dataById=true&api_key=' . $_SESSION['apiKey']; 

$champion_info = file_get_contents($url);

$champion_json = json_decode($champion_info, false);

foreach ($champion_json->data as $champion) {
    $championInfo = new ChampionAdmin($champion);
}

?>