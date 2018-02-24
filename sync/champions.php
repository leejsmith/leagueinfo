<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once SITEPATH . '/admin/champion/dao.php';

// IMG URL http://ddragon.leagueoflegends.com/cdn/img/champion/splash/
// Square http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/ 

//The URL that we want to GET.

//$url = 'https://euw1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&champListData=info&dataById=false&api_key=RGAPI-8784eeb3-edaf-4125-9548-374b93453fc0';

$url = SITEPATH . '/_site/json/champions.json'; 



//Use file_get_contents to GET the URL in question.

$champion_info = file_get_contents($url);



$champion_json = json_decode($champion_info, false);

//print_r($champion_info);

foreach ($champion_json->data as $champion) {
    echo $champion->name . '<br/>';
    echo json_encode($champion->stats);
}

echo $objDB->query('SELECT * FROM tbl_Champions');

//phpinfo();



?>