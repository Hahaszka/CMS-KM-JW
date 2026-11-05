<?php
/**
 * Block Name: Sekcja FAQ (acf/faq)
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

$id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'faq-' . $block['id'];

$eyebrow     = get_field( 'eyebrow' ) ?: 'Baza Wiedzy Baristy';
$title       = get_field( 'title' ) ?: 'Często zadawane pytania';
$description = get_field( 'description' ) ?: 'Wszystko co powinieneś wiedzieć o świeżości ziaren, profilach sensorycznych i doborze mielenia.';
$count       = (int) ( get_field( 'count' ) ?: 4 );

$faq_query = new WP_Query( array(
    'post_type'      => 'faq',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );

$schema_entities = array();
?>

<section id="<?php echo esc_attr( $id ); ?>" class="faq-section block-faq">
    <div class="site-container">
        <div class="section-title text-center">
            <?php if ( $eyebrow ) : ?>
                <span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>

            <?php if ( $title ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php elseif ( $is_preview ) : ?>
                <p><em><?php esc_html_e( 'Uzupełnij nagłówek sekcji FAQ →', 'kawiarnia' ); ?></em></p>
            <?php endif; ?>

            <?php if ( $description ) : ?>
                <p><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( $faq_query->have_posts() ) : ?>
            <div class="faq-accordion-wrapper">
                <?php
                while ( $faq_query->have_posts() ) :
                    $faq_query->the_post();

                    $question = get_the_title();
                    $answer   = wp_strip_all_tags( get_the_content() );

                    // Przygotowanie do danych strukturalnych FAQPage JSON-LD
                    $schema_entities[] = array(
                        '@type'          => 'Question',
                        'name'           => $question,
                        'acceptedAnswer' => array(
                            '@type' => 'Answer',
                            'text'  => $answer,
                        ),
                    );
                    ?>
                    <details class="faq-item">
                        <summary class="faq-question">
                            <span><?php echo esc_html( $question ); ?></span>
                            <span class="faq-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                        </summary>
                        <div class="faq-answer">
                            <p><?php echo esc_html( $answer ); ?></p>
                        </div>
                    </details>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <?php if ( ! empty( $schema_entities ) && ! $is_preview ) : ?>
                <!-- Dane strukturalne Google Rich Results FAQPage (JSON-LD) -->
                <script type="application/ld+json">
                <?php
                echo wp_json_encode( array(
                    '@context'   => 'https://schema.org',
                    '@type'      => 'FAQPage',
                    'mainEntity' => $schema_entities,
                ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
                ?>
                </script>
            <?php endif; ?>

        <?php else : ?>
            <p class="text-center"><?php esc_html_e( 'Brak pytań FAQ do wyświetlenia. Dodaj pierwsze pytania w panelu WordPressa.', 'kawiarnia' ); ?></p>
        <?php endif; ?>
    </div>
</section>
