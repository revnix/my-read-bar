<?php
class Settings
{
    public function register() {
        add_action('admin_init', array($this, 'mpb_settings_init'));         
    }

    public function mpb_settings_init() {
        register_setting('my-progress-bar', 'mpb_background');
        register_setting('my-progress-bar', 'mpb_foreground');
        register_setting('my-progress-bar', 'mpb_height');
        register_setting('my-progress-bar', 'mpb_placement');
        register_setting('my-progress-bar', 'mpb_home_page');
        register_setting('my-progress-bar', 'mpb_archive');
        register_setting('my-progress-bar', 'mpb_single_post');
        register_setting('my-progress-bar', 'mpb_single_page');
        register_setting('my-progress-bar', 'mpb_bg_transparent');
        register_setting('my-progress-bar', 'mpb_styles');
        register_setting('my-progress-bar', 'mpb_shadow');
        

        add_settings_section(
            'mpb_main_section',
            '',
            [$this,'mpb_color_selection_section_cb'],
            'my-progress-bar'
        );         

        

        add_settings_field(
            'mpb_background_color_setting_field',
            __('Background', 'my-read-bar'),
            array($this,'my_setting_markup'),
            'my-progress-bar',
            'mpb_main_section',
            array(
                'label_for'         => 'bg_color',
                'class'             => 'show_field custom_style_fields',
                'wporg_custom_data' => 'custom',
            )
        );

        add_settings_field(
            'mpb_foreground_color_setting_field',
            __('Foreground', 'my-read-bar'),
            array($this,'mpb_foreground_cb'),
            'my-progress-bar',
            'mpb_main_section',
            array(
                'label_for'         => 'foreground_color',
                'class'             => 'show_field custom_style_fields',
                'wporg_custom_data' => 'custom',
            )
        );

        add_settings_field(
            'mpb_bg_transparent_color_setting_field',
            __('Background Opacity', 'my-read-bar'),
            array($this,'mpb_bg_transparent_cb'),
            'my-progress-bar',
            'mpb_main_section',
            array(
                'label_for'         => 'bg_transparent',
                'class'             => 'show_field custom_style_fields',
                'wporg_custom_data' => 'custom',
            )
        );        

        add_settings_field(
            'mpb_shadow_setting_field',
            __('Shadow', 'my-read-bar'),
            array($this,'mpb_shadow_cb'),
            'my-progress-bar',
            'mpb_main_section'
        ); 

        add_settings_field(
            'mpb_styles_setting_field',
            __('Rounded', 'my-read-bar'),
            array($this,'mpb_styles_cb'),
            'my-progress-bar',
            'mpb_main_section'
        );
        
        add_settings_field(
            'mpb_placement_setting_field',
            __('Placement ', 'my-read-bar'),
            array($this,'mpb_placement_cb'),
            'my-progress-bar',
            'mpb_main_section'
        );

        add_settings_field(
            'mpb_height_setting_field',
            __('Height', 'my-read-bar'),
            array($this,'mpb_height_cb'),
            'my-progress-bar',
            'mpb_main_section'
        );

        add_settings_field(
            'mpb_template_setting_field',
            __('Display on', 'my-read-bar'),
            array($this,'mpb_template_cb'),
            'my-progress-bar',
            'mpb_main_section'
        );   

    }

    public function mpb_color_selection_section_cb() {
        echo "";
    }

    public function my_setting_markup() {
        $setting = get_option('mpb_background'); 
        ?>        
        <div class="color_field-wrapper color_background"> 
            <div class="color-picker-bg"></div>
            <div class="color_box" style="background-color: <?php echo esc_attr(get_option('mpb_background'));?>;"></div>        
            <input type="text" name="mpb_background" value="<?php echo esc_attr(get_option('mpb_background'));?>">
        </div>
        <?php
    }

    public function mpb_foreground_cb() {
        $setting = get_option('mpb_foreground'); 
        ?>
        <div class="color_field-wrapper color_foreground">
            <div class="color-picker-fg"></div>
            <div class="color_box" style="background-color: <?php echo esc_attr(get_option('mpb_foreground'));?>;"></div>
            <input type="text" name="mpb_foreground" value="<?php echo esc_attr(get_option('mpb_foreground'));?>">
        </div>
        <?php
    }

    public function mpb_bg_transparent_cb() {
        $setting = get_option('mpb_bg_transparent');
        ?>
        <div class="range_slider-wrapper slider_bg-transparent">
            <input type="range" min="0" max="100" step="1" name="mpb_bg_transparent" value="<?php echo esc_attr(get_option('mpb_bg_transparent'));?>" data-rangeslider>
            <input class="output_value" disabled />
        </div>
        <?php
    }

    public function mpb_shadow_cb() {
        $setting = get_option('mpb_shadow');
        ?>
        <div class="switch_wrapper">
            <input type="checkbox" id="mpb_shadow" name="mpb_shadow" value="1" <?php checked(1, esc_attr(get_option('mpb_shadow')), true); ?>>
            <label class="switch" for="mpb_shadow"></label>        
        </div>    
        <?php
    }

 

    public function mpb_height_cb() {
        $setting = get_option('mpb_height');     
        ?>
        <div class="range_slider-wrapper slider_height">
            <input type="range" min="10" max="20" step="1" name="mpb_height" value="<?php echo esc_attr(get_option('mpb_height'));?>" data-rangeslider>
            <input class="output_value" disabled />
        </div>
        <?php
    }

    public function mpb_placement_cb() {
        $setting = get_option('mpb_placement');
        ?>
        <div class="placement_wrapper">
            <input type="radio" id="top" class="placement_option" name="mpb_placement" value="top" <?php checked('top', esc_attr(get_option('mpb_placement')), true); ?>>
            <input type="radio" id="right" class="placement_option" name="mpb_placement" value="right" <?php checked('right', esc_attr(get_option('mpb_placement')), true); ?>>
            <input type="radio" id="bottom" class="placement_option" name="mpb_placement" value="bottom" <?php checked('bottom', esc_attr(get_option('mpb_placement')), true); ?>>
            <input type="radio" id="left" class="placement_option" name="mpb_placement" value="left" <?php checked('left', esc_attr(get_option('mpb_placement')), true); ?>>
            <label for="top" class="placement_label top_align">
                <span></span>
            </label>
            <label for="right" class="placement_label right_align">
                <span></span>
            </label>
            <label for="bottom" class="placement_label bottom_align">
                <span></span>
            </label>
            <label for="left" class="placement_label left_align">
                <span></span>
            </label>
        </div>
        <?php
    }
    
    public function mpb_styles_cb() {
        $setting = get_option('mpb_styles');
        ?>
        <div class="switch_wrapper display_on">
            <input type="checkbox" id="mpb_styles" name="mpb_styles" value="1" <?php checked(1, esc_attr(get_option('mpb_styles')), true); ?>>
            <label class="switch" for="mpb_styles"></label>                    
        </div>        
        <?php
    } 

    public function mpb_template_cb() {    
        ?>    
        <div class="switch_wrapper display_on">
            <input type="checkbox" id="mpb_home_page" name="mpb_home_page" value="1" <?php checked(1, esc_attr(get_option('mpb_home_page')), true); ?>>
            <label class="switch" for="mpb_home_page"></label>        
            <div class="switch_label">            
                <span><?php esc_html_e('Front-page/Home Page ', 'my-read-bar'); ?></span>
            </div>
        </div>

        <div class="switch_wrapper display_on">
            <input type="checkbox" id="mpb_single_post" name="mpb_single_post" value="1" <?php checked(1, esc_attr(get_option('mpb_single_post')), true); ?>>
            <label class="switch" for="mpb_single_post"></label>
            <div class="switch_label">                    
                <span><?php esc_html_e('Single Post', 'my-read-bar'); ?></span>
            </div>
        </div>

        <div class="switch_wrapper display_on">
            <input type="checkbox" id="mpb_single_page" name="mpb_single_page" value="1" <?php checked(1, esc_attr(get_option('mpb_single_page')), true); ?>>
            <label class="switch" for="mpb_single_page"><span></label>        
            <div class="switch_label">            
                <?php esc_html_e('Single Page', 'my-read-bar'); ?></span>
            </div>
        </div> 

        <div class="switch_wrapper display_on">
            <input type="checkbox" id="mpb_archive" name="mpb_archive" value="1" <?php checked(1, esc_attr(get_option('mpb_archive')), true); ?>>
            <label class="switch" for="mpb_archive"></label>        
            <div class="switch_label">            
                <span><?php esc_html_e('Archives & Categories', 'my-read-bar'); ?></span>
            </div>
        </div>      
        <?php    
    }
}