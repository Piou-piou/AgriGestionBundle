var Encore = require('@symfony/webpack-encore');
const path = require('path');
var glob = require('glob');
const ProgressBarPlugin = require('progress-bar-webpack-plugin');

Encore
.disableSingleRuntimeChunk()
.cleanupOutputBeforeBuild()
.setOutputPath('./Resources/public/')
.setPublicPath('/bundles/agrigestion')
.setManifestKeyPrefix('bundles/agrigestion')


// ----------------------  JS --------------------------------------//
.addEntry('js/main', [
  './assets/js/main.js',
])


// ----------------------  CSS --------------------------------------//


// ----------------------  Other configs --------------------------------------//

.addPlugin(new ProgressBarPlugin())

.addLoader({
  test: /\.js$/,
  exclude: /node_modules/,
  include: [
    path.join(__dirname, 'node_modules/ribs-core/'),
    path.join(__dirname, 'assets/'),
  ],
  loader: 'babel-loader',
})

.enableSassLoader()

.enableSourceMaps(!Encore.isProduction());

module.exports = Encore.getWebpackConfig();
