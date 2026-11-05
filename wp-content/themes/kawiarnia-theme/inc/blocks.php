<?php
/**
 * ACF Block registration and Gutenberg filters
 *
 * @package Kawiarnia
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Automatyczna rejestracja bloków z katalogu blocks/
 * Wspiera natywnie ACF Pro oraz zapewnia fallback renderowania dla środowiska ACF Free.
 */
function kawiarnia_register_blocks() {
    $block_json_files = glob( get_theme_file_path( 'blocks/*/block.json' ) );
    if ( ! empty( $block_json_files ) ) {
        foreach ( $block_json_files as $file ) {
            $dir = dirname( $file );
            $render_file = $dir . '/render.php';
            $args = array();

            // Zapewnienie renderowania render.php zarówno w ACF Free, jak i ACF Pro
            if ( ! function_exists( 'acf_register_block_type' ) && file_exists( $render_file ) ) {
                $args['render_callback'] = function( $attributes, $content, $wp_block ) use ( $render_file ) {
                    ob_start();
                    $is_preview = is_admin();
                    $block = array(
                        'id'     => ! empty( $attributes['id'] ) ? $attributes['id'] : ( ! empty( $wp_block->parsed_block['id'] ) ? $wp_block->parsed_block['id'] : uniqid() ),
                        'name'   => ! empty( $wp_block->name ) ? $wp_block->name : '',
                        'anchor' => ! empty( $attributes['anchor'] ) ? $attributes['anchor'] : '',
                    );
                    include $render_file;
                    return ob_get_clean();
                };
            }

            register_block_type( $dir, $args );
        }
    }
}
add_action( 'init', 'kawiarnia_register_blocks' );

/**
 * Dedykowana kategoria bloków w edytorze Gutenberg
 */
function kawiarnia_block_categories( $categories, $post ) {
    return array_merge(
        array(
            array(
                'slug'  => 'kawiarnia',
                'title' => __( 'Kawiarnia Specialty', 'kawiarnia' ),
                'icon'  => 'coffee',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'kawiarnia_block_categories', 10, 2 );

/**
 * Ograniczenie listy dostępnych bloków w edytorze (wytyczna Lab 2)
 */
function kawiarnia_allowed_block_types( $allowed_blocks, $editor_context ) {
    return array(
        // Własne bloki ACF motywu
        'acf/hero',
        'acf/usp',
        'acf/opinie',
        'acf/faq',

        // Wybrane podstawowe bloki rdzenia WordPress
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/list-item',
        'core/image',
    );
}
add_filter( 'allowed_block_types_all', 'kawiarnia_allowed_block_types', 10, 2 );
