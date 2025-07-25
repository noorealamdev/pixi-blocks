import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useSelect, useDispatch } from '@wordpress/data';
import { parse } from '@wordpress/blocks';

const Card = ({ template }) => {
    const { insertBlocks } = useDispatch('core/block-editor');

    const handleInsert = () => {
        const blocks = parse(template.content);
        insertBlocks(blocks);
    };

    return (
        <div className="pixi-blocks-design-library-card">
            <div className="pixi-blocks-design-library-card-image">
                <img src={template.image} alt={template.title} />
            </div>
            <div className="pixi-blocks-design-library-card-content">
                <h3>{template.title}</h3>
                <Button isPrimary onClick={handleInsert}>
                    {__('Insert', 'pixi-blocks')}
                </Button>
            </div>
        </div>
    );
};

export default Card;