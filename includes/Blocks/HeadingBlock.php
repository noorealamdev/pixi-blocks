<?php
/**
 * Heading Block class for Pixi Blocks.
 *
 * @package PixiBlocks
 */

namespace PixiBlocks\Blocks;

/**
 * Class HeadingBlock
 */
class HeadingBlock extends AbstractBlock {

    protected $name = 'heading';

    protected $default_attributes = [
        'content' => [
            'type' => 'string',
            'default' => 'Heading Text PHP',
        ],
        'level' => [
            'type' => 'number',
            'default' => 2,
        ],
        'textAlign' => [
            'type' => 'string',
            'default' => 'left',
        ],
    ];

    /**
     * HeadingBlock constructor.
     */
    public function __construct() {
        parent::__construct(
            $this->name,
            [
                'attributes'      => $this->default_attributes,
                'render_callback' => [$this, 'render_block'],
            ]
        );
    }

    /**
     * Render the block on the server.
     *
     * @param array $attributes The block attributes.
     * @return string The rendered block HTML.
     */
    public function render_block( $attributes ) {

	    $level   = isset( $attributes['level'] ) ? $attributes['level'] : 2;
	    $content = isset( $attributes['content'] ) ? $attributes['content'] : '';
	    $align   = isset( $attributes['textAlign'] ) ? $attributes['textAlign'] : 'left';

        ob_start();
		?>
	    <h<?php echo esc_attr( $level ); ?> class="pixi-heading-php" style="text-align: <?php echo esc_attr( $align ); ?>">
		    <?php echo wp_kses_post( $content ); ?>
	    </h<?php echo esc_attr( $level ); ?>>

		<?php
        return ob_get_clean();
    }
}
