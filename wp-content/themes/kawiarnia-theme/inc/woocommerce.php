<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', function () {
    echo '<div class="container shop">';
}, 10 );

add_action( 'woocommerce_after_main_content', function () {
    echo '</div>';
}, 10 );