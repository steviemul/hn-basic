var path = require('path');
var webpack = require('webpack');

module.exports = {
  entry: {
    index: "./index.js"
  },
  output: {
    path: path.resolve('./dist/js/'),
    filename: "[name].js"
  },
  resolve: {
    modules : ['node_modules']
  },
  module: {
    loaders: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    })
  ]
};
