<?php
/**
 * TA Twenty.
 *
 * Onboarding config to load plugins and homepage content on theme activation.
 *
 * @package TA Twenty
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

$ta_twenty_shared_content = genesis_get_config( 'onboarding-shared' );

return [
	'starter_packs' => [
		'black-white' => [
			'title'       => __( 'Black & White', 'ta-twenty' ),
			'description' => __( 'A pack with a homepage designed with black and white images.', 'ta-twenty' ),
			'thumbnail'   => get_stylesheet_directory_uri() . '/config/import/images/thumbnails/home-black-white.jpg',
			'demo_url'    => 'https://demo.studiopress.com/ta-twenty/',
			'config'      => [
				'dependencies'     => [
					'plugins' => $ta_twenty_shared_content['plugins'],
				],
				'content'          => array_merge(
					[
						'homepage' => [
							'post_title'     => 'Homepage',
							'post_content'   => require dirname( __FILE__ ) . '/import/content/home-black-white.php',
							'post_type'      => 'page',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'ping_status'    => 'closed',
							'meta_input'     => [
								'_genesis_layout'     => 'full-width-content',
								'_genesis_hide_title' => true,
								'_genesis_hide_breadcrumbs' => true,
								'_genesis_hide_singular_image' => true,
							],
						],
					],
					$ta_twenty_shared_content['content']
				),
				'navigation_menus' => $ta_twenty_shared_content['navigation_menus'],
				'widgets'          => $ta_twenty_shared_content['widgets'],
			],
		],
		'color'       => [
			'title'       => __( 'Color', 'ta-twenty' ),
			'description' => __( 'A pack with a homepage designed with color images.', 'ta-twenty' ),
			'thumbnail'   => get_stylesheet_directory_uri() . '/config/import/images/thumbnails/home-color.jpg',
			'demo_url'    => 'https://demo.studiopress.com/ta-twenty/home-color/',
			'config'      => [
				'dependencies'     => [
					'plugins' => $ta_twenty_shared_content['plugins'],
				],
				'content'          => array_merge(
					[
						'homepage' => [
							'post_title'     => 'Homepage',
							'post_content'   => require dirname( __FILE__ ) . '/import/content/home-color.php',
							'post_type'      => 'page',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'ping_status'    => 'closed',
							'meta_input'     => [
								'_genesis_layout'     => 'full-width-content',
								'_genesis_hide_title' => true,
								'_genesis_hide_breadcrumbs' => true,
								'_genesis_hide_singular_image' => true,
							],
						],
					],
					$ta_twenty_shared_content['content']
				),
				'navigation_menus' => $ta_twenty_shared_content['navigation_menus'],
				'widgets'          => $ta_twenty_shared_content['widgets'],
			],
		],
	],
];
