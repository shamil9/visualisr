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

mix.js('resources/assets/js/app.js', 'public/assets/js')
if (mix.config.inProduction) {
    mix.version()
}
mix.js('resources/assets/js/admin.js', 'public/assets/js').extract(['vue', 'vue-bulma-rating', 'axios'])
mix.sass('resources/assets/sass/app.scss', 'public/assets/css')
if (mix.config.inProduction) {
    mix.version()
}
mix
    .sass('resources/assets/sass/vendor.scss', 'public/assets/css')
    .options({ processCssUrls: false })
    .sass('resources/assets/sass/admin.scss', 'public/assets/css')
    .options({ processCssUrls: false })
    .copyDirectory('resources/assets/img/', 'public/assets/img')
    .copy('node_modules/font-awesome/fonts/*.*', 'public/assets/fonts')
    .copy('resources/assets/fonts/*.*', 'public/assets/fonts')
    .copy('resources/user.svg', 'public/uploads/avatars')
