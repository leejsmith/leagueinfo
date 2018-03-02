<?php
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
?>
