const path = require('path')
const webpack = require('webpack')

module.exports = {
    context: __dirname,
    // entry: [1, 2, 3, 4, 5, 6, 7, 8].map(e => `./src/day${e}/day${e}.ts`),
    entry: './src/main.ts',
    mode: 'development',
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'dist'),
    },
    target: 'node',
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            },
        ],
    },
    resolve: {
        extensions: ['.tsx', '.ts', '.js'],
    },
    plugins: [
        new webpack.BannerPlugin({ banner: '#!/usr/bin/env node', raw: true }),
    ],
}
