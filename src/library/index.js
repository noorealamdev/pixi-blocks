import { useState } from '@wordpress/element';
import DesignLibraryModal from './design-library/modal';
import './library.scss';
import './toolbar-button';

let openModal;
let closeModal;

const PixiBlocksDesignLibrary = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);

    openModal = () => setIsModalOpen(true);
    closeModal = () => setIsModalOpen(false);

    return (
        <>
            {isModalOpen && (
                <DesignLibraryModal
                    isOpen={isModalOpen}
                    onClose={closeModal}
                />
            )}
        </>
    );
};

// This is a workaround to expose openModal and closeModal globally
// so that toolbar-button.js can access them.
window.pixiBlocks = {
    openDesignLibraryModal: () => openModal(),
    closeDesignLibraryModal: () => closeModal(),
};


// We still need to register the plugin to render the modal component.
import { registerPlugin } from '@wordpress/plugins';
registerPlugin('pixi-blocks-design-library', {
    render: PixiBlocksDesignLibrary,
});
