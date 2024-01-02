const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')

module.exports = {
    mode: 'development',
    entry: {
        main: path.resolve(__dirname, './frontend/src/index.js'),
    },

    output: {
        path: path.resolve(__dirname, './frontend/dist'),
        filename: '[name].bundle.js',
    },

    plugins: [
        new HtmlWebpackPlugin({
            title: 'webpack Boilerplate',
            template: path.resolve(__dirname, './frontend/src/index.html'), 
            filename: 'index.html',
        }),

        new HtmlWebpackPlugin({
            title: 'webpack Boilerplate',
            template: path.resolve(__dirname, './frontend/src/pages/myPage.html'), 
            filename: 'myPage.html',
        }),

        new HtmlWebpackPlugin({
            title: 'webpack Boilerplate',
            template: path.resolve(__dirname, './frontend/src/pages/allTweet.html'), 
            filename: 'allTweet.html',
        }),
    ],

    module: {
        rules: [
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },
        ],
    },

    devServer: {
        static: {
            directory: path.join(__dirname, './frontend/dist'),
          }, 
        compress: true, 
        port: 9000,
        open: true,
        proxy: {
            '/api': 'http://localhost:8080',
          },
        
      },
}