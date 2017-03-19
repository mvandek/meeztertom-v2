<?php

/**
 * Enqueue scripts and styles.
 *
 */
function meeztertom_v2_style() {
wp_enqueue_style( 'radiate-style', get_template_directory_uri().'/style.css' );

// Load our main stylesheet.
wp_enqueue_style( 'meeztertom-v2-style', get_stylesheet_directory_uri().'/style.css', array( 'radiate-style' ), '20170104' );
}
add_action( 'wp_enqueue_scripts', 'meeztertom_v2_style' );

/**
* Adds several Custom Post Types to the loop, to display it between regular posts
*
* @since MeezterTom.nl V2 1.0
*/
add_action('pre_get_posts', function(\WP_Query $q) {
if ( ( is_archive() && ! is_post_type_archive() ) && $q->is_main_query() ) {
set_query_var( 'post_type', [
'post',
'vlogs',
'oefenmateriaal',
] );
return $q;
}
} );

function radiate_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="white-block navigation post-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'radiate' ); ?></h3>
		<div class="nav-links">

			<div class="nav-previous"><?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'radiate' ) ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'radiate' ) ); ?></div>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Instead of HTTP response 200, give HTTP response 403 error for correct HTTP response
 */
function wp_login_failed_right_http_status_header() {
status_header( 403 );
}
add_action( 'wp_login_failed', 'wp_login_failed_right_http_status_header' );


/************************************************************************************
 *				Filters for this theme
 ************************************************************************************/

/**
* Stop loading the JavaScript and CSS stylesheet on all pages for Contact Form 7
 */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

/**
 * Change the failed login message for extra WordPress Secruty
 */
function wp_login_failed_status_message() {
return 'De ingevoerde gegevens zijn onjuist.';
}
add_filter('login_errors', 'wp_login_failed_status_message');

// Don't log IP addresses of comment authors.
add_filter( 'pre_comment_user_ip', '__return_empty_string' );

// Don't log User Agents of comment authors.
add_filter( 'pre_comment_user_agent', '__return_empty_string' );

// Enable the builtin and by default disabled Link manager
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

function hide_password_field() {
    if( ! current_user_can( 'create_users' ) ) {
        // hide only for subscribers
        return false;
    }
    return true; // for all other users that can edit posts
}
add_filter( 'show_password_fields', 'hide_password_field' );
