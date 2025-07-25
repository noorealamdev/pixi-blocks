<?php
/**
 * Handles custom block categories for Pixi Blocks.
 *
 * @package PixiBlocks
 */

namespace PixiBlocks\Core;

/**
 * Class BlockCategories
 */
class BlockCategories {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'block_categories_all', array( $this, 'register_pixi_block_category' ), 10, 2 );
	}

	/**
	 * Register the custom Pixi Blocks category.
	 *
	 * @param array $categories The list of existing block categories.
	 * @return array The updated list of block categories.
	 */
	public function register_pixi_block_category( $categories ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'pixi-blocks',
					'title' => __( 'Pixi Blocks', 'pixi-blocks' ),
					'icon'  => 'carrot', // You can choose any Dashicon or custom SVG here.
				),
			)
		);
	}
}
