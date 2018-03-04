<?php
   if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

global $objDB;
$apiKeyArr = $objDB->getConnection()->query("SELECT confValue FROM tbl_SiteConfig WHERE confName = 'apiKey'");
$apiKey = $apiKeyArr->fetch_assoc()['confValue'];

//$newVer = json_decode(file_get_contents('https://euw1.api.riotgames.com/lol/static-data/v3/versions?api_key=' .  $_SESSION['apiKey'])){0};
$newVer = json_decode(file_get_contents(SITEPATH . '/_site/json/version.json')){0};

if ($_SESSION['apiVersion'] == ''){
    $objDB->getConnection()->query('INSERT INTO tbl_SiteConfig (confName, confValue) VALUES (\'apiVersion\', \''. $newVer . '\');');
} else{
    preg_match('/([0-9]{0,})\.([0-9]{0,})\.([0-9]{0,})/', $_SESSION['apiVersion'],$oldVerParsed);
    preg_match('/([0-9]{0,})\.([0-9]{0,})\.([0-9]{0,})/', $newVer,$newVerParsed);
    $boolIsNewVersion = false;
    if ($oldVerParsed[3] < $newVerParsed[3]){
        $boolIsNewVersion = true;
    } else {
        if ($oldVerParsed[2] < $newVerParsed[2]){
            $boolIsNewVersion = true;
        } else {
            if ($oldVerParsed[1] < $newVerParsed[1]){
                $boolIsNewVersion = true;
            } 
        }
    }

    if($boolIsNewVersion){
        $objDB->getConnection()->query('UPDATE tbl_SiteConfig SET confValue=\''.$newVer . '\' WHERE confName=\'apiVersion\'');
        $_SESSION['newVersion'] = true;
        mysqli_error($objDB->getConnection());
    } else {
        $_SESSION['newVersion'] = false;
    }

}
echo '<style type="text/css">* {font-size:10px !important}</style>';
include_once SITEPATH . '/admin/sync/maps.php';
include_once SITEPATH . '/admin/sync/items.php';
include_once SITEPATH . '/admin/sync/champions.php';
?>