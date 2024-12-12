<?php

/**
 * Plugin name: ObondProperty
 * Description: Booking
 * Author: Oleksandr Bondaruk
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: obondproperty
 * Domain Path: /languages
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once plugin_dir_path( __FILE__ ) . 'inc/class_custom_post_type.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/class-obondproperty.php';

$cptJson = file_get_contents( plugin_dir_path( __FILE__ ) . 'config/cpt.json' );
$cpt = json_decode( $cptJson, true );

echo "<pre>";
print_r( $cpt );
echo "</pre>";

$args_properties = array(
	'label'       => __( 'Property', 'obondproperty' ),
	'public'      => true,
	'has_archive' => true,
	'rewrite'     => array( 'slug' => 'property' ),
	'supports'    => array( 'title', 'editor', 'thumbnail' )
);

if ( class_exists( 'CustomPostType' ) ) {
	$customPostType = new CustomPostType( 'property', $args_properties );

	$obondProperty = new Obondproperty( $customPostType );
	$obondProperty->register_post_type();

	register_activation_hook( __FILE__, array( $obondProperty, 'activate' ) );
	register_deactivation_hook( __FILE__, array( $obondProperty, 'deactivate' ) );
} else {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>' . __( 'The CustomPostType class is missing or failed to load.', 'obondproperty' ) . '</p></div>';
	} );

	return;
}