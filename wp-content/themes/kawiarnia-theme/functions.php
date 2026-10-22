<?php
/**
 * Functions and definitions for Kawiarnia Theme
 *
 * @package Kawiarnia
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function kawiarnia_setup() {
    // Wsparcie dla tagu <title> w sekcji head
    add_theme_support( 'title-tag' );

    // Wsparcie dla miniaturek wpisów
    add_theme_support( 'post-thumbnails' );

    // Wsparcie dla własnego logo
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Wsparcie dla znaczników HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Rejestracja menu nawigacyjnych
    register_nav_menus( array(
        'primary' => __( 'Menu główne', 'kawiarnia' ),
        'footer'  => __( 'Menu stopki', 'kawiarnia' ),
    ) );
}
add_action( 'after_setup_theme', 'kawiarnia_setup' );

/**
 * Rejestracja i kolejkowanie skryptów oraz stylów
 */
function kawiarnia_scripts() {
    // Styl główny z style.css
    wp_enqueue_style( 'kawiarnia-style', get_stylesheet_uri(), array(), '0.1.0' );

    // Dedykowany arkusz styli layoutu
    wp_enqueue_style(
        'kawiarnia-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'kawiarnia-style' ),
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );

    // Czcionki Google Fonts (Plus Jakarta Sans + Playfair Display)
    wp_enqueue_style(
        'kawiarnia-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Biblioteka Anime.js do płynnych mikro-animacji
    wp_enqueue_script(
        'animejs',
        'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js',
        array(),
        '3.2.1',
        true
    );

    // Główny skrypt JS z zależnością do Anime.js
    wp_enqueue_script(
        'kawiarnia-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'animejs' ),
        filemtime( get_template_directory() . '/assets/js/main.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'kawiarnia_scripts' );
