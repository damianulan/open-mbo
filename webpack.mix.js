// webpack.mix.js

let mix = require('laravel-mix');

mix.webpackConfig(webpack => {
    return {
        plugins: []
    };
});

// misc
mix.copyDirectory('resources/themes/vendors', 'public/themes/vendors');
mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/scripts', 'public/scripts');

// base-theme
mix.js('resources/themes/light/app.js', 'public/themes/light')
    .sass('resources/themes/light/app.scss', 'public/themes/light')
    .copyDirectory('resources/themes/light/images', 'public/themes/light/images')
    .version();
