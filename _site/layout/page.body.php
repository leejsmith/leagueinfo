<header>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/_includes/classes/class.navigation.php';
    $nav = new Navigation();
    require_once SITEPATH . '/_includes/scripts/display_navigation.php';
    $navTemplate = '<li class="{item_class}"><a href="{item_url}">{item_title}</a>{item_subitems}</li>';
    $nav->rebuildNavigationCache();
    ?>
    <div class="menu">
    <?php echo displayNavigation($nav->getNavigation()->getRoot()->getChildren(), 2,0, $navTemplate, 'main_menu'); ?>
    </div>

    <div class="hero">
        <div class="hero_slideshow">
            <div class="hero_slideshow_image_holder">
                <img class="hero_slideshow_image" src="/_includes/images/background.png">
            </div>        
        </div>
        <div class="hero_title_holder">
        </div>
    </div>
</header>