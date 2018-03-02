<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class ItemAdmin {
    private $itemID = 0;
    private $plainText = '';
    private $itemDescription = '';
    private $itemName = '';

    function __construct($itemData){
        $this->itemID = $itemData->id;
        $this->itemName = $itemData->name;
        if (!empty($itemData->plaintext)){
            $this->plainText = $itemData->plaintext;
        }
        if (!empty($itemData->description)){
            $this->itemDescription = $itemData->description;
        }
        $this->itemUpdate();
    }

    function itemUpdate(){
        global $objDB;
        $itemData = array();
        $itemData['itemID'] = $this->itemID;
        $itemData['plainText'] = $this->plainText;
        $itemData['itemName'] = $this->itemName;
        $itemData['itemDescription'] = $this->itemDescription;

        $objDB->returnInsertVal('tbl_items',$itemData);
    }
}
?>