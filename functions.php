<?php
/**
 * DEFAULTS
 */
if ( function_exists( 'add_theme_support' ) )
{
    // Add support for document title tag
    add_theme_support( 'title-tag' );

    // Add Thumbnail Theme Support
    add_theme_support( 'post-thumbnails' );
    // add_image_size( 'custom-size', 700, 200, true );

    // Add Support for post formats
    // add_theme_support( 'post-formats', ['post'] );
    // add_post_type_support( 'page', 'excerpt' );
}

add_action( 'admin_init', 'ra_register_settings' );

function ra_register_settings()
{
    register_setting(
        'general',
        'ra_redirect_url',
        'esc_html' // <--- Customize this if there are multiple fields
    );
    add_settings_section(
        'ra_redirect',
        'Redirect Options',
        '__return_false',
        'general'
    );
    add_settings_field(
        'ra_redirect_url',
        'Redirect Url',
        'ra_redirect_url_setting',
        'general',
        'ra_redirect'
    );
}

function ra_redirect_url_setting()
{
    $redirect_url = html_entity_decode( get_option( 'ra_redirect_url' ) );
    echo '<input name="ra_redirect_url", value="' . $redirect_url . '" type="url" class="regular-text code" />';
}

function ra_redirect() {
    $redirect_url = html_entity_decode( get_option( 'ra_redirect_url' ) );

    if(empty($redirect_url))
        return false;

    if (!is_admin() ) {
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('template_redirect', 'ra_redirect');

/**
 * CUSTOM
 */
