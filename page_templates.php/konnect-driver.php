<?php
/*
 * Template Name: Konnect Driver
 * description: Konnect Template Driver
 */
get_header(); ?>
<style>#top-nav{margin-bottom:0;}.heading-scooters{text-align:center;} #site-header-main{ top:0 !important;} .site-header-bottom { background: #1e3231;} .page-content{margin-top:3rem; padding: 5%;} #header-image-main-inside{display:none !important;}</style>
<div class="page-content">
        <div class="heading-scooters">
        <h2 class="sc_item_title sc_title_title sc_align_left sc_item_title_style_extra"><span class="sc_item_title_text">Want to hire a driver?</span></h2>
        <div class="sc_icons_item_details">
        <h4 class="sc_icons_item_title">Easy Booking Process</h4>
        <div class="sc_icons_item_description">Pick a car model annd fill in the booking request form below.</div>
        </div>
        </div>
      <div class="section-row drivers-row">
        <?php echo do_shortcode( '[custom_drivers_shortcode]' ); ?>
        <?php
        $driver = $_GET['driver'];
            
        if($driver != ''){
            echo do_shortcode( '[custom_cars_custom_shortcode]' ); 
        }

        $booking = $_GET['book'];
        if($booking != ''){
              echo '<style>
                @media (max-width: 480px) {
                     .row_block{display:none;}
                }
                </style>';
            echo do_shortcode( '[custom_form_shortcode]' ); 
        }
        ?>
        </div>  
</div><!-- #primary -->

<?php get_footer(); ?>