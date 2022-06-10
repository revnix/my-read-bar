<?php

class Display {
    public function init() {
        require_once(dirname( __FILE__ ) . '/menu.php');
        require_once(dirname( __FILE__ ) . '/settings.php');

        $menu = new Menu();
        $settings = new Settings();

        $menu->register();
        $settings->register();
    }
}