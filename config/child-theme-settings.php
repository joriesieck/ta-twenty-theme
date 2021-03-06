<?php
/**
 * TA Twenty theme settings.
 *
 * Genesis 2.9+ updates these settings when themes are activated.
 *
 * @package TA Twenty
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

return [
	GENESIS_SETTINGS_FIELD => [
		'blog_cat_num'              => 6,
		'breadcrumb_home'           => 0,
		'breadcrumb_front_page'     => 0,
		'breadcrumb_posts_page'     => 0,
		'breadcrumb_single'         => 0,
		'breadcrumb_page'           => 0,
		'breadcrumb_archive'        => 1, /* js edit - was 0 */
		'breadcrumb_404'            => 0,
		'breadcrumb_attachment'     => 0,
		'content_archive'           => 'excerpts',	/* js edit - was full */
		'content_archive_limit'     => 150,
		'content_archive_thumbnail' => 1,	/* js edit - was 0 */
		'entry_meta_after_content'  => '[post_categories] [post_tags]',
		'entry_meta_before_content' => '[post_date] ' . __( 'by', 'ta-twenty' ) . ' [post_author_posts_link] [post_comments] [post_edit]',
		'image_size'                => 'thumbnail',	/* js edit - was genesis-singular-images */
		'image_alignment'           => 'alignleft',	/* js edit - was aligncenter */
		'posts_nav'                 => 'numeric',
		'site_layout'               => 'full-width-content',	/* js edit - was content-sidebar */
	],
	'posts_per_page'       => 11,	/* js edit - was 6 */

];
