<?php
/**
 * The template for displaying the front page
 *
 * @package Kawiarnia
 */

get_header();
?>

<!-- Announcement Strip -->
<div class="roastery-strip">
    <div class="site-container strip-inner">
        <span>Świeże wypały w każdy wtorek i czwartek</span>
        <span class="strip-divider">&bull;</span>
        <span>Ziarna Specialty 100% Arabica SCA 85+</span>
        <span class="strip-divider">&bull;</span>
        <span>Darmowa dostawa od 150 zł</span>
    </div>
</div>

<!-- Hero Section with Ambient Coffee Animation -->
<section class="hero-section">
    <canvas id="coffee-hero-canvas" class="hero-canvas" aria-hidden="true"></canvas>
    <div class="site-container hero-inner">
        <div class="hero-label">Rzemieślnicza Palarnia Kawy</div>
        <h1 class="hero-title">Ziarna z plantacji, które znamy z imienia</h1>
        <p class="hero-description">Wypalamy kawy jednorodne (Single Origin) i limitowane mikroloty z Etiopii, Kolumbii, Kenii oraz Panamy. Z zachowaniem pełnego profilu sensorycznego odmiany i terroir.</p>
        
        <div class="hero-actions">
            <a href="#features" class="btn btn-primary">Zobacz profile ziaren</a>
            <a href="#latest-posts" class="btn btn-secondary">Dziennik palarni</a>
        </div>

        <div class="hero-specs">
            <div class="spec-item">
                <span class="spec-num">86-91</span>
                <span class="spec-label">SCA Cupping Score</span>
            </div>
            <div class="spec-item">
                <span class="spec-num">100%</span>
                <span class="spec-label">Transparent Trade</span>
            </div>
            <div class="spec-item">
                <span class="spec-num">Omni</span>
                <span class="spec-label">Profil pod filtr i espresso</span>
            </div>
        </div>
    </div>
</section>

<!-- 3 Features / Categories (zgodnie z wireframe - bez emotek, z precyzyjnym SVG) -->
<section id="features" class="features-section">
    <div class="site-container">
        <div class="section-title text-center">
            <span class="section-eyebrow">Filozofia Rzemiosła</span>
            <h2>Od krzewu po filiżankę</h2>
            <p>Trzy filary, które definiują jakość w segmencie Third Wave Coffee</p>
        </div>

        <div class="features-grid">
            <!-- Feature 1: Pochodzenie -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg class="feature-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                        <path d="M12 6c-3 3-4 6-4 9"/>
                        <path d="M12 6c3 3 4 6 4 9"/>
                        <line x1="2" y1="12" x2="22" y2="12"/>
                    </svg>
                </div>
                <h3>Pochodzenie & Terroir</h3>
                <p>Wyłącznie świeże zbiory z bezpośredniego importu. Podajemy wysokość upraw (m n.p.m.), odmianę botaniczną (Bourbon, Geisha, SL28) oraz precyzyjną metodę obróbki.</p>
            </div>

            <!-- Feature 2: Profilowanie palenia -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg class="feature-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
                    </svg>
                </div>
                <h3>Profilowane Palenie</h3>
                <p>Piecyk bębnowy i rygorystyczna krzywa RoR (Rate of Rise). Jasne palenie podkreśla naturalną kwasowość, nuty kwiatowe i owocowe zamiast goryczy spalenizny.</p>
            </div>

            <!-- Feature 3: Parzenie alternatywne -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg class="feature-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 3h12l3 7H3l3-7z"/>
                        <path d="M5 10v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-9"/>
                        <line x1="12" y1="14" x2="12" y2="18"/>
                    </svg>
                </div>
                <h3>Metody Alternatywne</h3>
                <p>Kompletne wyposażenie domowego baristy: drippery Hario V60, Chemex, Aeropress, filtry papierowe oraz żarnowe młynki manualne i elektryczne.</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Posts Section (WP_Query + wp_reset_postdata) -->
<section id="latest-posts" class="latest-posts-section">
    <div class="site-container">
        <div class="section-header-flex">
            <div>
                <span class="section-eyebrow">Wiedza & Warsztat</span>
                <h2>Dziennik Palarni</h2>
                <p>Receptury parzenia, testy sensoryczne i przewodniki po obróbkach ziaren</p>
            </div>
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

<!-- Newsletter / Subskrypcja (Kraft style) -->
<section class="newsletter-section">
    <div class="site-container">
        <div class="newsletter-card">
            <div class="newsletter-content">
                <span class="newsletter-tag">Klub Kawowy</span>
                <h2>Świeże wypały prosto na Twój stół</h2>
                <p>Dołącz do newslettera palarni. Co dwa tygodnie wysyłamy kody rabatowe, zapowiedzi mikrolotów i receptury parzenia od naszych roasterów.</p>
                <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Dziękujemy za dołączenie do Klubu Kawowego!');">
                    <input type="email" placeholder="Wpisz adres e-mail (np. barista@kawiarnia.pl)" required>
                    <button type="submit" class="btn btn-primary">Dołącz</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
