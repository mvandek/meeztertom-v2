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

// Device Pixels support
// This improves the resolution of gravatars and wordpress.com uploads on hi-res and zoomed browsers. We only have gravatars so we should be ok without it.
wp_deregister_script('devicepx');
wp_dequeue_script('devicepx');

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
'faq',
] );
return $q;
}
} );

function radiate_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : wpcom_vip_get_adjacent_post( false, '', true );
	$next     = wpcom_vip_get_adjacent_post( false, '', false );

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

function meeztertom_hide_password_field() {
    if( current_user_can( 'create_users' ) ) {
        // hide only for subscribers
        return true;
    }
}
add_filter( 'show_password_fields', 'meeztertom_hide_password_field' );

/************************************************************************************
 *				Actions for this theme
 ************************************************************************************/

function meeztertom_remove_jetpack_page( ) {
    if ( class_exists( 'Jetpack' ) && !current_user_can( 'manage_options' ) ) {
        remove_menu_page( 'jetpack' );
    }
}
add_action( 'admin_menu', 'meeztertom_remove_jetpack_page', 999 );

function show_user_info() {
if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	$user_id = get_current_user_id();
	$birthday = get_user_meta( $user_id, 'birthday', TRUE ); // Pull your value
	$today = current_time( 'Y-m-d', $gmt = 0 ); // Convert to + seconds since unix epoch
	if ( $birthday === $today ) { // if date value pulled is today, it's our birthday
 	   $message = 'Het is jouw verjaardag! &#127874;';
	} else {
		$message = 'Jij bent nog niet jarig... &#128542;';
	}
	?>
		<aside class="widget">
			<?= '<p>Hallo ' . $current_user->display_name . '</p>'; ?>
			<?= '<p>' . esc_html( $message ) . '</p>'; ?>
			<a href="<?= wp_logout_url( home_url() ); ?>">Uitloggen</a>
		</aside>
	<?php
	} // check for logged in user
}
add_action( 'before_sidebar', show_user_info );

function my_deregister_styles() {
   wp_dequeue_style('simple-payments'); 
}
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

// Removes the color picker from the Profiles page
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

/**
 * Load VIP-caching Code.
 */
require get_stylesheet_directory() . '/vip-caching.php';

/**
 * The field on the editing screens.
 *
 * @param $user WP_User user object
 */
function wporg_usermeta_form_field_birthday($user)
{
    ?>
    <h3>De verjaardag van...</h3>
    <table class="form-table">
        <tr>
            <th>
                <label for="birthday">Verjaardag</label>
            </th>
            <td>
                <input type="date"
                       class="regular-text ltr"
                       id="birthday"
                       name="birthday"
                       value="<?= esc_attr(get_user_meta($user->ID, 'birthday', true)); ?>"
                       title="Please use YYYY-MM-DD as the date format."
                       pattern="(19[0-9][0-9]|20[0-9][0-9])-(1[0-2]|0[1-9])-(3[01]|[21][0-9]|0[1-9])"
                       required>
				<p class="description">Vul de datum in waarop deze leerling in het huidige schooljaar jarig is.</p>
			</td>
        </tr>
	</table>
<?php
}
 
/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function wporg_usermeta_form_field_birthday_update($user_id)
{
    // check that the current user have the capability to edit the $user_id
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
 
    // create/update user meta for the $user_id
    return update_user_meta(
        $user_id,
        'birthday',
        $_POST['birthday']
    );
}
 
// add the field to user's own profile editing screen
add_action(
    'edit_user_profile',
    'wporg_usermeta_form_field_birthday'
);
 
// add the field to user profile editing screen
add_action(
    'show_user_profile',
    'wporg_usermeta_form_field_birthday'
);
 
// add the save action to user's own profile editing screen update
add_action(
    'personal_options_update',
    'wporg_usermeta_form_field_birthday_update'
);
 
// add the save action to user profile editing screen update
add_action(
    'edit_user_profile_update',
    'wporg_usermeta_form_field_birthday_update'
);
