<?php
/**
 * TA Twenty appearance settings.
 *
 * @package TA Twenty
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

/* js edit - change to ta colors */
$ta_twenty_default_colors = [
	'light-gray' => '#f2f2f2',	// site bg
	'dark-gray' => '#444',	// text
	'super-dark-gray' => '#2a2a2a',	// buttons
	'orange'   => '#e96a2a',	// links
	'green' => '#9DCB2A',	// some buttons & headers
	'red' => '#d91420',	// some buttons
];

$ta_twenty_link_color = get_theme_mod(
	'ta_twenty_link_color',
	$ta_twenty_default_colors['orange']
);

$ta_twenty_button_color = get_theme_mod(
	'ta_twenty_button_color',
	$ta_twenty_default_colors['super-dark-gray']
);

// $ta_twenty_accent_color = get_theme_mod(
// 	'ta_twenty_accent_color',
// 	$ta_twenty_default_colors['accent']
// );

$ta_twenty_link_color_contrast   = ta_twenty_color_contrast( $ta_twenty_link_color );
$ta_twenty_link_color_brightness = ta_twenty_color_brightness( $ta_twenty_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $ta_twenty_button_color,
	'button-color'         => '#fff',
	// 'button-outline-hover' => $ta_twenty_link_color_brightness,
	'link-color'           => $ta_twenty_link_color,
	'default-colors'       => $ta_twenty_default_colors,
	'editor-color-palette' => array(
		array(
			'name'  => 'Red',
			'slug'  => 'red',
			'color' => '#d91420',
		),
		array(
			'name'  => 'Orange',
			'slug'  => 'orange',
			'color' => '#e96a2a',
		),
		array(
			'name'  => 'Green',
			'slug'  => 'green',
			'color' => '#9DCB2A',
		),
		array(
			'name'  => 'Dark Gray',
			'slug'  => 'dark-gray',
			'color' => '#303236',
		),
		array(
			'name'  => 'White',
			'slug'  => 'white',
			'color' => '#fff',
		),
		array(
			'name'  => 'Black',
			'slug'  => 'black',
			'color' => '#000',
		),
	),
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'ta-twenty' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'ta-twenty' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'ta-twenty' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'ta-twenty' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];
