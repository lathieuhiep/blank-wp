<?php
// register widget elementor
add_action( 'elementor/widgets/register', 'efa_register_widget_elementor_addon' );
function efa_register_widget_elementor_addon( $widgets_manager ): void {
	// include add on
    require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/heading-with-editor.php';

	// register add on
    $widgets_manager->register( new \EFA_Widget_Heading_With_Editor() );
}