<?php
/**
 * Plugin Name:       Pixi Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pixi-blocks
 *
 * @package PixiBlocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define plugin constants.
define( 'PIXIBLOCKS_VERSION', '0.1.0' );
define( 'PIXIBLOCKS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PIXIBLOCKS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load the autoloader.
require_once PIXIBLOCKS_PLUGIN_DIR . 'includes/autoloader.php';

// Load the REST API.
require_once PIXIBLOCKS_PLUGIN_DIR . 'includes/class-pixi-blocks-rest-api.php';

// Initialize the plugin.
PixiBlocks\Core\Plugin::get_instance();