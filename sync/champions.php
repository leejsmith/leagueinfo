<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once SITEPATH . '/admin/champion/dao.php';

$url = SITEPATH . '/_site/json/champions.json'; 
$champion_info = file_get_contents($url);

$champion_json = json_decode($champion_info, false);

foreach ($champion_json->data as $champion) {
    echo $champion->name . '<br/>';
    echo json_encode($champion->stats);
}

echo $objDB->query('SELECT * FROM tbl_Champions');

?>