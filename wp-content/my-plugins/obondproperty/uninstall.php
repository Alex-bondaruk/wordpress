<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$properties = get_posts( array(
	'post_type'      => 'property',
	'posts_per_page' => -1
));

if ( ! empty( $properties ) ) {
	foreach ( $properties as $property ) {
		wp_delete_post( $property->ID, true );
	}
}