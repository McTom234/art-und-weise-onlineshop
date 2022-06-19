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


require('laravel-mix')
    .ts('resources/js/app.ts', 'public/js')
    .ts('resources/js/shoppingCart.ts', 'public/js')
    .ts('resources/js/products.ts', 'public/js')
    .ts('resources/js/quantitySelect.ts', 'public/js')
    .ts('resources/js/privacy.ts', 'public/js')
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
