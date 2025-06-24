<?php
if (!defined('ABSPATH')) {
    exit;
}

// Remove jquery migrate
add_action('wp_default_scripts', 'blankwp_remove_jquery_migrate');
function blankwp_remove_jquery_migrate($scripts): void
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}

// Remove WordPress block library CSS from loading on the front-end
function blankwp_remove_wp_block_library_css(): void
{
    // remove style gutenberg
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');

    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('storefront-gutenberg-blocks');
}
add_action('wp_enqueue_scripts', 'blankwp_remove_wp_block_library_css', 100);

// custom enqueue jQuery first
function blankwp_custom_enqueue_jquery_first(): void
{
    if ( ! is_admin() ) {
        // deregister the default jQuery
        wp_deregister_script( 'jquery' );

        // register and enqueue the jQuery script
        wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.min.js' ), array(), null, true );
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'blankwp_custom_enqueue_jquery_first', 1 );

// Enqueue scripts and styles
function blankwp_enqueue_scripts(): void
{
    // include bootstrap css
    wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/vendors/bootstrap/bootstrap.min.css'), array(), '5.3.7');

    // enqueue style theme
    wp_enqueue_style('blankwp-main', get_theme_file_uri('/assets/css/main.bundle.min.css'), array(), wp_get_theme()->get('Version'));

    // enqueue style page 404
    if (is_404()) {
        wp_enqueue_style('blankwp-page-404', get_theme_file_uri('/assets/css/page-templates/page-404.min.css'), array(), wp_get_theme()->get('Version'));
    }

    // enqueue script theme
    wp_enqueue_script('blankwp-main', get_theme_file_uri('/assets/js/main.bundle.min.js'), array('jquery'), wp_get_theme()->get('Version'), true);

    // Enqueue comment-reply script if needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'blankwp_enqueue_scripts');