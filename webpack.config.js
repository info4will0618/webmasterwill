
var webpack = require('webpack');

var path = require('path');

var inProduction = (process.env.Node_ENV === 'production');

var ExtractTextPlugin = require("extract-text-webpack-plugin");

var CopyWebpackPlugin = require('copy-webpack-plugin');

var ImageminPlugin = require('imagemin-webpack-plugin').default

module.exports = {

	entry: ['./assets/js/main.js', './assets/sass/imports.sass'],
	output: {

		path: path.resolve(__dirname, 'public/dist'),

		//name of file

		filename: 'bundle.js',

	},

	module: {
        rules: [
	        {
	            test: /\.s[ac]ss$/,
	            use: ExtractTextPlugin.extract({
	          		fallback: 'style-loader',
						use: [
							{
								loader: 'css-loader',
								options: {
								// If you are having trouble with urls not resolving add this setting.
								// See https://github.com/webpack-contrib/css-loader#url
								url: false,
								minimize: true,
								sourceMap: true
								}
							}, 
							{
								loader: 'sass-loader',
								options: {
								sourceMap: true
								}
							}
						]
	        	})
	        },
	        {
		        test: /\.(jpe?g|png|gif)$/,
		        loader: 'url-loader',
		        options: {
		          // Images larger than 10 KB won’t be inlined
		          limit: 10 * 1024
	        }
	      },
	      {
	        test: /\.svg$/,
	        loader: 'svg-url-loader',
	        options: {
	          // Images larger than 10 KB won’t be inlined
	          limit: 10 * 1024,
	          // Remove quotes around the encoded URL –
	          // they’re rarely useful
	          noquotes: true,
	        }
	      },
	      {
	        test: /\.(jpg|png|gif|svg)$/,
	        loader: 'image-webpack-loader',
	        // Specify enforce: 'pre' to apply the loader
	        // before url-loader/svg-url-loader
	        // and not duplicate it in rules with them
	        enforce: 'pre'
	      }
        ]
    },

	plugins: [

		new ExtractTextPlugin("styles.css"),
		new CopyWebpackPlugin([
            {from:'assets/imgs', to:'imgs'} 
        ]),
        new ImageminPlugin({ test: /\.(jpe?g|png|gif|svg)$/i })
	]
};

if (inProduction) {
	module.exports.plugins.push(
		new webpack.optimize.UglifyJsPlugin()
	);
}