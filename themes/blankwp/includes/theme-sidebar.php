<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function blankwp_widgets_init(): void
{
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar chính', 'blankwp' ),
            'id'            => 'sidebar-main',
            'description'   => esc_html__( 'Thêm widget sử dụng cho sidebar.', 'blankwp' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'blankwp_widgets_init' );