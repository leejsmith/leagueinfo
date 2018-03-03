<?php
    session_start();
    if($_SERVER['HTTP_HOST'] == "localhost"){// For local
        define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
        define('SITEPATH', $_SERVER['DOCUMENT_ROOT']);
    }
    else{ // For Web
        define('SITE_URL', "http://" . $_SERVER['HTTP_HOST']);
        define('SITEPATH', $_SERVER['DOCUMENT_ROOT']);
    }
    require_once SITEPATH . '/_includes/classes/class.database.php';
    global $objDB;
    $objDB = new database();
    $apiVerArr = $objDB->getConnection()->query("SELECT confValue FROM tbl_SiteConfig WHERE confName = 'apiVersion'");
    $_SESSION['apiVersion'] = $apiVerArr->fetch_assoc()['confValue'];
    $apiKeyArr = $objDB->getConnection()->query("SELECT confValue FROM tbl_SiteConfig WHERE confName = 'apiKey'");
    $_SESSION['apiKey'] = $apiKeyArr->fetch_assoc()['confValue'];
?>
