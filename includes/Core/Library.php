<?php
/**
 * Library class for Pixi Blocks.
 * Handles custom REST API endpoints for the design library.
 *
 * @package PixiBlocks
 */

namespace PixiBlocks\Core;

/**
 * Class Library
 */
class Library {

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_editor_assets' ] );
    }

    /**
     * Register the REST API routes for the design library.
     */
    public function register_routes() {
        register_rest_route(
            'pixi-blocks/v1',
            '/library-items',
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [ $this, 'get_library_items' ],
                'permission_callback' => [ $this, 'get_library_items_permissions_check' ],
            ]
        );
    }

    /**
     * Callback for the /library-items endpoint.
     * This is where you would fetch data from your remote server.
     *
     * @param \WP_REST_Request $request Full details about the request.
     * @return \WP_REST_Response|\WP_Error Response object on success, or WP_Error object on failure.
     */
    public function get_library_items( \WP_REST_Request $request ) {
        // For now, return dummy data.
        // In a real scenario, you would fetch this from your remote server.
        $items = [
            [
                'id'      => '1',
                'title'   => 'Hero Section 1',
                'content' => '<!-- wp:heading --><h2>Hero Section Title</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Hero section description.</p><!-- /wp:paragraph -->',
                'thumbnail' => 'https://via.placeholder.com/150?text=Hero+1',
                'category' => 'sections',
            ],
            [
                'id'      => '2',
                'title'   => 'Call to Action',
                'content' => '<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --> <div class="wp-block-button"><a class="wp-block-button__link">Call to Action Button</a></div><!-- /wp:button --></div><!-- /wp:buttons -->',
                'thumbnail' => 'https://via.placeholder.com/150?text=CTA',
                'category' => 'sections',
            ],
            [
                'id'      => '3',
                'title'   => 'Simple Card',
                'content' => '<!-- wp:group --><div class="wp-block-group"><div class="wp-block-group__inner-container"><!-- wp:image --><figure class="wp-block-image"><img alt=""/></figure><!-- /wp:image --><!-- wp:heading {"level":3}--><h3>Card Title</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Card description.</p><!-- /wp:paragraph --></div></div><!-- /wp:group -->',
                'thumbnail' => 'https://via.placeholder.com/150?text=Card',
                'category' => 'templates',
            ],
        ];

        return new \WP_REST_Response( $items, 200 );
    }

    /**
     * Checks if a given request has access to get library items.
     *
     * @param \WP_REST_Request $request Full details about the request.
     * @return bool|\WP_Error True if the request has read access, WP_Error object otherwise.
     */
    public function get_library_items_permissions_check( \WP_REST_Request $request ) {
        // Only allow access to logged-in users with 'edit_posts' capability.
        return current_user_can( 'edit_posts' );
    }

    /**
     * Enqueue editor assets.
     */
    public function enqueue_editor_assets() {
        $asset_file = include PIXIBLOCKS_PLUGIN_DIR . 'build/library/index.asset.php';

        wp_enqueue_script(
            'pixi-blocks-library-script',
            PIXIBLOCKS_PLUGIN_URL . 'build/library/index.js',
            $asset_file['dependencies'],
            $asset_file['version'],
            true
        );

	    wp_enqueue_script(
		    'pixi-blocks-toolbar-button-script',
		    PIXIBLOCKS_PLUGIN_URL . 'build/library/toolbar-button.js',
		    $asset_file['dependencies'],
		    $asset_file['version'],
		    true
	    );

        wp_enqueue_style(
            'pixi-blocks-library-style',
            PIXIBLOCKS_PLUGIN_URL . 'build/library/index.css',
            [],
            $asset_file['version']
        );
    }
}
