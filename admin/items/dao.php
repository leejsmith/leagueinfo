<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class ItemAdmin {
    private $itemID = 0;
    private $plainText = '';
    private $itemDescription = '';
    private $itemSanitizedDescription = '';
    private $itemName = '';
    private $itemGoldTotal = 0;
    private $itemGoldSell = 0;
    private $itemGoldBase = 0;
    private $itemPurchasable = false;
    private $itemTags = '';
    private $itemDepth = 0;
    private $itemInto = '';
    private $itemFrom = '';
    private $itemMaps = '';
    private $itemStats = '';
    
    function __construct($itemData){
        $this->itemID = $itemData->id;
        $this->itemName = $itemData->name;
        if (!empty($itemData->plaintext)){
            $this->plainText = $itemData->plaintext;
        }
        if (!empty($itemData->description)){
            $this->itemDescription = $itemData->description;
        }
        if (!empty($itemData->sanitizedDescription)){
            $this->itemSanitizedDescription = $itemData->sanitizedDescription;
        }
        if (!empty($itemData->tags)){
            $this->itemTags = json_encode($itemData->tags);
        }
        if (!empty($itemData->from)){
            $this->itemFrom = json_encode($itemData->from);
        }
        if (!empty($itemData->into)){
            $this->itemInto = json_encode($itemData->into);
        }
        $this->itemStats = json_encode($itemData->stats);
        $this->itemGoldTotal = $itemData->gold->total;
        $this->itemGoldSell = $itemData->gold->sell;
        $this->itemGoldBase = $itemData->gold->base;
        $this->itemPurchasable = $itemData->gold->purchasable;
        if (!empty($itemData->itemDepth)){
            $this->itemDepth = $itemData->depth;
        } else {
            $this->itemDepth = 1;
        }
        $this->itemMaps = json_encode($itemData->maps);
        $this->itemUpdate();
    }

    function itemUpdate(){
        global $objDB;
        $itemData = array();
        $itemData['itemID'] = $this->itemID;
        $itemData['plainText'] = $this->plainText;
        $itemData['itemName'] = $this->itemName;
        $itemData['itemDescription'] = $this->itemDescription;
        $itemData['itemSanitizedDescription'] = $this->itemSanitizedDescription;
        $itemData['itemStats'] = $this->itemStats;
        $itemData['itemGoldTotal'] = $this->itemGoldTotal;
        $itemData['itemGoldSell'] = $this->itemGoldSell;
        $itemData['itemGoldBase'] = $this->itemGoldBase;
        $itemData['itemPurchasable'] = $this->itemPurchasable;
        $itemData['itemTags'] = $this->itemTags;
        $itemData['itemInto'] = $this->itemInto;
        $itemData['itemFrom'] = $this->itemFrom;
        $itemData['itemDepth'] = $this->itemDepth;
        $objDB->returnInsertVal('tbl_items',$itemData);
        $itemToMapsData = array();
        $itemMapData = json_decode($this->itemMaps);
        foreach($itemMapData as $itemMap => $val){
            if ($val == true){
                $itemToMapsData['itemID'] = $this->itemID;
                $itemToMapsData['mapID'] = $itemMap;
                $objDB->returnInsertVal('tbl_ItemToMaps',$itemToMapsData);
            }
        }
    }
}
?>