<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once SITEPATH . '/_site/layout/globals/global.header.php';
require_once SITEPATH . '/_site/layout/page.head.php';
require_once SITEPATH . '/_site/layout/page.body.php';
require_once SITEPATH . '/_site/layout/page.footer.php';
require_once SITEPATH . '/_site/layout/globals/global.footer.php';
?>