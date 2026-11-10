<?php
/**
 * Block Name: Opinie Klientów (acf/opinie)
 *
 * @package Kawiarnia
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during backend preview render.
 * @var int $post_id The post ID the block is rendering on.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'opinie-' . $block['id'];

$eyebrow       = get_field( 'eyebrow' ) ?: 'Społeczność Kawowa';
$title         = get_field( 'title' ) ?: 'Co mówią o naszych wypałach?';
$description   = get_field( 'description' ) ?: 'Rzeczywiste oceny i wrażenia sensoryczne pasjonatów metod przelewowych oraz espresso.';
$count         = (int) ( get_field( 'count' ) ?: 3 );
$show_all_link = get_field( 'show_all_link' ) !== false;
$archive_url   = get_post_type_archive_link( 'opinia' ) ?: home_url( '/opinie/' );

$opinie_query = new WP_Query( array(
    'post_type'      => 'opinia',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section id="<?php echo esc_attr( $id ); ?>" class="opinie-section block-opinie">
    <div class="site-container">
        <div class="section-title text-center">
            <?php if ( $eyebrow ) : ?>
                <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>

            <?php if ( $title ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php elseif ( $is_preview ) : ?>
                <p><em><?php esc_html_e( 'Uzupełnij nagłówek sekcji opinii →', 'kawiarnia' ); ?></em></p>
            <?php endif; ?>

            <?php if ( $description ) : ?>
                <p><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( $opinie_query->have_posts() ) : ?>
            <div class="opinie-grid">
                <?php
                while ( $opinie_query->have_posts() ) :
                    $opinie_query->the_post();

                    $ocena        = (int) ( get_field( 'ocena', get_the_ID() ) ?: 5 );
                    $miasto       = get_field( 'miasto', get_the_ID() );
                    $profil_kawy  = get_field( 'profil_kawy', get_the_ID() );
                    ?>
                    <article class="opinia-card">
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
                wp_reset_postdata();
                ?>
            </div>

            <?php if ( $show_all_link && $archive_url ) : ?>
                <div class="opinie-actions text-center">
                    <a href="<?php echo esc_url( $archive_url ); ?>" class="btn btn-secondary">
                        <span><?php esc_html_e( 'Wszystkie opinie i recenzje', 'kawiarnia' ); ?></span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <p class="text-center"><?php esc_html_e( 'Brak opinii do wyświetlenia. Dodaj pierwsze opinie w panelu WordPressa.', 'kawiarnia' ); ?></p>
        <?php endif; ?>
    </div>
</section>

