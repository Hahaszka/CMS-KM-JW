<?php
/**
 * The template for displaying the footer
 *
 * @package Kawiarnia
 */
?>
    </main><!-- #primary -->

    <footer id="colophon" class="site-footer">
        <div class="site-container footer-inner">
            <div class="footer-info">
                <h3><?php bloginfo( 'name' ); ?></h3>
                <p>Specjalistyczna palarnia i kawiarnia rzemieślnicza. Świeżo palone ziarna, akcesoria dripper / aeropress i warsztaty cuppingowe.</p>
            </div>

            <div class="footer-links">
                <?php
                if ( has_nav_menu( 'footer' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'depth'          => 1,
                    ) );
                endif;
                ?>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. Projekt i realizacja na laboratorium SZT.</p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
