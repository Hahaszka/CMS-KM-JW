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
    <?php else : ?>
        <div class="card-coffee-badge-header">
            <span class="coffee-origin-pill">Wpis z palarni</span>
        </div>
    <?php endif; ?>

    <div class="card-content">
        <header class="card-header">
            <div class="card-meta">
                <span class="card-date"><?php echo get_the_date( 'd.m.Y' ); ?></span>
                <span class="card-dot">&bull;</span>
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
                <a href="<?php the_permalink(); ?>" class="btn-read-more">
                    Czytaj notatkę
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </footer>
        <?php endif; ?>
    </div>
</article>
