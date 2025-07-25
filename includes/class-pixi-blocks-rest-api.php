<?php

class Pixi_Blocks_Rest_Api {

    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

    public function register_routes() {
        register_rest_route( 'pixi-blocks/v1', '/templates',
            array(
                'methods'  => 'GET',
                'callback' => array( $this, 'get_templates' ),
                'permission_callback' => array( $this, 'get_templates_permissions_check' ),
            )
        );
    }

    public function get_templates() {
        $templates = array(
            array(
                'id'      => 1,
                'title'   => 'Template 1',
                'image'   => 'https://via.placeholder.com/300x200',
                'content' => '<!-- wp:heading --><h2>Template 1</h2><!-- /wp:heading -->',
            ),
            array(
                'id'      => 2,
                'title'   => 'Template 2',
                'image'   => 'https://via.placeholder.com/300x200',
                'content' => '<!-- wp:heading --><h2>Template 2</h2><!-- /wp:heading -->',
            ),
            array(
                'id'      => 3,
                'title'   => 'Template 3',
                'image'   => 'https://via.placeholder.com/300x200',
                'content' => '<!-- wp:heading --><h2>Template 3</h2><!-- /wp:heading -->',
            ),
        );

        return new WP_REST_Response( $templates, 200 );
    }

    public function get_templates_permissions_check() {
        return current_user_can( 'edit_posts' );
    }
}

new Pixi_Blocks_Rest_Api();