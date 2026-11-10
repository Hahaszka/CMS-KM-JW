<?php
/**
 * Block Name: Hero Palarni (acf/hero)
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

$id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'hero-' . $block['id'];

// Pobieranie wartości przez get_field() — nigdy the_field()
$badge        = get_field( 'badge' ) ?: 'Rzemieślnicza Palarnia Kawy';
$title        = get_field( 'title' ) ?: 'Ziarna z plantacji, które znamy z imienia';
$text         = get_field( 'text' ) ?: 'Wypalamy kawy jednorodne (Single Origin) i limitowane mikroloty z Etiopii, Kolumbii, Kenii oraz Panamy. Z zachowaniem pełnego profilu sensorycznego odmiany i terroir.';
$image_id     = get_field( 'image' ); // ID załącznika
$button       = get_field( 'button' ); // tablica: url, title, target
$sec_btn_text = get_field( 'secondary_button_title' ) ?: 'Dziennik palarni';
$sec_btn_url  = get_field( 'secondary_button_url' ) ?: '#latest-posts';
$show_specs   = get_field( 'show_specs' ) !== false;

$spec_1_val   = get_field( 'spec_1_val' ) ?: '86-91';
$spec_1_label = get_field( 'spec_1_label' ) ?: 'SCA Cupping Score';
$spec_2_val   = get_field( 'spec_2_val' ) ?: '100%';
$spec_2_label = get_field( 'spec_2_label' ) ?: 'Transparent Trade';
$spec_3_val   = get_field( 'spec_3_val' ) ?: 'Omni';
$spec_3_label = get_field( 'spec_3_label' ) ?: 'Profil pod filtr i espresso';
?>

<section id="<?php echo esc_attr( $id ); ?>" class="hero-section block-hero">
    <canvas id="coffee-hero-canvas" class="hero-canvas" aria-hidden="true"></canvas>

    <div class="site-container hero-inner">
        <?php if ( $badge ) : ?>
            <div class="hero-label"><?php echo esc_html( $badge ); ?></div>
        <?php endif; ?>

        <?php if ( $title ) : ?>
            <h1 class="hero-title"><?php echo esc_html( $title ); ?></h1>
        <?php elseif ( $is_preview ) : ?>
            <p><em><?php esc_html_e( 'Uzupełnij tytuł banera w panelu bocznym bloku →', 'kawiarnia' ); ?></em></p>
        <?php endif; ?>

        <?php if ( $text ) : ?>
            <p class="hero-description"><?php echo esc_html( $text ); ?></p>
        <?php endif; ?>

        <?php if ( ! empty( $image_id ) ) : ?>
            <div class="hero-featured-image">
                <?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'hero-img' ) ); ?>
            </div>
        <?php endif; ?>

        <div class="hero-actions">
            <?php if ( ! empty( $button ) && ! empty( $button['url'] ) ) : ?>
                <a href="<?php echo esc_url( $button['url'] ); ?>" 
                   class="btn btn-primary"
                   target="<?php echo esc_attr( ! empty( $button['target'] ) ? $button['target'] : '_self' ); ?>">
                    <?php echo esc_html( ! empty( $button['title'] ) ? $button['title'] : __( 'Nasza Oferta', 'kawiarnia' ) ); ?>
                </a>
            <?php else : ?>
                <a href="#features" class="btn btn-primary"><?php esc_html_e( 'Zobacz profile ziaren', 'kawiarnia' ); ?></a>
            <?php endif; ?>

            <?php if ( $sec_btn_text && $sec_btn_url ) : ?>
                <a href="<?php echo esc_url( $sec_btn_url ); ?>" class="btn btn-secondary">
                    <?php echo esc_html( $sec_btn_text ); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ( $show_specs ) : ?>
            <div class="hero-specs">
                <div class="spec-item">
                    <span class="spec-num"><?php echo esc_html( $spec_1_val ); ?></span>
                    <span class="spec-label"><?php echo esc_html( $spec_1_label ); ?></span>
                </div>
                <div class="spec-item">
                    <span class="spec-num"><?php echo esc_html( $spec_2_val ); ?></span>
                    <span class="spec-label"><?php echo esc_html( $spec_2_label ); ?></span>
                </div>
                <div class="spec-item">
                    <span class="spec-num"><?php echo esc_html( $spec_3_val ); ?></span>
                    <span class="spec-label"><?php echo esc_html( $spec_3_label ); ?></span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

