import { __ } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import Card from './card';

const Grid = () => {
    const [templates, setTemplates] = useState([]);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        apiFetch({ path: '/pixi-blocks/v1/library-items' }).then((data) => {
            setTemplates(data);
            setIsLoading(false);
        });
    }, []);

    if (isLoading) {
        return <p>{__('Loading templates...', 'pixi-blocks')}</p>;
    }

    return (
        <div className="pixi-blocks-design-library-grid">
            {templates.map((template) => (
                <Card key={template.id} template={template} />
            ))}
        </div>
    );
};

export default Grid;