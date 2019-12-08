const path = require('path')

module.exports = {
    context: __dirname,
    entry: './src/main.ts',
    mode: 'development',
    output: {
        filename: '[name].js',
        chunkFilename: '[id].js',
        path: path.resolve(__dirname, 'dist'),
    },
    devtool: 'inline-source-map',
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
}
