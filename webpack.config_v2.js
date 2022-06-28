// webpack.config.js
const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const PATHS = {
    source: path.join(__dirname, 'modules/frontend/src/js'),
    build: path.join(__dirname, 'web')
};

const {VueLoaderPlugin} = require('vue-loader');

module.exports = (env, argv) => {
    let config = {
        production: argv.mode === 'production'
    };

    return {
        mode: 'development',
        entry: [
            './modules/frontend/src/js/app.js'
        ],
        output: {
            path: PATHS.build,
            filename: config.production ? 'assets/inertia/js/app.js' : 'assets/inertia/js/app.js'
        },
        resolve: {
            extensions: ['.js', '.vue', '.json'],
            alias: {
                '@': '/' + path.resolve(__dirname, 'modules/frontend/src/js')
            }
        },
        module: {
            rules: [
                {
                    test: /\.vue$/,
                    use: 'vue-loader'
                },
                {
                    test: /\.css$/,
                    use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader']
                }
            ]
        },
        plugins: [
            new VueLoaderPlugin(),
            new MiniCssExtractPlugin({
                filename: 'assets/inertia/css/[name].css',
                chunkFilename: 'assets/inertia/css/[id].css'
            })
        ]
    };
};
