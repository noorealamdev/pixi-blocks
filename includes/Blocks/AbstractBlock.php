<?php
/**
 * Abstract Block class for Pixi Blocks.
 *
 * @package PixiBlocks
 */

namespace PixiBlocks\Blocks;

/**
 * Abstract Class AbstractBlock
 */
abstract class AbstractBlock {

    /**
     * Block name.
     *
     * @var string
     */
    protected $name;

    /**
     * Block arguments.
     *
     * @var array
     */
    protected $args = array();

    /**
     * AbstractBlock constructor.
     * @param string $name Block name.
     * @param array $args Block arguments.
     */
    public function __construct( $name, $args = array() ) {
        $this->name = $name;
        $this->args = $args;
    }

    /**
     * Register the block.
     */
    public function register() {
        register_block_type( PIXIBLOCKS_PLUGIN_DIR . 'build/blocks/' . $this->name, $this->args );
    }

    /**
     * Get block name.
     *
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Get block arguments.
     *
     * @return array
     */
    public function get_args() {
        return $this->args;
    }
}