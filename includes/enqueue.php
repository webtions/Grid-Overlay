<?php
/**
 * Enqueue and render the frontend grid overlay.
 *
 * @package Figma_Grid_Overlay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the inline grid overlay styles if the plugin is enabled.
 */
function fgo_enqueue_overlay_assets() {
	$settings = get_option( 'fgo_settings' );

	if ( empty( $settings['enabled'] ) ) {
		return;
	}

	add_action( 'wp_footer', 'fgo_output_grid_overlay_div' );

	// Register a virtual stylesheet to hold inline styles, with version to prevent caching issues.
	wp_register_style( 'fgo-overlay', false, [], FGO_PLUGIN_VERSION );
	wp_enqueue_style( 'fgo-overlay' );
	wp_add_inline_style( 'fgo-overlay', fgo_generate_grid_css( $settings ) );
}
add_action( 'wp_enqueue_scripts', 'fgo_enqueue_overlay_assets' );

/**
 * Output the overlay div in the footer.
 */
function fgo_output_grid_overlay_div() {
	echo '<div class="fgo-grid-overlay"></div>';
}

/**
 * Generate inline CSS for all screen sizes based on saved settings.
 *
 * @param array $settings Grid settings from the plugin options.
 * @return string CSS string.
 */
function fgo_generate_grid_css( $settings ) {
	if ( empty( $settings ) ) {
		return '';
	}

	$css  = ".fgo-grid-overlay {\n";
	$css .= "	position: fixed;\n";
	$css .= "	top: 0;\n";
	$css .= "	left: 0;\n";
	$css .= "	right: 0;\n";
	$css .= "	bottom: 0;\n";
	$css .= "	pointer-events: none;\n";
	$css .= "	z-index: 9999;\n";
	$css .= "	will-change: transform;\n";
	$css .= "	-webkit-transform: translate3d(0, 0, 0);\n";
	$css .= "	-webkit-backface-visibility: hidden;\n";
	$css .= fgo_gradient_css( $settings['mobile'] ) . "\n";
	$css .= "}\n";

	foreach ( [ 'tablet', 'desktop', 'extended' ] as $key ) {
		$data = $settings[ $key ];
		if ( ! empty( $data['enabled'] ) && ! empty( $data['min_width'] ) ) {
			$min = intval( $data['min_width'] );
			$css .= "@media (min-width: {$min}px) {\n";
			$css .= "	.fgo-grid-overlay {\n";
			$css .= fgo_gradient_css( $data ) . "\n";
			$css .= "	}\n";
			$css .= "}\n";
		}
	}

	return $css;
}

/**
 * Generate the gradient and margin styles for a given breakpoint.
 *
 * @param array $data Screen settings for a single breakpoint.
 * @return string CSS declarations.
 */
function fgo_gradient_css( $data ) {
	$cols         = intval( $data['columns'] );
	$gutter       = intval( $data['gutter'] );
	$margin       = intval( $data['outer_margin'] );
	$column_width = "(100vw - " . ( 2 * $margin ) . "px - " . ( $cols - 1 ) . " * " . $gutter . "px) / " . $cols;

	return "	background: repeating-linear-gradient(
		90deg,
		rgba(255, 0, 0, 0.1),
		rgba(255, 0, 0, 0.1) calc($column_width),
		transparent calc($column_width),
		transparent calc($column_width + {$gutter}px)
	);
	margin: 0 {$margin}px;";
}