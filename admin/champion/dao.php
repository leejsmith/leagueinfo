<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once SITEPATH . '/_includes/classes/class.database.php';

class ChampionAdmin {
    private $objDB = NULL;
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
        $this->objDB = new database();
        $this->championID = $championData->id;
        $this->name = $championData->name;
        $this->title = $championData->title;
        $this->lore = $championData ->lore;
        $this->info = json_encode($championData->info);
        $this->allyTip = json_encode($championData->allytips);
        $this->enemyTips = json_encode($championData->enemytips);
        $this->stats = json_encode($championData->stats);
        $this->img = $championData->image->full;
        $this->tags = json_encode($championData->tags);
        $this->abilityType = $championData->partype;
        $this->skins = json_encode($championData->skins);
        $this->passive = json_encode($championData->passive);
        $this->spells = json_encode($championData->spells);
        $this->recommended = json_encode($championData->recommended);
    }

    function updateChampion(){

        echo $this->objDB->insertKeyVal('tbl_ChampionSpells',$this->spells);
    }
}
?>