// const mix = require('laravel-mix');

// /*
//  |--------------------------------------------------------------------------
//  | Mix Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Mix provides a clean, fluent API for defining some Webpack build steps
//  | for your Laravel application. By default, we are compiling the Sass
//  | file for the application as well as bundling up all the JS files.
//  |
//  */

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css')
//     .js('resources/js/popup.js', 'public/js')
//     .postCss('resources/css/style.css', 'public/css/app.css',[
//         require('tailwindcss')

//     ])

//     .version();
// //jfjfjfjfjfjf

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
   .vue()
   .sass('resources/sass/app.scss', 'public/css')
   .js('resources/js/popup.js', 'public/js')
   .postCss('resources/css/style.css', 'public/css/app.css', [
       require('tailwindcss')
   ])
   .version();

// Adding custom webpack configuration
mix.webpackConfig({
   module: {
       rules: [
           {
               test: /\.vue$/,
               loader: 'vue-loader',
               options: {
                   loaders: {
                       scss: [
                           'vue-style-loader',
                           'css-loader',
                           'sass-loader'
                       ],
                       sass: [
                           'vue-style-loader',
                           'css-loader',
                           'sass-loader?indentedSyntax'
                       ]
                   }
               }
           }
       ]
   }
});
