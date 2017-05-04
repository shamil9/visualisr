const { mix } = require('laravel-mix')

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

mix
    .options({ processCssUrls: false })
    .js('resources/assets/js/app.js', 'public/assets/js')
    .js('resources/assets/js/admin.js', 'public/assets/js')
    .extract(['vue', 'vue-bulma-rating', 'axios'])
    .sass('resources/assets/sass/app.scss', 'public/assets/css')
    .sass('resources/assets/sass/vendor.scss', 'public/assets/css')
    .sass('resources/assets/sass/admin.scss', 'public/assets/css')
    .copy('resources/assets/img/', 'public/assets/img', false)
    .copy('node_modules/font-awesome/fonts/*.*', 'public/assets/fonts')
