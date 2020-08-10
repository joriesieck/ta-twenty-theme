<?php
/**
 * Single Post Template: Slide look
 * This file modifies the single post template
 */

// Get post status as lede/first for the lesson/child cat or not (uses custom field)
global $post;
$lesson_part = get_post_meta($post->ID, 'lesson_part', true);

// Remove categories and tags post info from footer
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

// Show next & (maybe) previous links in the post (entry) footer.
add_action('genesis_entry_footer', 'next_slide' );
function next_slide($atts) {
    next_post_link( '<div class="gray-box" style="margin-top:25px; float:right;">%link</div>', 'Next &raquo;' , $in_same_term = true );
}

// Filter post elements depending if post is the lede/first for the lesson/child cat (uses custom field)
if ($lesson_part != 'lede') {
	//remove the post status
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	//show the "previous" button - ie no previous button for lede
	add_action('genesis_entry_footer', 'prev_slide' );
	//change entry title class to modify (hide) post titles for supporting posts
	add_filter( 'genesis_attr_entry-title', 'myta_change_class' );
}

function prev_slide($atts) {
	previous_post_link( '<div class="gray-box" style="margin-top:25px; float:left;">%link</div>', '&laquo; Prev' ,$in_same_term = true );
}
/* js edit */
function myta_change_class( $attributes ) {
	  $attributes['class'] = 'entry-title-clean-slide';
		return $attributes;
}


// Restrict access to all posts
if(!pmpro_hasMembershipLevel()) {
	// Remove the post content and image (requires HTML5 theme support)
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	// Add the not logged in message (set in pmpro advanced tab)
	add_action( 'genesis_entry_content', 'locked_do_post_content' );
	function locked_do_post_content () {
		//echo "<h2>test locked content</h2>";
		echo stripslashes(pmpro_getOption("notloggedintext"));
	}
}



//* This file handles single entries, but only exists for the sake of child theme forward compatibility.
genesis();
