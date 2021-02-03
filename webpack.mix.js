const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/assets/css')
    .postCss('resources/css/auth.css', 'public/assets/css')
    .postCss('resources/css/homepage.css', 'public/assets/css');