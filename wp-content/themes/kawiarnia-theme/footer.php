<?php
/**
 * The template for displaying the footer
 *
 * @package Kawiarnia
 */

$phone     = get_theme_mod( 'kawiarnia_phone', '+48 501 234 567' );
$email     = get_theme_mod( 'kawiarnia_email', 'kontakt@kawiarnia-specialty.pl' );
$address   = get_theme_mod( 'kawiarnia_address', 'ul. Palarniana 12, 00-001 Warszawa' );
$hours     = get_theme_mod( 'kawiarnia_hours', 'Pn – Pt: 07:30 – 19:00 | Sb – Nd: 09:00 – 18:00' );
$instagram = get_theme_mod( 'kawiarnia_instagram', 'https://instagram.com/kawiarnia.specialty' );
$facebook  = get_theme_mod( 'kawiarnia_facebook', 'https://facebook.com/kawiarnia.specialty' );
?>
    </main><!-- #primary -->

    <footer id="colophon" class="site-footer">
        <div class="site-container footer-inner">
            <div class="footer-grid">
                <!-- Kolumna 1: O Palarni i Adres -->
                <div class="footer-col footer-about">
                    <h3 class="footer-title"><?php bloginfo( 'name' ); ?></h3>
                    <p class="footer-desc">Rzemieślnicza palarnia ziaren specialty segmentu Third Wave Coffee. Świeże wypały, transparentne pochodzenie i profesjonalne akcesoria baristy.</p>
                    <?php if ( $address ) : ?>
                        <div class="footer-contact-item">
                            <span class="contact-label"><?php esc_html_e( 'Palarnia i kawiarnia:', 'kawiarnia' ); ?></span>
                            <address class="contact-value"><?php echo esc_html( $address ); ?></address>
                        </div>
                    <?php endif; ?>
                    <?php if ( $hours ) : ?>
                        <div class="footer-contact-item">
                            <span class="contact-label"><?php esc_html_e( 'Godziny otwarcia:', 'kawiarnia' ); ?></span>
                            <span class="contact-value"><?php echo esc_html( $hours ); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Kolumna 2: Kontakt bezpośredni (Dane globalne) -->
                <div class="footer-col footer-contact">
                    <h4 class="footer-heading"><?php esc_html_e( 'Kontakt i zamówienia', 'kawiarnia' ); ?></h4>
                    <ul class="footer-contact-list">
                        <?php if ( $phone ) : ?>
                            <li>
                                <span class="contact-icon">📞</span>
                                <a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>">
                                    <?php echo esc_html( $phone ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ( $email ) : ?>
                            <li>
                                <span class="contact-icon">✉️</span>
                                <a href="<?php echo esc_url( 'mailto:' . $email ); ?>">
                                    <?php echo esc_html( $email ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Social media (Dane globalne) -->
                    <div class="footer-socials">
                        <span class="contact-label"><?php esc_html_e( 'Dołącz do społeczności:', 'kawiarnia' ); ?></span>
                        <div class="social-links">
                            <?php if ( $instagram ) : ?>
                                <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="<?php esc_attr_e( 'Instagram', 'kawiarnia' ); ?>">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>
                                    <span>Instagram</span>
                                </a>
                            <?php endif; ?>

                            <?php if ( $facebook ) : ?>
                                <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="<?php esc_attr_e( 'Facebook', 'kawiarnia' ); ?>">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                    </svg>
                                    <span>Facebook</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Kolumna 3: Nawigacja w stopce -->
                <div class="footer-col footer-links-col">
                    <h4 class="footer-heading"><?php esc_html_e( 'Nawigacja', 'kawiarnia' ); ?></h4>
                    <div class="footer-links">
                        <?php
                        if ( has_nav_menu( 'footer' ) ) :
                            wp_nav_menu( array(
                                'theme_location' => 'footer',
                                'container'      => false,
                                'depth'          => 1,
                            ) );
                        else :
                            ?>
                            <ul class="footer-nav-fallback">
                                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona Główna', 'kawiarnia' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/opinie/' ) ); ?>"><?php esc_html_e( 'Opinie klientów', 'kawiarnia' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>"><?php esc_html_e( 'Baza pytań FAQ', 'kawiarnia' ); ?></a></li>
                            </ul>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Projekt i realizacja na laboratorium SZT — Zespół KM & JW.', 'kawiarnia' ); ?></p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
