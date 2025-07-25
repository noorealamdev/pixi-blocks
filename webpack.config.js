const path = require('path');
const glob = require('glob');

const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,
    entry: () => {
        const blockEntries = glob.sync('./src/blocks/*/index.js').reduce((acc, blockPath) => {
            const blockName = path.basename(path.dirname(blockPath));
            acc[`blocks/${blockName}/index`] = path.resolve(__dirname, blockPath);
            return acc;
        }, {});

        return {
            ...blockEntries,
            'library/index': path.resolve(__dirname, 'src/library/index.js'),
						'library/toolbar-button': path.resolve(__dirname, 'src/library/toolbar-button.js'),
        };
    },
};
