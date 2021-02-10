const mix = require('laravel-mix');

mix.sass('resources/sass/guest/guest.scss', 'public/assets/css')
    .sass('resources/sass/main/main.scss', 'public/assets/css')
    .postCss('resources/css/auth.css', 'public/assets/css')
    .js('resources/js/projects.js', 'public/assets/js')
    .js('resources/js/todo.js', 'public/assets/js')
    .browserSync('mykanban.loc');