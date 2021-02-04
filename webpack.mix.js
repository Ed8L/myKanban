const mix = require('laravel-mix');

mix.sass('resources/sass/guest.scss', 'public/assets/css')
    .postCss('resources/css/auth.css', 'public/assets/css');