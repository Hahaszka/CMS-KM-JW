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

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

add_action( 'woocommerce_single_product_summary', function () {
    echo '<p class="shipping-note">' . esc_html__( 'Darmowa dostawa od 200 zł', 'kawiarnia' ) . '</p>';
}, 28 );

add_filter( 'woocommerce_product_tabs', function ( $tabs ) {
    global $product;

    if ( ! function_exists( 'get_field' ) || ! is_a( $product, 'WC_Product' ) ) {
        return $tabs;
    }

    $product_id = $product->get_id();
    $has_details = get_field( 'sklad', $product_id )
        || get_field( 'pochodzenie', $product_id )
        || get_field( 'stopien_palenia', $product_id );

    if ( $has_details ) {
        $tabs['sklad'] = array(
            'title'    => __( 'Skład i pochodzenie', 'kawiarnia' ),
            'priority' => 15,
            'callback' => 'kawiarnia_tab_sklad',
        );
    }

    return $tabs;
} );

function kawiarnia_tab_sklad() {
    global $product;

    if ( ! function_exists( 'get_field' ) || ! is_a( $product, 'WC_Product' ) ) {
        return;
    }

    $product_id = $product->get_id();
    $ingredients = get_field( 'sklad', $product_id );
    $origin = get_field( 'pochodzenie', $product_id );
    $roast_level = get_field( 'stopien_palenia', $product_id );

    echo '<h2>' . esc_html__( 'Skład i pochodzenie', 'kawiarnia' ) . '</h2>';

    if ( $ingredients ) {
        echo wp_kses_post( $ingredients );
    }

    if ( $origin ) {
        echo '<p><strong>' . esc_html__( 'Pochodzenie:', 'kawiarnia' ) . '</strong> ' . esc_html( $origin ) . '</p>';
    }

    if ( $roast_level ) {
        echo '<p><strong>' . esc_html__( 'Stopień palenia:', 'kawiarnia' ) . '</strong> ' . esc_html( $roast_level ) . '</p>';
    }
}

add_action( 'woocommerce_archive_description', function () {
    if ( ! is_product_category() || ! function_exists( 'get_field' ) ) {
        return;
    }

    $term = get_queried_object();
    $banner_id = get_field( 'baner', $term );

    if ( ! $banner_id ) {
        return;
    }

    echo '<div class="category-banner">';
    echo wp_get_attachment_image( absint( $banner_id ), 'full', false, array( 'class' => 'category-banner__image' ) );
    echo '</div>';
}, 20 );

add_action( 'woocommerce_before_shop_loop_item_title', function () {
    global $product;

    if ( ! is_a( $product, 'WC_Product' ) ) {
        return;
    }

    $created = $product->get_date_created();

    if ( $created && $created->getTimestamp() > strtotime( '-30 days' ) ) {
        echo '<span class="badge badge--new">' . esc_html__( 'Nowość', 'kawiarnia' ) . '</span>';
    }
}, 9 );