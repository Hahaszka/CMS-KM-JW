<?php
/**
 * Template part for displaying posts
 *
 * @package Kawiarnia
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'kawiarnia-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="card-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium_large' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="card-content">
        <header class="card-header">
            <div class="card-meta">
                <span class="card-date"><?php echo get_the_date(); ?></span>
                <span class="card-author"><?php the_author(); ?></span>
            </div>
            <?php
            if ( is_singular() ) :
                the_title( '<h1 class="card-title">', '</h1>' );
            else :
                the_title( '<h2 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
            ?>
        </header>

        <div class="card-body">
            <?php
            if ( is_singular() ) :
                the_content();
            else :
                the_excerpt();
            endif;
            ?>
        </div>

        <?php if ( ! is_singular() ) : ?>
            <footer class="card-footer">
                <a href="<?php the_permalink(); ?>" class="btn-read-more">Czytaj dalej &rarr;</a>
            </footer>
        <?php endif; ?>
    </div>
</article>
