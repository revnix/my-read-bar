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
            __('Progress Bar Settings', 'my-read-bar'),
            'Progress Bar Settingsr',
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
        
            <form method="post" action="options.php">
                <input type="hidden"> 
                <?php
                    settings_fields('my-progress-bar'); 
                    do_settings_sections('my-progress-bar');
                    submit_button('Save Changes');
                
                ?>
            </form>
        
    </div><!-- /.wrap -->
        <?php     
    }

}
