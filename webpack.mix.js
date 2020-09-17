const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.js(
    "node_modules/flatpickr/dist/flatpickr.min.js",
    "public/node_modules/flatpickr/js"
)
    .copy(
        "node_modules/flatpickr/dist/flatpickr.min.css",
        "public/node_modules/flatpickr/css/flatpickr.min.css"
    )
    .js(
        "node_modules/flatpickr/dist/l10n/zh-tw.js",
        "public/node_modules/flatpickr/js"
    );

mix.copyDirectory(
    "node_modules/tinymce/icons",
    "public/node_modules/tinymce/icons"
);
mix.copyDirectory(
    "node_modules/tinymce/plugins",
    "public/node_modules/tinymce/plugins"
);
mix.copyDirectory(
    "node_modules/tinymce/skins",
    "public/node_modules/tinymce/skins"
);
mix.copyDirectory(
    "node_modules/tinymce/themes",
    "public/node_modules/tinymce/themes"
);
mix.copy(
    "node_modules/tinymce/jquery.tinymce.js",
    "public/node_modules/tinymce/jquery.tinymce.js"
);
mix.copy(
    "node_modules/tinymce/jquery.tinymce.min.js",
    "public/node_modules/tinymce/jquery.tinymce.min.js"
);
mix.copy(
    "node_modules/tinymce/tinymce.js",
    "public/node_modules/tinymce/tinymce.js"
);
mix.copy(
    "node_modules/tinymce/tinymce.min.js",
    "public/node_modules/tinymce/tinymce.min.js"
);

mix.js(
    "node_modules/@fortawesome/fontawesome-free/js/all.min.js",
    "public/node_modules/fontawesome-free/js"
);
mix.copy(
    "node_modules/@fortawesome/fontawesome-free/css/all.min.css",
    "public/node_modules/fontawesome-free/css/all.min.css"
);

mix.copyDirectory(
    "node_modules/@fortawesome/fontawesome-free/webfonts/",
    "public/node_modules/fontawesome-free/webfonts"
);

mix.copy(
    "node_modules/jquery/dist/jquery.min.js",
    "public/node_modules/jquery/jquery.min.js"
);

mix.copy(
    "node_modules/jquery-circle-progress/dist/circle-progress.min.js",
    "public/node_modules/jquery-circle-progress/circle-progress.min.js"
);
