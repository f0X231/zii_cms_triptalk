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
// All
mix.js([
    'resources/js/fontawesome.all.js',
    'resources/js/app.js'
], 'public/assets/js/app.js').version();
mix.styles([
    'resources/css/bootstrap.css',
    'resources/css/portal.css'
], 'public/assets/css/styles.css').version();
mix.postCss('public/assets/css/styles.css', 'public/assets/css/styles.css', [
    //
]);

// mix.postCss('public/css/styles.css', 'public/css/styles.css', [
//     require('autoprefixer') ({
//         overrideBrowserslist: ['> 0.4%', 'last 6 versions', 'Firefox >= 20', 'Android >= 4', 'iOS >=7']
//     })
// ]);
// mix.js('resources/js/app.js', 'public/assets/js')
//     .postCss('resources/css/app.css', 'public/assets/css', [
//         //
//     ]);
