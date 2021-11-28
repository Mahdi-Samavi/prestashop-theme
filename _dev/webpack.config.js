/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
var path = require('path');
var webpack = require('webpack');
var MiniCssExtractPlugin = require('mini-css-extract-plugin');
var OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');

var plugins = [
  new MiniCssExtractPlugin({
	filename: '../css/theme.css'
  }),
  new OptimizeCSSAssetsPlugin({
	cssProcessor: require('cssnano'),
	cssProcessorPluginOptions: {
        preset: ['advanced', { discardComments: { removeAll: true } }],
    },
  })
];

module.exports = [{
  mode: 'production',
  // JavaScript
  entry: [
    './js/theme.js',
    './css/theme.scss'
  ],
  output: {
    path: path.resolve(__dirname, '../assets/js'),
    filename: 'theme.js'
  },
  module: {
    rules:  [{
      test: /\.js$/,
      exclude: /node_modules/,
      use: 'babel-loader'
    }, {
      test: /\.(sa|sc)ss$/,
      use: [
	    MiniCssExtractPlugin.loader,
		'css-loader',
		'postcss-loader',
		'sass-loader',
	  ]
    }, {
	  test: /\.less$/,
	  use: [
	    MiniCssExtractPlugin.loader,
	    'css-loader',
		'postcss-loader',
		'less-loader'
	  ]
	}, {
      test: /\.styl$/,
      use: [
		MiniCssExtractPlugin.loader,
		'postcss-loader'
	  ]
    }, {
	  test: /\.css$/,
	  use: [
	    MiniCssExtractPlugin.loader,
		'css-loader',
		'postcss-loader'
	  ]
	}, {
      test: /.(png|woff(2)?|eot|ttf|svg|jpg)(\?[a-z0-9=\.]+)?$/,
      use: 'file-loader?name=../img/[hash].[ext]'
    }]
  },
  devtool: 'source-map',
  externals: {
    prestashop: 'prestashop',
    $: '$',
    jquery: 'jQuery'
  },
  plugins: plugins,
  resolve: {
    extensions: ['.js', '.scss', '.styl', '.less', '.css']
  }
}];
