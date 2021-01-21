<?php

namespace MustUseLocal\Jetpack;

// Must be true for Jetpack related posts to work.
add_filter( 'jetpack_is_staging_site', '__return_true' );

// Must be false for Jetpack related posts to work.
add_filter( 'jetpack_offline_mode', '__return_false' );

add_action( 'login_init', __NAMESPACE__ . '\remove_jetpack_sso', 1 );
add_filter( 'jetpack_relatedposts_returned_results', __NAMESPACE__ . '\filter_related_posts_results', 10, 2 );

/**
 * Prevent Jetpack SSO locally.
 */
function remove_jetpack_sso() {
	$jetpack_sso = \Jetpack_SSO::get_instance();
	$jetpack_protect = \Jetpack_Protect_Module::instance();

	// Prevent WordPress.com login, use passwords.
	remove_filter( 'login_init', array( $jetpack_sso, 'login_init' ) );

	// Avoid that math form.
	remove_action( 'login_form', array ( $jetpack_protect, 'check_use_math' ), 0 );
	remove_filter( 'authenticate', array ( $jetpack_protect, 'check_preauth' ), 10 );
}

/**
 * Filter the related posts results so that a set of local content
 * is returned instead.
 *
 * @param array $results A likely empty list of results.
 * @param int   $post_id The post ID of the content being displayed.
 * @return array A modified list of related posts.
 */
function filter_related_posts_results( $results, $post_id ) {
	$post = get_post( $post_id );

	$results_raw = new \WP_Query( array(
		'post_type'      => $post->post_type,
		'fields'         => 'ids',
		'no_found_rows'  => true,
		'post__not_in'   => array( $post_id ),
		'posts_per_page' => 3,
	) );

	// Temporarily go "offline" so that Photon isn't used for images.
	add_filter( 'jetpack_offline_mode', '__return_true' );

	if ( $results_raw->have_posts() ) {
		$jetpack_related = \Jetpack_RelatedPosts::init();
		$position = 0;

		foreach ( $results_raw->posts as $result ) {
			$results[] = $jetpack_related->get_related_post_data_for_post( $result, $position, $post_id );
			$position++;
		}
	}
	wp_reset_postdata();

	// Go back "online".
	remove_filter( 'jetpack_offline_mode', '__return_true' );

	return $results;
}
