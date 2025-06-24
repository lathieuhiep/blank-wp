<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Action
 * */

// set favicon default
function blankwp_fallback_favicon(): void
{
    if ( ! has_site_icon() ) :
        $base_favicon_url = get_theme_file_uri( '/assets/images/favicons/' );
    ?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $base_favicon_url . 'apple-touch-icon.png' ) ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( $base_favicon_url . 'favicon-96x96.png' ) ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( $base_favicon_url . 'favicon-96x96.png' ) ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo esc_url($base_favicon_url . 'favicon.ico') ?>">
        <link rel="manifest" href="<?php echo esc_url($base_favicon_url . 'site.webmanifest') ?>">
        <link rel="icon" type="image/svg+xml" href="<?php echo esc_url($base_favicon_url . 'favicon.svg') ?>">
    <?php
    endif;
}
add_action( 'wp_head', 'blankwp_fallback_favicon' );

// optimize WordPress
add_action('init', 'blankwp_optimize_wordpress');
function blankwp_optimize_wordpress(): void {
    // Disable WordPress Emoji
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'blankwp_disable_emojis_tinymce' );

    // Disable WordPress REST API links
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('template_redirect', 'rest_output_link_header', 11);

    // Disable RSD link and WLW manifest link
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');

    // Disable WordPress version
    remove_action('wp_head', 'wp_generator');
}

function blankwp_disable_emojis_tinymce( $plugins ): array {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/*
 * Filter
 * */

// disable WordPress xmlrpc
add_filter('xmlrpc_enabled', '__return_false');

// disable gutenberg editor
add_filter("use_block_editor_for_post_type", "blankwp_disable_gutenberg_editor");
function blankwp_disable_gutenberg_editor(): bool {
    return false;
}

// disable gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');