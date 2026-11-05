<?php
/**
 * Theme Customizer global settings (Dane globalne)
 *
 * @package Kawiarnia
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Rejestracja sekcji i kontrolek w Customizerze (Wygląd -> Dostosuj)
 */
function kawiarnia_customize_register( $wp_customize ) {
    // Sekcja: Dane kawiarni i sklepu
    $wp_customize->add_section( 'kawiarnia_shop_details', array(
        'title'       => __( 'Dane kawiarni i sklepu', 'kawiarnia' ),
        'description' => __( 'Globalne dane kontaktowe, godziny otwarcia i media społecznościowe wyświetlane w nagłówku i stopce.', 'kawiarnia' ),
        'priority'    => 30,
    ) );

    // 1. Pasek informacyjny (Announcement bar)
    $wp_customize->add_setting( 'kawiarnia_announcement', array(
        'default'           => 'Świeże wypały w każdy wtorek i czwartek • Ziarna Specialty 100% Arabica SCA 85+ • Darmowa dostawa od 150 zł',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kawiarnia_announcement', array(
        'label'    => __( 'Tekst paska ogłoszeń (góra strony)', 'kawiarnia' ),
        'section'  => 'kawiarnia_shop_details',
        'type'     => 'text',
    ) );

    // 2. Telefon
    $wp_customize->add_setting( 'kawiarnia_phone', array(
        'default'           => '+48 501 234 567',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kawiarnia_phone', array(
        'label'    => __( 'Numer telefonu', 'kawiarnia' ),
        'section'  => 'kawiarnia_shop_details',
        'type'     => 'text',
    ) );

    // 3. E-mail
    $wp_customize->add_setting( 'kawiarnia_email', array(
        'default'           => 'kontakt@kawiarnia-specialty.pl',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'kawiarnia_email', array(
        'label'    => __( 'Adres e-mail', 'kawiarnia' ),
        'section'  => 'kawiarnia_shop_details',
        'type'     => 'email',
    ) );

    // 4. Adres
    $wp_customize->add_setting( 'kawiarnia_address', array(
        'default'           => 'ul. Palarniana 12, 00-001 Warszawa',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kawiarnia_address', array(
        'label'    => __( 'Adres lokalu i palarni', 'kawiarnia' ),
        'section'  => 'kawiarnia_shop_details',
        'type'     => 'text',
    ) );

    // 5. Godziny otwarcia
    $wp_customize->add_setting( 'kawiarnia_hours', array(
        'default'           => 'Pn – Pt: 07:30 – 19:00 | Sb – Nd: 09:00 – 18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kawiarnia_hours', array(
        'label'    => __( 'Godziny otwarcia', 'kawiarnia' ),
        'section'  => 'kawiarnia_shop_details',
        'type'     => 'text',
    ) );

    // 6. Instagram
    $wp_customize->add_setting( 'kawiarnia_instagram', array(
        'default'           => 'https://instagram.com/kawiarnia.specialty',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'kawiarnia_instagram', array(
        'label'    => __( 'Profil Instagram (URL)', 'kawiarnia' ),
        'section'  => 'kawiarnia_shop_details',
        'type'     => 'url',
    ) );

    // 7. Facebook
    $wp_customize->add_setting( 'kawiarnia_facebook', array(
        'default'           => 'https://facebook.com/kawiarnia.specialty',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'kawiarnia_facebook', array(
        'label'    => __( 'Profil Facebook (URL)', 'kawiarnia' ),
        'section'  => 'kawiarnia_shop_details',
        'type'     => 'url',
    ) );
}
add_action( 'customize_register', 'kawiarnia_customize_register' );

