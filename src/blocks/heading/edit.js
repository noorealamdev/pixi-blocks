/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText, InspectorControls, AlignmentControl, BlockControls } from '@wordpress/block-editor';
import { SelectControl } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { content, textAlign, level } = attributes;

	const blockProps = useBlockProps( {
		className: `has-text-align-${ textAlign }`,
	} );

	const TagName = `h${ level }`;

	return (
		<>
			<BlockControls>
				<AlignmentControl
					value={ textAlign }
					onChange={ ( nextAlign ) => setAttributes( { textAlign: nextAlign } ) }
				/>
			</BlockControls>
			<InspectorControls>
				<SelectControl
					label={ __( 'Heading Level', 'pixi-blocks' ) }
					value={ level }
					onChange={ ( newLevel ) => setAttributes( { level: parseInt( newLevel, 10 ) } ) }
					options={ [
						{ label: 'H1', value: 1 },
						{ label: 'H2', value: 2 },
						{ label: 'H3', value: 3 },
						{ label: 'H4', value: 4 },
						{ label: 'H5', value: 5 },
						{ label: 'H6', value: 6 },
					] }
				/>
			</InspectorControls>
			<TagName { ...blockProps }>
				<RichText
					tagName="span" // Use a span to avoid nested headings in editor
					value={ content }
					onChange={ ( newContent ) => setAttributes( { content: newContent } ) }
					placeholder={ __( 'Write heading...', 'pixi-blocks' ) }
				/>
			</TagName>
		</>
	);
}
