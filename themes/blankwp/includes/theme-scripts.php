<?php
if (!defined('ABSPATH')) {
    exit;
}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'blankwp_remove_jquery_migrate' );
function blankwp_remove_jquery_migrate( $scripts ): void {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

// Remove WordPress block library CSS from loading on the front-end
function blankwp_remove_wp_block_library_css(): void {
    // remove style gutenberg
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style( 'classic-theme-styles' );

    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('storefront-gutenberg-blocks');
}
add_action( 'wp_enqueue_scripts', 'blankwp_remove_wp_block_library_css', 100 );

// Enqueue scripts and styles
function blankwp_enqueue_scripts(): void
{
    // enqueue style
    wp_enqueue_style('main-style', get_theme_file_uri('/assets/css/style-main.css'), array(), wp_get_theme()->get('Version'));


    // enqueue script
    wp_enqueue_script('theme-main', get_theme_file_uri('/assets/js/theme-main.js'), array('jquery'), wp_get_theme()->get('Version'), true);

    // Enqueue comment-reply script if needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'blankwp_enqueue_scripts');