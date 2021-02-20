const mix = require('laravel-mix');

mix.sass('resources/sass/guest/guest.scss', 'public/assets/css')
    .sass('resources/sass/main/main.scss', 'public/assets/css')
    .postCss('resources/css/auth.css', 'public/assets/css')
    .js('resources/js/project/index.js', 'public/assets/js/project')
    .js('resources/js/todoTask/index.js', 'public/assets/js/todoTask')
    .browserSync('mykanban.loc');
