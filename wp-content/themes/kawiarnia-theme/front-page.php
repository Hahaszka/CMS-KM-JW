<?php
/**
 * The template for displaying the front page
 *
 * Strona główna renderuje treść złożoną wyłącznie z autorskich bloków ACF:
 * - acf/hero
 * - acf/usp
 * - acf/opinie
 * - acf/faq
 *
 * @package Kawiarnia
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
    ?>
    <div class="site-container page-layout">
        <p class="text-center"><?php esc_html_e( 'Uzupełnij stronę główną blokami ACF w panelu WordPress.', 'kawiarnia' ); ?></p>
    </div>
    <?php
endif;

get_footer();
