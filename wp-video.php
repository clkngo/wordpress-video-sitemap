<?php
/*
Plugin Name: WordPress Video Sitemap

Version: 0.0.2

Plugin URI: http://www.clkngo.com/wordpress/video/#utm_source=wpadmin&utm_medium=plugin&utm_campaign=wpseoplugin

Description: This plugin is an addon to Yoast's Wordpress SEO plugin to create a video sitemap. You
must install Yoast's SEO plugin and enable sitemaps for this addon to work. If you want to use Yoast's
video addon, please visit his site at buy it from him.

Author: Howard Young

Author URI: https://plus.google.com/u/0/101585516583676614007/

License: GPL v3

WordPress Video Sitemap Plugin
Copyright (C) 2013, ClknGo Software Corporation - hyoung@clkngo.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * @package Main
 * 
 * This plugin uses 'wpvid' as a prefix to function and object names to prevent
 * collisions with other plugins.
 * 
 * TODO: Include other video's other than youtube.
 */

/**
 * Prevent running script without going through WordPress
 */
if ( !defined( 'DB_NAME' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

define ( 'WPVID_VERSION', '0.0.1' );

if ( !defined( 'WPVID_PATH' ) )
	define( 'WPVID_PATH', plugin_dir_path( __FILE__ ) );


/**
 *  wpvid_view_init - view processing. Enabled only during non-admin frontend processing.
 */
function wpvid_view_init() {
	require WPVID_PATH . 'include/wpvid-functions.php';
}

if ( is_admin() ) {
// No admin right now so nothing to install...
} 
else {
	// Because this is an addon to Yoast's Wordpress SEO, this plugin must
	// load after the sitemap object ($wpseo_sitemaps) is instantiated.

	add_action( 'plugins_loaded', 'wpvid_view_init', 16 );
}
?>
