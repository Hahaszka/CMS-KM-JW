<?php
/**
 * Block Name: Filary Jakości / USP (acf/usp)
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

$id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'features';

$eyebrow     = get_field( 'eyebrow' ) ?: 'Filozofia Rzemiosła';
$title       = get_field( 'title' ) ?: 'Od krzewu po filiżankę';
$description = get_field( 'description' ) ?: 'Trzy filary, które definiują jakość w segmencie Third Wave Coffee';

$item_1_title = get_field( 'item_1_title' ) ?: 'Pochodzenie & Terroir';
$item_1_text  = get_field( 'item_1_text' ) ?: 'Wyłącznie świeże zbiory z bezpośredniego importu. Podajemy wysokość upraw (m n.p.m.), odmianę botaniczną (Bourbon, Geisha, SL28) oraz precyzyjną metodę obróbki.';

$item_2_title = get_field( 'item_2_title' ) ?: 'Profilowane Palenie';
$item_2_text  = get_field( 'item_2_text' ) ?: 'Piecyk bębnowy i rygorystyczna krzywa RoR (Rate of Rise). Jasne palenie podkreśla naturalną kwasowość, nuty kwiatowe i owocowe zamiast goryczy spalenizny.';

$item_3_title = get_field( 'item_3_title' ) ?: 'Metody Alternatywne';
$item_3_text  = get_field( 'item_3_text' ) ?: 'Kompletne wyposażenie domowego baristy: drippery Hario V60, Chemex, Aeropress, filtry papierowe oraz żarnowe młynki manualne i elektryczne.';
?>

<section id="<?php echo esc_attr( $id ); ?>" class="features-section block-usp">
    <div class="site-container">
        <div class="section-title text-center">
            <?php if ( $eyebrow ) : ?>
                <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>

            <?php if ( $title ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php elseif ( $is_preview ) : ?>
                <p><em><?php esc_html_e( 'Wpisz nagłówek sekcji USP →', 'kawiarnia' ); ?></em></p>
            <?php endif; ?>

            <?php if ( $description ) : ?>
                <p><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>

        <div class="features-grid">
            <!-- Filar 1 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg class="feature-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                        <path d="M12 6c-3 3-4 6-4 9"/>
                        <path d="M12 6c3 3 4 6 4 9"/>
                        <line x1="2" y1="12" x2="22" y2="12"/>
                    </svg>
                </div>
                <h3><?php echo esc_html( $item_1_title ); ?></h3>
                <p><?php echo esc_html( $item_1_text ); ?></p>
            </div>

            <!-- Filar 2 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg class="feature-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
                    </svg>
                </div>
                <h3><?php echo esc_html( $item_2_title ); ?></h3>
                <p><?php echo esc_html( $item_2_text ); ?></p>
            </div>

            <!-- Filar 3 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg class="feature-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 3h12l3 7H3l3-7z"/>
                        <path d="M5 10v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-9"/>
                        <line x1="12" y1="14" x2="12" y2="18"/>
                    </svg>
                </div>
                <h3><?php echo esc_html( $item_3_title ); ?></h3>
                <p><?php echo esc_html( $item_3_text ); ?></p>
            </div>
        </div>
    </div>
</section>

