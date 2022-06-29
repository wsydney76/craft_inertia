const mix = require('laravel-mix');
const path = require("path");
require('laravel-mix-clean');

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

mix.setPublicPath('web')
    .js("modules/frontend/src/js/app.js", "web/assets/inertia/js")
    .postCss("modules/frontend/src/css/app.css", "web/assets/inertia/css", [
        require("tailwindcss")
    ])
    .vue({version: 3})
    .disableSuccessNotifications()
    .version()
    .clean({
        cleanOnceBeforeBuildPatterns: ['assets/inertia']
    })
;

// New Alias plugin
mix.alias({
    "@": path.resolve("modules/frontend/src/js"),
});
