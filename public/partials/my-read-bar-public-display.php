<?php

class DisplayBar {
    
    // Properties
    private $frontPage;
    private $homePage;
    private $archivePage;
    private $singlePost;
    private $mpbBackground;
    private $mpbForeground;
    private $mpbHeight;
    private $position;

    public function __construct() {
        $this->frontPage = get_option('mpb_front_page');
        $this->homePage = get_option('mpb_home_page');
        $this->archivePage = get_option('mpb_archive');
        $this->singlePost = get_option('mpb_single_post');
        $this->mpbBackground = get_option('mpb_background');
        $this->mpbForeground = get_option('mpb_foreground');
        $this->mpbHeight = get_option('mpb_thickness');
        $this->position = get_option('mpb_position');
    }

    public function register() {

        add_action( 'wp_body_open', array($this,'mpb_public_html') );
        add_action('wp_head', array($this,'mpb_public_style'));
    
    }

    public function mpb_public_style() {
        ?>
        <style>
            progress {
                <?php 
                if($this->position === 'bottom') {
                ?>
                position: fixed;
                bottom: 0;
                <?php 
                }                    
                ?>
                background-color:<?php echo esc_html($this->mpbBackground); ?>;
                height:<?php echo esc_html( $this->mpbHeight.'px' ); ?>;
            }

            progress::-webkit-progress-bar {
                background-color:<?php echo esc_html($this->mpbBackground); ?>;
                height:<?php echo esc_html( $this->mpbHeight.'px'); ?>;
                
            }

            progress::-webkit-progress-value {
                background-color:<?php echo esc_html( $this->mpbForeground ); ?>;
                height:<?php echo esc_html($this->mpbHeight.'px'); ?>;
            }
            
            progress::-moz-progress-bar {
                background-color:<?php echo esc_html( $this->mpbForeground ); ?>;
                height:<?php echo esc_html($this->mpbHeight.'px'); ?>;
            }
        </style>
            
            <?php
    }
    
    public function mpb_public_html() {

        if(!empty($this->frontPage) && is_front_page()) {
                ?>
            <progress value='0'></progress>
                <?php
        }
        elseif (is_single() && !empty($this->singlePost) ) {
            ?>
        <progress value="0"></progress> 
        <?php  
        }
        elseif(is_home() && !empty($this->homePage)){
            ?>
            <progress value="0"></progress>
            <?php
        }
        elseif(is_archive() && !empty($this->archivePage)){
            ?>
            <progress value="0"></progress>
            <?php

        }
    }
}