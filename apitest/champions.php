<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

//The URL that we want to GET.
//$url = 'https://euw1.api.riotgames.com/lol/static-data/v3/champions?locale=en_US&champListData=info&dataById=false&api_key=RGAPI-8784eeb3-edaf-4125-9548-374b93453fc0';
$url = '../_site/json/champions.json'; 

//Use file_get_contents to GET the URL in question.
$champion_info = file_get_contents($url);

$champion_json = json_decode($champion_info, false);
//print_r($champion_info);
foreach ($champion_json->data as $champion) {
    echo $champion->name;
}

//phpinfo();

?>