<?php
/**
 * TA Twenty.
 *
 * This file adds functions to the TA Twenty Theme.
 *
 * @package TA Twenty
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'ta_twenty_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function ta_twenty_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
	genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}

add_action( 'wp_enqueue_scripts', 'ta_twenty_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function ta_twenty_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style( 'dashicons' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

}

add_action( 'after_setup_theme', 'ta_twenty_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function ta_twenty_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'ta_twenty_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function ta_twenty_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );
add_image_size( 'genesis-singular-images', 702, 526, true );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'ta_twenty_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function ta_twenty_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'ta_twenty_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function ta_twenty_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'ta_twenty_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function ta_twenty_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

//* js edit - Modify the read more link
add_filter('excerpt_more','sp_read_more_link');	// this is from the gc-ea theme
function sp_read_more_link() {
	return ' [...]';
}

//* js edit - add font from google api
wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=PT+Sans:400,700', array(), "CHILD_THEME_VERSION" );

/**
 * js edit - turn off fullscreen default in editor
 * @link https://jeanbaptisteaudras.com/en/2020/03/disable-block-editor-default-fullscreen-mode-in-wordpress-5-4/
*/
if (is_admin()) {
	function jba_disable_editor_fullscreen_by_default() {
    $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
    wp_add_inline_script( 'wp-blocks', $script );
	}
	add_action( 'enqueue_block_editor_assets', 'jba_disable_editor_fullscreen_by_default' );
}

/**
 * Gutenberg scripts and styles for custom blocks
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 */
function be_gutenberg_scripts() {

	wp_enqueue_script(
		'be-editor',
		get_stylesheet_directory_uri() . '/assets/js/editor.js',
		array( 'wp-blocks', 'wp-dom' ),
		filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );

//* js edit - full width content actually full width on homepage
add_action('genesis_after_header','gc_twenty_full_width_before', 0);
function gc_twenty_full_width_before() {
	if(is_front_page()) {
		echo '<div class="ta-twenty-front-page">';
	}
}
add_action('genesis_before_footer','gc_twenty_full_width_after', 0);
function gc_twenty_full_width_after() {
	if(is_front_page()) {
		echo '</div>';
	}
}

//* js edit modify blockquote markup for easier styling
add_filter('render_block','gc_block_quote',10,2);
function gc_block_quote($block_content, $block) {
	if($block['blockName']==='core/quote') {
		$original = '<blockquote class="wp-block-quote">';
		$new = '<blockquote class="wp-block-quote"><div>';
		$block_content = str_replace($original, $new, $block_content);
		$original = '</blockquote>';
		$new = '</div></blockquote>';
		$block_content = str_replace($original, $new, $block_content);
	}
	return $block_content;
}

//* js edit modify markup for study skills info pages
add_filter('genesis_post_title_output','ta_heading');
add_action('genesis_entry_content','ta_remove_h2',0);
add_action('genesis_after_entry_content','ta_remove_h2_after',0);
function ta_heading($title) {
	if(is_page('study-skills-curriculum') || is_page('study-skills-course')) {
		$content = get_the_content();
		echo '<div class="study-skills-info">' . $title . substr($content,0,strpos($content,'<!-- /wp:heading -->')+20) . '</div>';
	} else {
		echo $title;
	}
}
function ta_remove_h2() {
	if(is_page('study-skills-curriculum') || is_page('study-skills-course')) {
		echo '<div class="study-skills-remove">';
	}
}
function ta_remove_h2_after() {
	if(is_page('study-skills-curriculum') || is_page('study-skills-course')) {
		echo '</div>';
	}
}

/* js edits - fixes for current sponge setup */
//* Modify breadcrumb arguments for the archives (course home pages) to remove the 'Archives for' tag
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );
function sp_breadcrumb_args( $args ) {
	$args['labels']['category'] = '';
return $args;
}

/* Reorder the posts on Category/Course Pages */
/*
 * @author Bill Erickson (with modification)
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 */
add_action( 'pre_get_posts', 'category_ascend_posts' );
function category_ascend_posts( $query ) {

	if( $query->is_main_query() && $query->is_category() ) {
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'ASC' );
	}
}

//* Customize the post info function */
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
if ( !is_page() ) {
	$post_info = 'Status: [ta_post_status] [post_edit]';
	return $post_info;
}}

/* disable posts from child categories in main query  */
add_filter('pre_get_posts','custom_csp_pre_get_posts',20,1);
function custom_csp_pre_get_posts($query) {
    if(function_exists('is_main_query')) {
        if($query->is_category && !$query->is_admin && !$query->is_preview && $query->is_main_query() && false == $query->query_vars['suppress_filters']) {
					// $cat = get_term_by( 'id', 85, 'category');	// local
            $cat = get_term_by( 'slug', $query->query_vars['category_name'], 'category');	// live
            $query->set('category__in',array($cat->term_id));
        }
    }
    return $query ;
}

/*
 *	Customize Gravity Forms
 */

# anchor to forms after submission to show the badge
add_filter( 'gform_confirmation_anchor', '__return_true' );

# auto add user's name, email, and membership status to gf for mailchimp registration, sponge eval1
add_filter('gform_field_value_learner_email', 'populate_post_learner_email');
function populate_post_learner_email($value){
    $user = wp_get_current_user();
    return $user->user_email;
}
add_filter('gform_field_value_learner_fname', 'populate_post_learner_fname');
function populate_post_learner_fname($value){
    $user = wp_get_current_user();
    return $user->user_firstname;
}
add_filter('gform_field_value_learner_lname', 'populate_post_learner_lname');
function populate_post_learner_lname($value){
    $user = wp_get_current_user();
    return $user->user_lastname;
}
add_filter('gform_field_value_learner_uname', 'populate_post_learner_uname');
function populate_post_learner_uname($value){
    $user = wp_get_current_user();
    return $user->user_login;
}
add_filter('gform_field_value_member_status', 'populate_post_member_status');
function populate_post_member_status($value){
	if(pmpro_hasMembershipLevel('4')) {
		return 'student';
	} elseif(pmpro_hasMembershipLevel('3')) {
		return 'teacher';
	} elseif(pmpro_hasMembershipLevel('5')) {
		return 'edreviewer';
	} else {
		return 'parent';
	}
}


/*
 *	Customize the Login, Profiles, & other User Displays
 */

/**
 * WordPress function for redirecting users on login based on user role
 *  https://developer.wordpress.org/reference/hooks/login_redirect/
 */
function ta_my_login_redirect( $url, $request, $user ) {
    if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
      if ( $user->has_cap( 'administrator' ) ) {
          $url = admin_url();
      } else {
          $url = home_url( '/course/study-skills/' );
      }
		}
  return $url;
}
add_filter( 'login_redirect', 'ta_my_login_redirect', 10, 3 );

# https://developer.wordpress.org/reference/hooks/logout_redirect/
function ta_my_logout_redirect( $redirect_to, $requested_redirect_to, $user ) {
	if(strpos($redirect_to,'membership-checkout')>=0) {
    if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        $requested_redirect_to = home_url();
    }
  return $requested_redirect_to;
	}
}
add_filter( 'logout_redirect', 'ta_my_logout_redirect', 10, 3 );
