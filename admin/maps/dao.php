<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class MapAdmin {
    private $mapID = 0;
    private $mapName = '';
    
    function __construct($mapData){
        $this->mapID = $mapData->mapId;
        $this->mapName = $mapData->mapName;
        $this->mapUpdate();
    }

    function mapUpdate(){
        global $objDB;
        $mapData = array();
        $mapData['mapID'] = $this->mapID;
        $mapData['mapName'] = $this->mapName;
        $objDB->returnInsertVal('tbl_maps',$mapData);
    }
}
?>