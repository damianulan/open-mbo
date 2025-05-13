// webpack.mix.js

let mix = require("laravel-mix");
require("laravel-mix-string-replace");
require("dotenv").config();

const locale = process.env.APP_LOCALE;
const replace_js = {
    test: /\.js$/,
    loader: "string-replace-loader",
    options: {
        search: "ENV_LOCALE",
        replace: JSON.stringify(locale),
    },
};

mix.webpackConfig((webpack) => {
    return {
        plugins: [],
    };
});

// misc
mix.copyDirectory("resources/themes/vendors", "public/themes/vendors");
mix.copyDirectory("resources/images", "public/images");
mix.copyDirectory("resources/scripts", "public/scripts");

// base-theme
mix.js("resources/themes/js/app.js", "public/themes/js")
    .stringReplace(replace_js)
    .version();

mix.sass(
    "resources/themes/light/green.scss",
    "public/themes/light-green/app.css"
).version();

mix.sass(
    "resources/themes/light/blue.scss",
    "public/themes/light-blue/app.css"
).version();

mix.sass(
    "resources/themes/light/orchid.scss",
    "public/themes/light-orchid/app.css"
).version();

mix.copy("resources/themes/js/trix.esm.min.js.map", "public/themes/js");
