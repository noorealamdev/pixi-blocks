import { createElement } from '@wordpress/element';
import { createRoot } from '@wordpress/element';
import { ToolbarButton, SVG, Path } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

// Your button component (now rendering ToolbarButton)
const DesignLibraryToolbarButton = () => {
	const handleClick = () => {
		if (window.pixiBlocks && window.pixiBlocks.openDesignLibraryModal) {
			window.pixiBlocks.openDesignLibraryModal();
		}
	};

	return createElement(
		ToolbarButton,
		{
			className: 'pixi-blocks-design-library-button',
			label: __( 'Pixi Design Library', 'pixi-blocks' ),
			icon: createElement(
				SVG,
				{ width: '24', height: '24', viewBox: '0 0 24 24', xmlns: 'http://www.w3.org/2000/svg', 'aria-hidden': 'true', focusable: 'false' },
				createElement(Path, { d: 'M12 4c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 14c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zM11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4z' })
			),
			onClick: handleClick,
			key: 'design-library-toolbar-button',
		}
	);
};

if (window.wp && window.wp.domReady) {
	window.wp.domReady(() => {
		const targetNode = document.body;
		const config = { childList: true, subtree: true };

		const renderToolbarButton = (observer) => {
			const editorHeaderToolbar = document.querySelector('.editor-header__toolbar');

			if (editorHeaderToolbar) {
				const innerToolbarContainer = editorHeaderToolbar.querySelector('.editor-document-tools__left');

				if (innerToolbarContainer) {
					if (!innerToolbarContainer.querySelector('.pixi-blocks-toolbar-button-wrapper')) {

						const buttonWrapper = document.createElement('div');
						buttonWrapper.className = 'pixi-blocks-toolbar-button-wrapper';

						innerToolbarContainer.appendChild(buttonWrapper);

						const root = createRoot(buttonWrapper);
						root.render(createElement(DesignLibraryToolbarButton));

						buttonWrapper.dataset.pixiBlocksToolbarButtonRendered = 'true';

						if (observer) observer.disconnect();
						return true;
					}
				}
			}
			return false;
		};

		if (renderToolbarButton(null)) {
			return;
		}

		const observer = new MutationObserver((mutationsList, observerInstance) => {
			if (renderToolbarButton(observerInstance)) {
			}
		});
		observer.observe(targetNode, config);
	});

} else {

	console.warn('wp.domReady is not available. The toolbar button may not be injected.');

}
