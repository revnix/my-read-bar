<?php

class Display
{
    public function init()
    {
        include_once dirname(__FILE__) . '/menu.php';
        include_once dirname(__FILE__) . '/settings.php';

        $menu = new Menu();
        $settings = new Settings();

        $menu->register();
        $settings->register();
    }
}
