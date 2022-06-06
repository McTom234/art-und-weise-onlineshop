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


mix.js('resources/js/cookies.js', 'public/js')
    .js('resources/js/products.js', 'public/js')
    .js('resources/js/quantitySelect.js', 'public/js')
    .js('resources/js/shoppingCart.js', 'public/js')
    .js('resources/js/privacy.js', 'public/js')
    .sass('resources/scss/home.scss', 'public/css')
    .sass('resources/scss/user-forms.scss', 'public/css')
    .sass('resources/scss/products-overview.scss', 'public/css')
    .sass('resources/scss/buy.scss', 'public/css')
    .sass('resources/scss/ordered.scss', 'public/css')
    .sass('resources/scss/shoppingCart.scss', 'public/css')
    .sass('resources/scss/showProduct.scss', 'public/css')
    .options({
        postCss: [ require('tailwindcss')('./tailwind.config.js') ]
    })
    .version()
    .browserSync('localhost:8000')
    .disableSuccessNotifications();
