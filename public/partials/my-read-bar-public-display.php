<?php

class DisplayBar
{
    public function __construct() {    
        $this->homePage = (!empty(get_option('mpb_home_page'))) ? get_option('mpb_home_page') : 0; 
        $this->archivePage = (!empty(get_option('mpb_archive'))) ? get_option('mpb_archive') : 0;
        $this->singlePost = (!empty(get_option('mpb_single_post'))) ? get_option('mpb_single_post') : 1; 
        $this->singlePage = (!empty(get_option('mpb_single_page'))) ? get_option('mpb_single_page') : 0; 
        $this->mpbBackground = (!empty(get_option('mpb_background'))) ? get_option('mpb_background') : "#e6e6e6";
        $this->mpbForeground = (!empty(get_option('mpb_foreground'))) ? get_option('mpb_foreground') : "#e3dc29";
        $this->mpbHeight = (!empty(get_option('mpb_height'))) ? get_option('mpb_height') : 10;
        $this->placement = (!empty(get_option('mpb_placement'))) ? get_option('mpb_placement') : "top";
        $this->bgtransparent = (!empty(get_option('mpb_bg_transparent'))) ? get_option('mpb_bg_transparent') : 0; 
        $this->stylesbar = (!empty(get_option('mpb_styles'))) ? get_option('mpb_styles') : 1; 
        $this->shadow = (!empty(get_option('mpb_shadow'))) ? get_option('mpb_shadow') : 1;
        
    }

    public function register() {
        add_action('wp_body_open', array($this,'mpb_public_html'));
        add_action('wp_head', array($this,'mpb_public_style'));    
    }

    public function mpb_public_style() {        ?>
        <style>

            progress.my_progressbar {
                width: 100%;
                <?php 
                if($this->placement === 'bottom') {
                    ?>
                position: fixed;
                bottom: 0;
                <?php 
                }                    
                ?>
                <?php 
                    $hex = $this->mpbBackground;
                    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x"); 
                    $opacity =    $this->bgtransparent/100;               
                ?>
                background-color:rgba(<?php echo esc_html($r . ',' .  $g . ',' .  $b . ',' .  $opacity); ?>);
                height:<?php echo esc_html($this->mpbHeight.'px'); ?>;
            }

            progress.my_progressbar::-webkit-progress-bar {                
                background-color:rgba(<?php echo esc_html($r . ',' .  $g . ',' .  $b . ',' .  $opacity); ?>);                
                height:<?php echo esc_html($this->mpbHeight.'px'); ?>;                
            }

            progress.my_progressbar::-webkit-progress-value {                
                background-color:<?php echo esc_html($this->mpbForeground); ?>;                
                height:<?php echo esc_html($this->mpbHeight.'px'); ?>;
                <?php if(empty($this->shadow)) { ?>
                    box-shadow: none;
                <?php } else { ?>                    
                    box-shadow: 0px 0px 10px 0px <?php echo esc_html($this->mpbForeground); ?>bf;
                <?php } ?>
                <?php if(empty($this->stylesbar)) { ?>
                    border-radius: 0;
                <?php } else { ?>
                    border-radius: 50px;
                <?php } ?>            
            }
            
            progress.my_progressbar::-moz-progress-bar {                
                background-color:<?php echo esc_html($this->mpbForeground); ?>;                
                height:<?php echo esc_html($this->mpbHeight.'px'); ?>;
                <?php if(empty($this->shadow)) { ?>
                    box-shadow: none;
                <?php } else { ?>                    
                        box-shadow: 0px 0px 10px 0px <?php echo esc_html($this->mpbForeground); ?>bf;
                <?php } ?>
            }
            <?php 
                $total_height = $this->mpbHeight / 1.5;                
            ?>

            progress.my_progressbar.left_progressbar, progress.my_progressbar.right_progressbar {
                -webkit-appearance: none;
                appearance: none;
                position: fixed;
                top: 0;
                left: 0;
                transform: translate(calc(-50% + <?php echo esc_html($total_height .'px'); ?>), calc(50vh - 50%)) rotate(90deg);
                width: 100vh;
            }
            progress.my_progressbar.right_progressbar {
                transform: translate(calc(50% + -<?php echo esc_html($total_height .'px'); ?>), calc(50vh - 50%)) rotate(90deg);
                left: inherit;
                right: 0 !important;
            }
        </style>            
        <?php
    }
    
    public function mpb_public_html() {
        if( is_home() && !empty($this->homePage) ) {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
        elseif (is_single() && !empty($this->singlePost) ) {
            ?>
            <progress value='0' class="my_progressbar" ></progress>
            <?php  
        }
        elseif(is_page() && !empty($this->singlePage)) {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
        elseif(is_archive() && !empty($this->archivePage)) {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
    }
}