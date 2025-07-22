<?php
/**
 * Main plugin class for Pixi Blocks.
 *
 * @package PixiBlocks
 */

namespace PixiBlocks\Core;

use PixiBlocks\Core\Blocks;

/**
 * Class Plugin
 */
final class Plugin {

    /**
     * The single instance of the class.
     *
     * @var Plugin
     */
    protected static $instance = null;

    /**
     * Main Plugin Instance.
     *
     * Ensures only one instance of Plugin is loaded or can be loaded.
     *
     * @return Plugin - Main instance.
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Plugin Constructor.
     */
    public function __construct() {
        $this->includes();
        $this->init_hooks();
    }

    

    /**
     * Include required files.
     */
    private function includes() {
        // The autoloader will handle most includes.
    }

    /**
     * Hook into actions and filters.
     */
    private function init_hooks() {
        add_action( 'init', array( Blocks::class, 'register_blocks' ) );
    }
}