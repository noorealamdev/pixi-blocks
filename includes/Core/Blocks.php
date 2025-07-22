<?php
/**
 * Blocks class for Pixi Blocks.
 *
 * @package PixiBlocks
 */

namespace PixiBlocks\Core;

use PixiBlocks\Blocks\AbstractBlock;

/**
 * Class Blocks
 */
class Blocks {

    /**
     * Register all blocks.
     */
    public static function register_blocks() {
        $block_classes = glob( PIXIBLOCKS_PLUGIN_DIR . 'includes/Blocks/*.php' );

        foreach ( $block_classes as $block_class_file ) {
            $class_name = basename( $block_class_file, '.php' );

            // Skip AbstractBlock itself.
            if ( 'AbstractBlock' === $class_name ) {
                continue;
            }

            $full_class_name = 'PixiBlocks\\Blocks\\' . $class_name;

            if ( class_exists( $full_class_name ) ) {
                $block_instance = new $full_class_name();
                if ( $block_instance instanceof AbstractBlock ) {
                    $block_instance->register();
                }
            }
        }
    }
}