<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Kawiarnia
 */

get_header();
?>

<div class="site-container error-404-container">
    <div class="error-404-card">
        <!-- Coffee illustration with animated steam -->
        <div class="coffee-404-illustration">
            <svg class="cup-svg" viewBox="0 0 160 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Steam lines (animated) -->
                <path class="steam steam-1" d="M55 35 Q 50 20 60 8" stroke="#b86728" stroke-width="2.5" stroke-linecap="round"/>
                <path class="steam steam-2" d="M75 35 Q 80 18 70 5" stroke="#b86728" stroke-width="2.5" stroke-linecap="round"/>
                <path class="steam steam-3" d="M95 35 Q 90 20 100 8" stroke="#b86728" stroke-width="2.5" stroke-linecap="round"/>
                
                <!-- Cup Body -->
                <path d="M35 48 H 115 L 105 98 C 103 104 96 108 88 108 H 62 C 54 108 47 104 45 98 L 35 48 Z" fill="#ffffff" stroke="#241a15" stroke-width="3" stroke-linejoin="round"/>
                
                <!-- Coffee liquid surface -->
                <ellipse cx="75" cy="54" rx="35" ry="6" fill="#b86728"/>
                
                <!-- Cup Handle -->
                <path d="M112 55 C 130 55 132 82 110 86" stroke="#241a15" stroke-width="3" stroke-linecap="round"/>
                
                <!-- Saucer -->
                <path d="M22 108 Q 75 116 128 108" stroke="#241a15" stroke-width="3" stroke-linecap="round"/>
            </svg>
        </div>

        <div class="error-badge">Kod błędu 404 &bull; Pusty Drip</div>
        <h1 class="error-heading">Ta strona rozlała się jak kawa...</h1>
        <p class="error-description">Wygląda na to, że wpisany adres nie istnieje, ziarna się skończyły lub strona została przeniesiona do innego działu naszej palarni.</p>

        <div class="error-actions">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Wróć na stronę główną</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/#features' ) ); ?>" class="btn btn-secondary btn-lg">
                <span>Nasza oferta</span>
            </a>
        </div>

        <div class="error-search-box">
            <p class="search-prompt">Wpisz czego szukasz w naszym sklepie i dzienniku:</p>
            <?php get_search_form(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
