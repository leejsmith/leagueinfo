<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

    class Navigation {
        private $navJson = '';
        private $navArray = null;

        function __construct(){
            global $objDB;
            $this->navJson = $objDB->query("SELECT confValue FROM tbl_SiteConfig WHERE confName = 'globalNav'")->fetch_assoc()['confValue'];
            $navArray = $this->generateNav();
        }

        function rebuildNavigationCache(){
            global $objDB;
            $navOutput = '{';
            
            // Add Home
            $navOutput .= '"home":{';
            $navOutput .= '"title":"Home",';
            $navOutput .= '"url":"/"},';
            
            //Add Champions
            $alphabet = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
            $navOutput .= '"champions":{';
            $navOutput .= '"title":"Champions","url":"/champions","subitems":{';
            foreach ($alphabet as $letter){
                $navOutput .= '"' . $letter . '":{';
                $navOutput .= '"title":"' . strtoupper($letter) . '",';
                $navOutput .= '"url":"/champions/' . $letter . '",';
                $navOutput .= '"subitems":{';
                $result = $objDB->query("SELECT championID, champName, champKey FROM tbl_Champions WHERE champName LIKE '" . mysqli_real_escape_string($objDB->getConnection(), $letter) . "%' ORDER BY champName");
                $champCount = mysqli_num_rows($result);
                $idx = 0;
                while ($row = $result->fetch_assoc()){
                    $navOutput .= '"' . strtolower($row['champKey']) . '":{';
                    $navOutput .= '"title":"' . $row['champName'] . '",';
                    $navOutput .= '"url":"/champions/' . $letter . '/' . strtolower($row['champKey']) . '",';
                    $navOutput .= '"square":"' . strtolower($row['champKey']) . '_0.jpg"';
                    $idx++;
                    if ($idx < $champCount){
                        $navOutput .='},';
                    } else {
                        $navOutput .='}';
                    }
                    
                }
                $navOutput .= '}';
                if ($letter == 'z'){
                    $navOutput .= '}';
                } else {
                    $navOutput .= '},';
                }
            }
            $navOutput .= '}';
            $navOutput .= '},';
            $alphabet = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
            $navOutput .= '"items":{';
            $navOutput .= '"title":"Items","url":"/Items","subitems":{';
            foreach ($alphabet as $letter){
               
                $result = $objDB->query("SELECT itemID, itemName FROM tbl_Items WHERE itemName LIKE '" . mysqli_real_escape_string($objDB->getConnection(), $letter) . "%' ORDER BY itemName");
                if(!$result == NULL){
                    $navOutput .= '"' . $letter . '":{';
                    $navOutput .= '"title":"' . strtoupper($letter) . '",';
                    $navOutput .= '"url":"/items/' . $letter . '",';
                    $navOutput .= '"subitems":{';
                    $itemCount = mysqli_num_rows($result);
                    $idx = 0;
                    while ($row = $result->fetch_assoc()){
                        $itemNameClean = str_replace(' ','',str_replace('\'','',strtolower($row['itemName'])));
                        $navOutput .= '"' . $row['itemID'] . '":{';
                        $navOutput .= '"title":"' . $row['itemName'] . '",';
                        $navOutput .= '"url":"/items/' . $letter . '/' . $itemNameClean . '",';
                        $navOutput .= '"square":"' . $row['itemID'] . '.png"';
                        $idx++;
                        if ($idx < $itemCount){
                            $navOutput .='},';
                        } else {
                            $navOutput .='}';
                        }
                        
                    }
                    $navOutput .= '}';
                    if ($letter == 'z'){
                        $navOutput .= '}';
                    } else {
                        $navOutput .= '},';
                    }
                } else {
                    $navOutput .= '"' . $letter . '":{';
                    $navOutput .= '"title":"' . strtoupper($letter) . '",';
                    $navOutput .= '"url":"/items/' . $letter . '"';
                    if ($letter == 'z'){
                        $navOutput .= '}';
                    } else {
                        $navOutput .= '},';
                    }
                }
            }

            $navOutput .= '}';
            $navOutput .= '}';
            $navOutput .= '}';
            $dbOut = array();
            $dbOut['globalNav'] = $navOutput;
            $objDB->insertUpdate("INSERT INTO tbl_SiteConfig (confName, confValue) VALUES ('globalNav','" . mysqli_real_escape_string($objDB->getConnection(), $navOutput) . "') ON DUPLICATE KEY UPDATE confValue = '" .  mysqli_real_escape_string($objDB->getConnection(), $navOutput) . "'");
            return $navOutput;
        }

        function getNavigationCache(){
            return $this->navJson;
        }

        function getNavigation(){
            return $this->navArray;
        }

        function generateNav(){
            $this->navArray = new NavigationTree($this->navJson);
        }
    }

class NavigationTree {
    private $root = null;

    function __construct($json){
        $this->tree = array();
        $this->root = new Node('Main Menu', null, '/');
        $this->root->addChild($json);
    }

    function getRoot(){
        return $this->root;
    }
}

class Node{
    private $children = null;
    private $name = '';
    private $url ='';
    private $parent = null;

    function __construct($name, $parent, $url){
        $this->name = $name;
        $this->parent = $parent;
        $this->url = $url;
        $this->children = array();
    }

    function addChild($json){
        if ($json != null && !empty($childJson = json_decode($json))){
            foreach($childJson as $childNode){
                if (!empty($childNode->title)){
                    $hasChildren = empty($childNode->subitems) ? null : json_encode($childNode->subitems);
                    $childNode = new Node($childNode->title, $this,$childNode->url);
                    $childNode->addChild($hasChildren);
                }
                array_push($this->children, $childNode);
            }
        } else {
            $this->children = null;
        }
    }

    function getSiblings(){
        return $this->parent->getChildren();
    }

    function getAbsTop(){
        $currentNode = $this;
        while ($currentNode->parent != null){
            $currentNode = $currentNode->parent;
        }
        return $currentNode;
    }

    function getChildren(){
        return $this->children;
    }

    function getURL(){
        return $this->url;
    }

    function getTitle(){
        return $this->name;
    }
}
?>
