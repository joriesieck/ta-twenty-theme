<?php

// This file adds the Landing template from Epik to the TA-Twenty Theme.

// Template Name: Epik Landing

// Add custom body class to the head
add_filter( 'body_class', 'epik_add_body_class' );
function epik_add_body_class( $classes ) {
   $classes[] = 'epik-landing';
   return $classes;
}

// Remove header, navigation, breadcrumbs, footer widgets, footer
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

genesis();
