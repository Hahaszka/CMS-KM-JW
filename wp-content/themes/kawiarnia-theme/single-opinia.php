<?php
/**
 * The template for displaying a single Opinia CPT
 *
 * @package Kawiarnia
 */

get_header();
?>

<div class="site-container page-layout single-opinia-container">
    <?php
    while ( have_posts() ) :
        the_post();

        $ocena       = (int) ( get_field( 'ocena', get_the_ID() ) ?: 5 );
        $miasto      = get_field( 'miasto', get_the_ID() );
        $profil_kawy = get_field( 'profil_kawy', get_the_ID() );
        ?>
        <article id="opinia-<?php the_ID(); ?>" <?php post_class( 'single-opinia-article' ); ?>>
            <div class="opinia-single-badge">
                <span class="coffee-origin-pill"><?php esc_html_e( 'Zweryfikowana opinia klienta', 'kawiarnia' ); ?></span>
            </div>

            <div class="opinia-rating-large" aria-label="<?php echo esc_attr( sprintf( __( 'Ocena: %d na 5', 'kawiarnia' ), $ocena ) ); ?>">
                <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                    <svg class="star-svg <?php echo $i <= $ocena ? 'star-filled' : 'star-empty'; ?>" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                <?php endfor; ?>
                <span class="rating-number"><?php echo esc_html( $ocena ); ?>/5</span>
            </div>

            <div class="opinia-single-content">
                <blockquote class="opinia-full-quote">
                    „<?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>”
                </blockquote>
            </div>

            <div class="opinia-single-author-box">
                <div class="opinia-avatar">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'thumbnail', false, array( 'class' => 'avatar-img' ) ); ?>
                    <?php else : ?>
                        <span class="avatar-placeholder"><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="opinia-author-details">
                    <h1 class="opinia-author-heading"><?php echo esc_html( get_the_title() ); ?></h1>
                    <div class="opinia-meta">
                        <?php if ( $miasto ) : ?>
                            <span class="opinia-city"><?php esc_html_e( 'Miejscowość:', 'kawiarnia' ); ?> <?php echo esc_html( $miasto ); ?></span>
                        <?php endif; ?>
                        <?php if ( $miasto && $profil_kawy ) : ?>
                            <span class="opinia-dot">•</span>
                        <?php endif; ?>
                        <?php if ( $profil_kawy ) : ?>
                            <span class="opinia-coffee-tag"><?php esc_html_e( 'Kawa:', 'kawiarnia' ); ?> <?php echo esc_html( $profil_kawy ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="opinia-back-action">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'opinia' ) ?: home_url( '/opinie/' ) ); ?>" class="btn btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span><?php esc_html_e( 'Powrót do wszystkich opinii', 'kawiarnia' ); ?></span>
                </a>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</div>

<?php
get_footer();

