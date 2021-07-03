<?php
/*
 * Template Name: Konnect Transfer
 * description: Konnect Template Transfer
 */

get_header(); ?>
<style>#top-nav{margin-bottom:0;}.hiddenbooking{display:block !important;}.returngroup, .hideonbooking{display:none;}.heading-scooters{text-align:center;} #site-header-main{ top:0 !important;} .site-header-bottom { background: #1e3231;} .page-content{margin-top:3rem; padding: 5%;}#header-image-main-inside{display:none !important;}.sc_item_title{margin-top:2rem;}</style>
<div class="page-content">
        <div class="heading-scooters">
        <h2 class="sc_item_title sc_title_title sc_align_left sc_item_title_style_extra"><span class="sc_item_title_text">Book a transfer</span></h2>
        <div class="sc_icons_item_details">
        <h4 class="sc_icons_item_title">Easy Booking Process</h4>
        <div class="sc_icons_item_description">Fill in your details and request a booking.</div>
        </div>
        </div>
      <div class="section-row">
        <?php 
            echo do_shortcode( '[custom_form_shortcode]' ); 
        ?>
        </div>  
</div><!-- #primary -->
<?php get_footer(); ?>




