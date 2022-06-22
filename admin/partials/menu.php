<?php 

class Menu
{
    public function register()
    {
        add_action('admin_menu', [$this, 'register_menu_page']);
    }
    public function register_menu_page()
    {
        add_menu_page( 
            __('My Progress Bar', 'my-read-bar'),
            'My Progress Bar',
            'manage_options',
            'my-progress-bar',
            array($this,'my_progress_bar_setting_page_html'),
            'dashicons-minus',
            100
        ); 
    }

    function my_progress_bar_setting_page_html()
    {

        if (!current_user_can('manage_options')) { return;
        } ?>

        <form method="post" action="options.php">
        <div class="wrap">     
            <h1 class="mpb-title"><?php echo esc_html(get_admin_page_title()); ?></h1>
            <?php settings_errors(); ?>
            <?php
            if(wp_verify_nonce('test-nonce') || isset($_GET[ 'tab' ]) ) {
                $tabValue = sanitize_text_field($_GET[ 'tab' ]);
                $active_tab = isset($tabValue) ? $tabValue : 'setting-options';
                
            } 
            ?>
            <nav class="nav-tab-wrapper wp-clearfix" aria-label="my progress bar setting menu">
                <a href="?page=my-progress-bar&tab=setting-options" class="nav-tab <?php echo $active_tab === 'setting-options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Options', 'my-read-bar');?></a>
                <a href="?page=my-progress-bar&tab=about" class="nav-tab <?php echo $active_tab === 'about' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('About', 'my-read-bar');?></a>
            </nav>
        
            <form method="post" action="options.php">
                <input type="hidden"> 
                <?php

                if($active_tab === 'about') {
                    ?>
                <div class='my-progress-bar-tab'></div>
                    <p><?php esc_html_e('A Quick guide of to use set My Progress Bar', 'my-read-bar'); ?></p>
                    <ol>
                        <li><?php esc_html_e('Go to the Settings', 'my-read-bar');?></li>
                        <li><?php esc_html_e('Choice Background and Foreground', 'my-read-bar');?></li>
                        <li><?php esc_html_e('Set Thickness and position', 'my-read-bar');?></li>
                        <li><?php esc_html_e('Select the template', 'my-read-bar');?></li>
                    </ol>
                </div>
                    <?php
                } else {
                    settings_fields('my-progress-bar'); 
                    do_settings_sections('my-progress-bar');
                    submit_button('Apply Changes');
                }
                ?>
            </form>
        
    </div><!-- /.wrap -->
        <?php     
    }

}
