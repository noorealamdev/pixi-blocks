
import { Modal, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import Grid from './grid';

const DesignLibraryModal = ({ isOpen, onClose }) => {
    return (
        <Modal
            title={__('Design Library', 'pixi-blocks')}
            onRequestClose={onClose}
            isOpen={isOpen}
            className="pixi-blocks-design-library-modal"
        >
            <div className="pixi-blocks-design-library-content">
                <div className="pixi-blocks-design-library-header">
                    {/* Add header content here, such as search and filters */}
                </div>
                <Grid />
            </div>
            <div className="pixi-blocks-design-library-footer">
                <Button isPrimary onClick={onClose}>
                    {__('Close', 'pixi-blocks')}
                </Button>
            </div>
        </Modal>
    );
};

export default DesignLibraryModal;
