<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

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


    function __construct($championData){
        $this->championID = $championData->id;
        $this->name = $championData->name;
        $this->title = $championData->title;
        $this->lore = $championData ->lore;
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
        
        

    }
}
?>