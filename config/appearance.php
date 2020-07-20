<?php
/**
 * TA Twenty appearance settings.
 *
 * @package TA Twenty
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

$ta_twenty_default_colors = [
	'link'   => '#0073e5',
	'accent' => '#0073e5',
];

$ta_twenty_link_color = get_theme_mod(
	'ta_twenty_link_color',
	$ta_twenty_default_colors['link']
);

$ta_twenty_accent_color = get_theme_mod(
	'ta_twenty_accent_color',
	$ta_twenty_default_colors['accent']
);

$ta_twenty_link_color_contrast   = ta_twenty_color_contrast( $ta_twenty_link_color );
$ta_twenty_link_color_brightness = ta_twenty_color_brightness( $ta_twenty_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $ta_twenty_link_color,
	'button-color'         => $ta_twenty_link_color_contrast,
	'button-outline-hover' => $ta_twenty_link_color_brightness,
	'link-color'           => $ta_twenty_link_color,
	'default-colors'       => $ta_twenty_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'ta-twenty' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $ta_twenty_link_color,
		],
		[
			'name'  => __( 'Accent color', 'ta-twenty' ),
			'slug'  => 'theme-secondary',
			'color' => $ta_twenty_accent_color,
		],
	],
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
