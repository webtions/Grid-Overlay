=== Grid Overlay Figma-Style ===
Contributors: hchouhan
Tags: figma, grid, overlay, alignment, columns
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.1.0
License: GPL-3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

Visually check if your layout matches your design by overlaying a responsive grid on the frontend — inspired by Figma’s layout grid system.

== Description ==

This plugin allows designers and developers to overlay a Figma-style layout grid on the frontend of their WordPress site to visually test alignment and spacing. It's useful for responsive design testing and pixel-perfect comparisons to your original designs.

- Enable or disable the grid overlay at any time
- Configure separate values for Mobile, Tablet, Desktop, and Extended screens
- Set number of columns, gutter width, and outer margin
- Lightweight and clean — outputs only what’s needed

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/grid-overlay/`
2. Activate the plugin through the “Plugins” menu
3. Go to **Settings → Grid Overlay** and configure your options

== Frequently Asked Questions ==

= Will the grid show for visitors? =
Yes — the overlay appears on the frontend when enabled. You can disable it anytime from the settings page.

= Can I restrict the overlay to admin users only? =
This version shows the grid for everyone if enabled. A future update might include visibility filters.

== Screenshots ==

1. Settings screen with per-screen options

== Changelog ==

= 1.1.0 =
* Major improvement: Refactored the frontend grid overlay to use real DOM-based columns instead of a repeating background gradient.
* The new DOM-based method improves alignment accuracy by adjusting for scrollbar width differences (using corrected 100vw calculations).
* This change resolves longstanding inconsistencies when aligning layouts against the grid across different browsers and screen sizes.

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
First stable release.
