const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/dist/assets/css/bootstrap.min.css',
    'public/dist/assets/css/style.css',
    'public/dist/assets/css/components.css',
    'public/dist/assets/css/all.css',
    'public/dist/assets/css/custom.css',
], 'public/css/app.css');

mix.scripts([
    'public/dist/assets/js/scripts.js',
    'public/dist/assets/js/custom.js',
    'public/dist/assets/js/stisla.js'
], 'public/js/app-plugin.js');