<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Kawiarnia
 */

get_header();
?>

<div class="site-container error-404-container">
    <div class="error-404-content text-center">
        <span class="error-code">404</span>
        <h1 class="page-title">Ups! Ta strona rozlała się jak kawa...</h1>
        <p class="page-subtitle">Wygląda na to, że strona, której szukasz, nie istnieje lub została przeniesiona pod inny adres.</p>

        <div class="error-actions">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">&larr; Wróć na stronę główną</a>
        </div>

        <div class="error-search">
            <p>Możesz też spróbować wyszukać interesującą Cię frazę:</p>
            <?php get_search_form(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
