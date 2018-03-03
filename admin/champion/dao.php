<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
set_time_limit(0);
ob_start();
ob_end_flush();
class ChampionAdmin {
    //private $objDB = NULL;
    private $championID = 0;
    private $name = '';
    private $title = '';
    private $lore = '';
    private $info = '';
    private $allyTips = '';
    private $enemyTips = '';
    private $stats = '';
    private $img = '';
    private $tags = '';
    private $abilityType = '';
    private $skins = '';
    private $passive = '';
    private $spells = '';
    private $recommended = '';
    private $key = '';


    function __construct($championData){
        $this->championID = $championData->id;
        $this->name = $championData->name;
        $this->title = $championData->title;
        $this->lore = $championData ->lore;
        $this->key = $championData->key;
        $this->info = json_encode($championData->info);
        $this->allyTips = json_encode($championData->allytips);
        $this->enemyTips = json_encode($championData->enemytips);
        $this->stats = json_encode($championData->stats);
        $this->img = $championData->image->full;
        $this->tags = json_encode($championData->tags);
        $this->abilityType = $championData->partype;
        $this->skins = json_encode($championData->skins);
        $this->passive = json_encode($championData->passive);
        $this->spells = json_encode($championData->spells);
        $this->recommended = json_encode($championData->recommended);
        $this->championUpdate();
    }

    function getChampionByName($championName){
        global $objDB;
        $strSQL = "SELECT championID FROM tbl_Champions WHERE championName LIKE '" . $championName . "'";
        return $objDB->query($strSQL);
    }

    function championUpdate(){
        global $objDB;
        $championMainData = array();
        $championMainData['championID'] = $this->championID;
        $championMainData['champName'] = $this->name;
        $championMainData['title'] = $this->title;
        $championMainData['champKey'] = $this->key;
        $championMainData['lore'] = $this->lore;
        $championMainData['tags'] = $this->tags;
        $championMainData['info'] = $this->info;
        $championMainData['abilityType'] = $this->abilityType;
        $championMainData['allyTips'] = $this->allyTips;
        $championMainData['enemyTips'] = $this->enemyTips;
        $championMainData['imgFull'] = $this->img;
        $objDB->returnInsertVal('tbl_Champions',$championMainData);
       
        $championStatData = array();
        $decodedStats = json_decode($this->stats);
        $championStatData["championID"] = $this->championID;
        $championStatData["armorperlevel"] = floatval($decodedStats->armorperlevel);
        $championStatData["attackdamage"] = floatval($decodedStats->attackdamage);
        $championStatData["mpperlevel"] = floatval($decodedStats->mpperlevel);
        $championStatData["attackspeedoffset"] = floatval($decodedStats->attackspeedoffset);
        $championStatData["mp"] = floatval($decodedStats->mp);
        $championStatData["armor"] = floatval($decodedStats->armor);
        $championStatData["hp"] = floatval($decodedStats->hp);
        $championStatData["hpregenperlevel"] = floatval($decodedStats->hpregenperlevel);
        $championStatData["attackspeedperlevel"] = floatval($decodedStats->attackspeedperlevel);
        $championStatData["attackrange"] = floatval($decodedStats->attackrange);
        $championStatData["movespeed"] = floatval($decodedStats->movespeed);
        $championStatData["attackdamageperlevel"] = floatval($decodedStats->attackdamageperlevel);
        $championStatData["mpregenperlevel"] = floatval($decodedStats->mpregenperlevel);
        $championStatData["critperlevel"] = floatval($decodedStats->critperlevel);
        $championStatData["spellblockperlevel"] = floatval($decodedStats->spellblockperlevel);
        $championStatData["crit"] = floatval($decodedStats->crit);
        $championStatData["mpregen"] = floatval($decodedStats->mpregen);
        $championStatData["spellblock"] = floatval($decodedStats->spellblock);
        $championStatData["hpregen"] = floatval($decodedStats->hpregen);
        $championStatData["hpperlevel"] = floatval($decodedStats->hpperlevel);
        $objDB->returnInsertVal('tbl_ChampionStats',$championStatData);

        $championSkinData = array();
        $decodedSkins = json_decode($this->skins);
        foreach($decodedSkins as $skin) {
            $championSkinData['skinID'] = $skin->id;
            $championSkinData['championID'] = $this->championID;
            $championSkinData['num'] = $skin->num;
            $championSkinData['skinName'] = $skin->name;
            $objDB->returnInsertVal('tbl_ChampionSkins',$championSkinData);
        }

        $championItemData = array();
        $decodedItems = json_decode($this->recommended);
        foreach ($decodedItems as $itemset){
            $championItemData['champItemID'] = $itemset->title;
            $championItemData['championID'] = $this->championID;
            $championItemData['map'] = $itemset->map;
            $championItemData['data'] = json_encode($itemset->blocks);
            $objDB->returnInsertVal('tbl_ChampionItems',$championItemData);
        }
        //spells
        $passiveDecode = json_decode($this->passive);
        $passiveData = array();
        $passiveData['spellID'] = $this->key . '_p';
        $passiveData['spellKey'] = $passiveDecode->name;
        $passiveData['championID'] = $this->championID;
        $passiveData['spellKeyBinding'] = 1;
        $passiveData['spellName'] = $passiveDecode->name;
        $passiveData['spellDescription'] = $passiveDecode->description;
        $passiveData['spellSanitizedDescription'] = $passiveDecode->sanitizedDescription;
        $passiveData['spellImageFull'] = $passiveDecode->image->full;
        $objDB->returnInsertVal('tbl_ChampionSpells',$passiveData);

        //active-Spells
        $spellDecode = json_decode($this->spells);
        $spell_bindings = array('q','w','e','r');
        for ($i = 0; $i < 4; $i++){
            $spellData = array();
            $spellData['spellID'] = $this->key . '_' . $spell_bindings[$i];
            $spellData['spellKey'] = $spellDecode{$i}->key;
            $spellData['championID'] = $this->championID;
            $spellData['spellKeyBinding'] = $i + 2;
            $spellData['spellName'] = $spellDecode{$i}->name;
            if (!empty($spellDecode{$i}->tooltip)){
                $spellData['spellToolTip'] = $spellDecode{$i}->tooltip;
            }
            if (!empty($spellDecode{$i}->tooltip)){
                $spellData['spellDescription'] = $spellDecode{$i}->description;
            }
            if (!empty($spellDecode{$i}->description)){
                $spellData['spellSanitizedDescription'] = $spellDecode{$i}->sanitizedDescription;
            }
            if (!empty($spellDecode{$i}->sanitizedTooltip)){
                $spellData['spellSanitizedToolTip'] = $spellDecode{$i}->sanitizedTooltip;
            }
            if (!empty($spellDecode{$i}->resource)){
                $spellData['spellResource'] = $spellDecode{$i}->resource;
            }
            if (!empty($spellDecode{$i}->vars)){
                $spellData['spellVars'] = json_encode($spellDecode{$i}->vars);
            }
            if (!empty($spellDecode{$i}->costType)){
                $spellData['spellCostType'] = $spellDecode{$i}->costType;
            }
            if (!empty($spellDecode{$i}->maxrank)){
                $spellData['spellMaxRank'] = $spellDecode{$i}->maxrank;
            }
            if (!empty($spellDecode{$i}->cooldown)){
                $spellData['spellCooldown'] = json_encode($spellDecode{$i}->cooldown);
            }
            if (!empty($spellDecode{$i}->cooldownBurn)){
                $spellData['spellCooldownBurn'] = $spellDecode{$i}->cooldownBurn;
            }
            if (!empty($spellDecode{$i}->range)){
                $spellData['spellRange'] = json_encode($spellDecode{$i}->range);
            }
            if (!empty($spellDecode{$i}->rangeBurn)){
                $spellData['spellRangeBurn'] = $spellDecode{$i}->rangeBurn;
            }
            if (!empty($spellDecode{$i}->cost)){
                $spellData['spellCost'] = json_encode($spellDecode{$i}->cost);
            }
            if (!empty($spellDecode{$i}->costBurn)){
                $spellData['spellCostBurn'] = $spellDecode{$i}->costBurn;
            }
            if (!empty($spellDecode{$i}->effect)){
                $spellData['spellEffect'] = json_encode($spellDecode{$i}->effect);
            }
            if (!empty($spellDecode{$i}->effectBurn)){
                $spellData['spellEffectBurn'] = json_encode($spellDecode{$i}->effectBurn);
            }
            if (!empty($spellDecode{$i}->image->full)){
                $spellData['spellImageFull'] = $spellDecode{$i}->image->full;
            }
            $objDB->returnInsertVal('tbl_ChampionSpells',$spellData);
        }
    }
}
?>