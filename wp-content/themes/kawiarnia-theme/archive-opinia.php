<?php
/**
 * The template for displaying archive of Opinie CPT
 *
 * @package Kawiarnia
 */

get_header();
?>

<div class="site-container page-layout archive-opinia-container">
    <header class="archive-header text-center">
        <span class="section-eyebrow"><?php esc_html_e( 'Społeczność Palarni', 'kawiarnia' ); ?></span>
        <h1 class="page-title"><?php esc_html_e( 'Opinie i rekomendacje klientów', 'kawiarnia' ); ?></h1>
        <p class="archive-description"><?php esc_html_e( 'Zobacz, jak nasze świeżo palone ziarna specialty smakują w domach, kawiarniach i biurach w całej Polsce.', 'kawiarnia' ); ?></p>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="opinie-grid">
            <?php
            while ( have_posts() ) :
                the_post();

                $ocena       = (int) ( get_field( 'ocena', get_the_ID() ) ?: 5 );
                $miasto      = get_field( 'miasto', get_the_ID() );
                $profil_kawy = get_field( 'profil_kawy', get_the_ID() );
                ?>
                <article id="opinia-<?php the_ID(); ?>" <?php post_class( 'opinia-card' ); ?>>
                    <div class="opinia-rating" aria-label="<?php echo esc_attr( sprintf( __( 'Ocena: %d na 5', 'kawiarnia' ), $ocena ) ); ?>">
                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                            <svg class="star-svg <?php echo $i <= $ocena ? 'star-filled' : 'star-empty'; ?>" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        <?php endfor; ?>
                    </div>

                    <div class="opinia-body">
                        <blockquote class="opinia-quote">
                            „<?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>”
                        </blockquote>
                    </div>

                    <footer class="opinia-footer">
                        <div class="opinia-avatar">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'thumbnail', false, array( 'class' => 'avatar-img' ) ); ?>
                            <?php else : ?>
                                <span class="avatar-placeholder"><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="opinia-author-info">
                            <span class="opinia-author-name">
                                <a href="<?php echo esc_url( get_permalink() ); ?>">
                                    <?php echo esc_html( get_the_title() ); ?>
                                </a>
                            </span>
                            <div class="opinia-meta">
                                <?php if ( $miasto ) : ?>
                                    <span class="opinia-city"><?php echo esc_html( $miasto ); ?></span>
                                <?php endif; ?>
                                <?php if ( $miasto && $profil_kawy ) : ?>
                                    <span class="opinia-dot">•</span>
                                <?php endif; ?>
                                <?php if ( $profil_kawy ) : ?>
                                    <span class="opinia-coffee-tag"><?php echo esc_html( $profil_kawy ); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </footer>
                </article>
                <?php
            endwhile;
            ?>
        </div>

        <?php
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( '&larr; Poprzednia', 'kawiarnia' ),
            'next_text' => __( 'Następna &rarr;', 'kawiarnia' ),
        ) );
        ?>

    <?php else : ?>
        <p class="text-center"><?php esc_html_e( 'Brak opinii do wyświetlenia.', 'kawiarnia' ); ?></p>
    <?php endif; ?>
</div>

<?php
get_footer();

