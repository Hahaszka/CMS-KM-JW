<?php
/**
 * The template for displaying the front page
 *
 * @package Kawiarnia
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="site-container hero-inner">
        <span class="hero-badge">Świeżo palona kawa specialty</span>
        <h1 class="hero-title">Odkryj autentyczny smak rzemieślniczych ziaren</h1>
        <p class="hero-description">Starannie wyselekcjonowane ziarna z plantacji w Etiopii, Kolumbii i Gwatemali. Wypalane z pasją w małych partiach.</p>
        <div class="hero-actions">
            <a href="#features" class="btn btn-primary">Nasza Oferta</a>
            <a href="#latest-posts" class="btn btn-secondary">Aktualności z Palarni</a>
        </div>
    </div>
</section>

<!-- 3 Features / Categories (zgodnie z wireframe) -->
<section id="features" class="features-section">
    <div class="site-container">
        <div class="section-title text-center">
            <h2>Dlaczego nasza kawiarnia?</h2>
            <p>Jakość, transparentność pochodzenia i rzemiosło w każdej filiżance</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">&#9749;</div>
                <h3>Kawa Specialty</h3>
                <p>Wyłącznie ziarna segmentu specialty z punktacją SCA powyżej 84 punktów.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">&#9879;</div>
                <h3>Metody Alternatywne</h3>
                <p>Akcesoria do metod przelewowych: V60, Chemex, Aeropress i French Press.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">&#128640;</div>
                <h3>Świeżość Gwarantowana</h3>
                <p>Ziarna wypalane co tydzień, pakowane w torebki z zaworem jednostronnym.</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Posts Section (WP_Query + wp_reset_postdata) -->
<section id="latest-posts" class="latest-posts-section">
    <div class="site-container">
        <div class="section-title">
            <h2>Aktualności z palarni i blog</h2>
            <p>Poradniki parzenia, recenzje ziaren i relacje z podróży po plantacjach</p>
        </div>

        <div class="posts-grid">
            <?php
            $latest_posts = new WP_Query( array(
                'posts_per_page'      => 3,
                'ignore_sticky_posts' => 1,
            ) );

            if ( $latest_posts->have_posts() ) :
                while ( $latest_posts->have_posts() ) :
                    $latest_posts->the_post();
                    get_template_part( 'template-parts/content', get_post_format() );
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p><?php esc_html_e( 'Brak wpisów.', 'kawiarnia' ); ?></p>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Newsletter Section (zgodnie z wireframe) -->
<section class="newsletter-section">
    <div class="site-container newsletter-box">
        <h2>Dołącz do Klubu Koneserów Kawy</h2>
        <p>Zapisz się do newslettera i odbierz 10% rabatu na pierwsze zamówienie ziaren.</p>
        <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Dziękujemy za zapis do newslettera!');">
            <input type="email" placeholder="Wpisz swój adres e-mail" required>
            <button type="submit" class="btn btn-primary">Zapisz się</button>
        </form>
    </div>
</section>

<?php
get_footer();
