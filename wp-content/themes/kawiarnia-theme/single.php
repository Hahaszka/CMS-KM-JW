<?php
/**
 * The template for displaying all single posts
 *
 * @package Kawiarnia
 */

get_header();
?>

<div class="site-container single-layout">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
            <header class="entry-header">
                <div class="post-meta-top">
                    <span class="post-category"><?php the_category( ', ' ); ?></span>
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                    <span class="post-author">Autor: <?php the_author(); ?></span>
                </div>
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Strony:', 'kawiarnia' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div>

            <footer class="entry-footer">
                <?php
                $tags_list = get_the_tag_list( '', ', ' );
                if ( $tags_list ) :
                    echo '<div class="tags-links">Tagi: ' . $tags_list . '</div>';
                endif;
                ?>
            </footer>

            <nav class="post-navigation">
                <div class="nav-previous"><?php previous_post_link( '&larr; %link' ); ?></div>
                <div class="nav-next"><?php next_post_link( '%link &rarr;' ); ?></div>
            </nav>

            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
        </article>
        <?php
    endwhile;
    ?>
</div>

<?php
get_footer();
