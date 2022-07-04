<?php

class DisplayBar
{
    
    // Properties
    private $homePage;
    private $archivePage;
    private $singlePost;
    private $mpbBackground;
    private $mpbForeground;
    private $mpbHeight;
    private $placement;
    private $bgtransparent;
    private $stylesbar;
    private $shadow;    
    

    public function __construct() {    
        $this->homePage = get_option('mpb_home_page');
        $this->archivePage = get_option('mpb_archive');
        $this->singlePost = get_option('mpb_single_post');
        $this->singlePage = get_option('mpb_single_page');
        $this->mpbBackground = get_option('mpb_background');
        $this->mpbForeground = get_option('mpb_foreground');
        $this->mpbHeight = get_option('mpb_height');
        $this->placement = get_option('mpb_placement');
        $this->bgtransparent = get_option('mpb_bg_transparent');
        $this->stylesbar = get_option('mpb_styles');
        $this->shadow = get_option('mpb_shadow');
        
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
                    box-shadow: 0px 0px 10px 0px <?php echo $this->mpbForeground; ?>bf;
                <?php } ?>
                <?php if(empty($this->stylesbar)) { ?>
                    border-radius: none;
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
                        box-shadow: 0px 0px 10px 0px <?php echo $this->mpbForeground; ?>bf;
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
            <progress value='0' class="<?php if($this->stylesbar) { echo $this->stylesbar; } ?> <?php if($this->placement === 'left') { echo 'left_progressbar'; } ?> <?php if($this->placement === 'right') { echo 'right_progressbar'; } ?> my_progressbar"></progress>
            <?php
        }
        elseif (is_single() && !empty($this->singlePost) ) {
            ?>
            <progress value='0' class="<?php if($this->stylesbar) { echo $this->stylesbar; } ?> my_progressbar <?php if($this->placement === 'left') { echo 'left_progressbar'; } ?> <?php if($this->placement === 'right') { echo 'right_progressbar'; } ?>" ></progress>
            <?php  
        }
        elseif(is_page() && !empty($this->singlePage)) {
            ?>
            <progress value='0' class="<?php if($this->stylesbar) { echo $this->stylesbar; } ?> my_progressbar <?php if($this->placement === 'left') { echo 'left_progressbar'; } ?> <?php if($this->placement === 'right') { echo 'right_progressbar'; } ?>"></progress>
            <?php
        }
        elseif(is_archive() && !empty($this->archivePage)) {
            ?>
            <progress value='0' class="<?php if($this->stylesbar) { echo $this->stylesbar; } ?> my_progressbar <?php if($this->placement === 'left') { echo 'left_progressbar'; } ?> <?php if($this->placement === 'right') { echo 'right_progressbar'; } ?>"></progress>
            <?php
        }
    }
}