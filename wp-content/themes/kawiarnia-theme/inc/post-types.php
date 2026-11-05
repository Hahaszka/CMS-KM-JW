<?php
/**
 * Custom Post Types registration
 *
 * @package Kawiarnia
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Rejestracja własnych typów treści (CPT) dla Kawiarni
 */
function kawiarnia_register_post_types() {
    // CPT: Opinie klientów
    register_post_type( 'opinia', array(
        'labels' => array(
            'name'                     => __( 'Opinie', 'kawiarnia' ),
            'singular_name'            => __( 'Opinia', 'kawiarnia' ),
            'add_new'                  => __( 'Dodaj nową', 'kawiarnia' ),
            'add_new_item'             => __( 'Dodaj nową opinię', 'kawiarnia' ),
            'edit_item'                => __( 'Edytuj opinię', 'kawiarnia' ),
            'new_item'                 => __( 'Nowa opinia', 'kawiarnia' ),
            'view_item'                => __( 'Zobacz opinię', 'kawiarnia' ),
            'view_items'               => __( 'Zobacz opinie', 'kawiarnia' ),
            'search_items'             => __( 'Szukaj opinii', 'kawiarnia' ),
            'not_found'                => __( 'Nie znaleziono opinii', 'kawiarnia' ),
            'not_found_in_trash'       => __( 'Brak opinii w koszu', 'kawiarnia' ),
            'all_items'                => __( 'Wszystkie opinie', 'kawiarnia' ),
            'menu_name'                => __( 'Opinie', 'kawiarnia' ),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'opinie', 'with_front' => false ),
        'menu_icon'           => 'dashicons-format-quote',
        'menu_position'       => 20,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'        => true,
    ) );

    // CPT: FAQ (Pytania i odpowiedzi)
    register_post_type( 'faq', array(
        'labels' => array(
            'name'                     => __( 'FAQ', 'kawiarnia' ),
            'singular_name'            => __( 'Pytanie FAQ', 'kawiarnia' ),
            'add_new'                  => __( 'Dodaj nowe', 'kawiarnia' ),
            'add_new_item'             => __( 'Dodaj pytanie do FAQ', 'kawiarnia' ),
            'edit_item'                => __( 'Edytuj pytanie', 'kawiarnia' ),
            'new_item'                 => __( 'Nowe pytanie', 'kawiarnia' ),
            'view_item'                => __( 'Zobacz pytanie', 'kawiarnia' ),
            'view_items'               => __( 'Zobacz FAQ', 'kawiarnia' ),
            'search_items'             => __( 'Szukaj w FAQ', 'kawiarnia' ),
            'not_found'                => __( 'Brak pytań w FAQ', 'kawiarnia' ),
            'not_found_in_trash'       => __( 'Brak pytań w koszu', 'kawiarnia' ),
            'all_items'                => __( 'Wszystkie pytania FAQ', 'kawiarnia' ),
            'menu_name'                => __( 'FAQ', 'kawiarnia' ),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array( 'slug' => 'faq', 'with_front' => false ),
        'menu_icon'           => 'dashicons-editor-help',
        'menu_position'       => 21,
        'supports'            => array( 'title', 'editor' ),
        'show_in_rest'        => true,
    ) );
}
add_action( 'init', 'kawiarnia_register_post_types' );
