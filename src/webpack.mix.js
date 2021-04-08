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

mix.copyDirectory("resources/images", "public/images");

mix.sass("resources/sass/stage/style.scss", "public/css/stage.style.css");

mix.js("resources/js/stage/app.js", "public/js/stage.app.js").extract();
mix.js("resources/js/vendor/app.js", "public/js/vendor.app.js").extract();

