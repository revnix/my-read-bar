<?php
class Settings
{
    public function register()
    {

        add_action('admin_init', array($this, 'mpb_settings_init'));     
    
    }
    public function mpb_settings_init()
    {
        register_setting('my-progress-bar', 'mpb_background');
        register_setting('my-progress-bar', 'mpb_foreground');
        register_setting('my-progress-bar', 'mpb_thickness');
        register_setting('my-progress-bar', 'mpb_position');
        register_setting('my-progress-bar', 'mpb_home_page');
        register_setting('my-progress-bar', 'mpb_archive');
        register_setting('my-progress-bar', 'mpb_single_post');
        register_setting('my-progress-bar', 'mpb_single_page');

        add_settings_section(
            'mpb_color_section',
            'Color selection Section',
            [$this,'mpb_color_selection_section_cb'],
            'my-progress-bar'
        );

        add_settings_section(
            'mpb_position_section',
            'Position and offset Section',
            [$this,'mpb_position_offset_secction_cb'],
            'my-progress-bar'
        );

        add_settings_section(
            'mpb_template_section',
            'Template selection Section',
            array($this,'mpb_template_selection_section_cb'),
            'my-progress-bar'
        );

        // fields
        add_settings_field(
            'mpb_background_color_setting_field',
            __('Background', 'my-read-bar'),
            array($this,'my_setting_markup'),
            'my-progress-bar',
            'mpb_color_section'
        );
        add_settings_field(
            'mpb_foreground_color_setting_field',
            __('Foreground', 'my-read-bar'),
            array($this,'mpb_foreground_cb'),
            'my-progress-bar',
            'mpb_color_section'
        );

        add_settings_field(
            'mpb_thickness_setting_field',
            __('Thickness', 'my-read-bar'),
            array($this,'mpb_thickness_cb'),
            'my-progress-bar',
            'mpb_position_section'
        );
        add_settings_field(
            'mpb_position_setting_field',
            __('Position', 'my-read-bar'),
            array($this,'mpb_position_cb'),
            'my-progress-bar',
            'mpb_position_section'
        );

        //  template section

        add_settings_field(
            'mpb_template_setting_field',
            __('Select Template', 'my-read-bar'),
            array($this,'mpb_template_cb'),
            'my-progress-bar',
            'mpb_template_section'
        );

    

    }

    public function mpb_color_selection_section_cb()
    {
    
        echo "<p>Choice color of the Progress bar</p>";
    }

    // mpb_template_selection_section_cb

    public function mpb_template_selection_section_cb()
    {

        echo "<p>Choice template to show Progress bar</p>";
    }

    public function mpb_position_offset_secction_cb()
    {
        echo "<p>Choice Position and also set offset to  Progress bar</p>";
    }

    // field cb

    public function my_setting_markup()
    {
        $setting = get_option('mpb_background');
        ?>
    <label for="mpb_background"><?php esc_html_e('Background', 'my-read-bar'); ?></label>
    <input type="color" name="mpb_background" value="<?php echo esc_attr(get_option('mpb_background'));?>">
        <?php
    }

    public function mpb_foreground_cb()
    {
        $setting = get_option('mpb_foreground');
        ?>
    <label for="mpb_foreground"><?php esc_html_e('Foreground', 'my-read-bar'); ?></label>
    <input type="color" name="mpb_foreground" value="<?php echo esc_attr(get_option('mpb_foreground'));?>">
        <?php
    }
    public function mpb_thickness_cb()
    {
        $setting = get_option('mpb_thickness');
        ?>
    <label for="mpb_thickness"><?php esc_html_e('Select Color', 'my-read-bar'); ?></label>
    <input type="number" name="mpb_thickness" value="<?php echo esc_attr(get_option('mpb_thickness'));?>" class="small-text"><span><?php esc_html_e('px', 'my-read-bar'); ?></span>
        <?php
    }

    public function mpb_position_cb()
    {
        $setting = get_option('mpb_position');
        ?>
    <label for="mpb_position"><?php esc_html_e('Position', 'my-read-bar'); ?></label>
    <select name="mpb_position">
        <option value="top" <?php selected(esc_attr(get_option('mpb_position')), "top"); ?>><?php esc_html_e('Top', 'my-read-bar'); ?></option>
        <option value="bottom" <?php selected(esc_attr(get_option('mpb_position')), "bottom"); ?>><?php esc_html_e('Bottom', 'my-read-bar'); ?></option>
        </select>
        <?php
    }

    public function mpb_template_cb()
    {
    
        ?>
    
    <input type="checkbox" name="mpb_home_page" value="1" <?php checked(1, esc_attr(get_option('mpb_home_page')), true); ?>>
    <label for="mpb_home_page"><?php esc_html_e('Frontpage / Homepage ', 'my-read-bar'); ?></label>
    <br>
    <input type="checkbox" name="mpb_archive" value="1" <?php checked(1, esc_attr(get_option('mpb_archive')), true); ?>>
    <label for="mpb_archive"><?php esc_html_e('Archive', 'my-read-bar'); ?></label>
    <br>
    <input type="checkbox" name="mpb_single_post" value="1" <?php checked(1, esc_attr(get_option('mpb_single_post')), true); ?>>
    <label for="mpb_single_post"><?php esc_html_e('Single Post', 'my-read-bar'); ?></label>
    <br>
    <input type="checkbox" name="mpb_single_page" value="1" <?php checked(1, esc_attr(get_option('mpb_single_page')), true); ?>>
    <label for="mpb_single_post"><?php esc_html_e('Single Page', 'my-read-bar'); ?></label>
    <br>
        <?php    
    }

}
