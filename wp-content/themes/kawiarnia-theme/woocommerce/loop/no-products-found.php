<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$categories = get_terms(
    array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'number'     => 1,
    )
);
$category = ! is_wp_error( $categories ) && ! empty( $categories ) ? $categories[0] : null;
$category_url = $category ? get_term_link( $category ) : wc_get_page_permalink( 'shop' );

if ( is_wp_error( $category_url ) || ! $category_url ) {
    $category = null;
    $category_url = wc_get_page_permalink( 'shop' );
}

$link_text = $category
    ? sprintf( __( 'Zobacz kategorię: %s', 'kawiarnia' ), $category->name )
    : __( 'Wróć do sklepu', 'kawiarnia' );
?>
<p class="woocommerce-info" role="status">
    <?php esc_html_e( 'Nie znaleźliśmy produktów spełniających te kryteria.', 'kawiarnia' ); ?>
    <a href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $link_text ); ?></a>
</p>
