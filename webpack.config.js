const path = require('path')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')

const { NODE_ENV = 'development' } = process.env

const config = {
    context: __dirname,
    entry: './src/main.ts',
    mode: 'development',
    output: {
        filename: '[name].js',
        chunkFilename: '[id].js',
        path: path.resolve(__dirname, 'dist'),
    },
    target: 'node',
    module: {
        rules: [
            {
                test: /\.(t|m?j)sx?$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        cacheDirectory: true,
                        presets: [
                            [
                                '@babel/preset-env',
                                {
                                    targets: 'current node',
                                    useBuiltIns: 'usage',
                                    corejs: 3,
                                },
                            ],
                            '@babel/preset-typescript',
                        ],
                        plugins: [
                            '@babel/proposal-class-properties',
                            '@babel/proposal-object-rest-spread',
                            '@babel/plugin-proposal-numeric-separator',
                        ],
                    },
                },
            },
        ],
    },
    resolve: {
        extensions: ['.tsx', '.ts', '.js'],
    },
    plugins: [new CleanWebpackPlugin()],
    stats: {
        modules: false,
    },
}

if (NODE_ENV === 'development') {
    console.log('in dev')
    config.output.devtoolModuleFilenameTemplate = '/[absolute-resource-path]'
}

module.exports = config
