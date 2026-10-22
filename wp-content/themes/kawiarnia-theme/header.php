<?php
/**
 * The header for our theme
 *
 * @package Kawiarnia
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">
    <header id="masthead" class="site-header">
        <div class="site-container header-inner">
            <div class="site-branding">
                <?php
                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
                    the_custom_logo();
                else :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Menu główne', 'kawiarnia' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => function() {
                        echo '<ul id="primary-menu" class="nav-menu">';
                        echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Strona Główna', 'kawiarnia' ) . '</a></li>';
                        wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
                        echo '</ul>';
                    },
                ) );
                ?>
            </nav>
        </div>
    </header>

    <main id="primary" class="site-main">
