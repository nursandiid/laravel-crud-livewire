const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/authenticate.js', 'public/js/auth.js')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css/auth.css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config'));
