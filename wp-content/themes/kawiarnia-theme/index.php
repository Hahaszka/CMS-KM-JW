<?php
/**
 * The main template file (fallback)
 *
 * @package Kawiarnia
 */

get_header();
?>

<div class="site-container page-layout">
    <div class="archive-header">
        <h1 class="page-title"><?php single_post_title(); ?></h1>
    </div>

    <div class="posts-grid">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', get_post_format() );
            endwhile;

            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '&larr; Poprzednia', 'kawiarnia' ),
                'next_text' => __( 'Następna &rarr;', 'kawiarnia' ),
            ) );
        else :
            ?>
            <p><?php esc_html_e( 'Brak wpisów do wyświetlenia.', 'kawiarnia' ); ?></p>
            <?php
        endif;
        ?>
    </div>
</div>

<?php
get_footer();
