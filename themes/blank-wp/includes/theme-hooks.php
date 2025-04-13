<?php
/*
 * Filter
 * */

// disable WordPress xmlrpc
add_filter('xmlrpc_enabled', '__return_false');

// disable gutenberg editor
add_filter("use_block_editor_for_post_type", "blank_wp_disable_gutenberg_editor");
function blank_wp_disable_gutenberg_editor(): bool {
    return false;
}

// disable gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');