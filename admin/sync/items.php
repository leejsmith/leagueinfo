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

$itemTagArr = array();

$itemTagArr['start'] = array('lane' => 'LANE', 'Jungle' => 'JUNGLE');
$itemTagArr['tools'] = array('gold income' => 'GOLDPER', 'consumable' => 'CONSUMABLE','vision' => 'VISION', 'trinket' => 'TRINKET' );
$itemTagArr['defense'] = array('health' => 'HEALTH', 'health regen' => 'HEALTHREGEN', 'armour' => 'ARMOR', 'magic resist' => 'SPELLBLOCK');
$itemTagArr['attack'] = array('life steal' => 'LIFESTEAL', 'critical strike' => 'CRITICALSTRIKE', 'damage' => 'DAMAGE','attack speed' => 'ATTACKSPEED', 'armour penetration' => 'ARMORPENETRATION');
$itemTagArr['magic'] = array('cooldown reduction' => 'COOLDOWNREDUCTION', 'mana' => 'MANA', 'ability power' => 'SPELLDAMAGE', 'mana regen' => 'MANAREGEN', 'magic penetration' => 'MAGICPENETRATION');
$itemTagArr['movement'] = array('boots' => 'BOOTS', 'other movement' => 'NONBOOTSMOVEMENT');
$itemTagArr['other'] = array('active' => 'ACTIVE', 'spell vamp' => 'SPELLVAMP','aura' => 'AURA','on hit' => 'ONHIT','slow' => 'SLOW', 'stealth' => 'STEALTH', 'tenacity' => 'TENACITY');
$itemTagToJSON = json_encode($itemTagArr);
$objDB->insertUpdate("INSERT INTO tbl_SiteConfig (confName, confValue) VALUES ('itemTags','" . mysqli_real_escape_string($objDB->getConnection(), $itemTagToJSON) . "') ON DUPLICATE KEY UPDATE confValue = '" .  mysqli_real_escape_string($objDB->getConnection(), $itemTagToJSON) . "'");

foreach ($item_json->data as $item) {
    $itemInfo = new ItemAdmin($item);
}

?>