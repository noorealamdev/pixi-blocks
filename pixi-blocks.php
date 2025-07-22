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
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Registers the block using a `block.json` file, which improves the performance of block type registration.
 * Behind the scenes, it also registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function create_block_pixi_blocks_block_init() {
	$block_json_files = glob( plugin_dir_path( __FILE__ ) . 'src/blocks/*/block.json' );

	foreach ( $block_json_files as $block_json_file ) {
		$block_path = dirname( $block_json_file );
		$block_name = basename( $block_path );
		register_block_type( plugin_dir_path( __FILE__ ) . 'build/blocks/' . $block_name );
	}
}
add_action( 'init', 'create_block_pixi_blocks_block_init' );
