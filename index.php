<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

$url = './_site/json/champions.json'; 
$champion_info = file_get_contents($url);
$champion_json = json_decode($champion_info, false);
echo json_encode($champion_json->data->{1});
?>