const mix = require('laravel-mix');

mix.sass('resources/sass/guest/guest.scss', 'public/assets/css')
    .sass('resources/sass/main/main.scss', 'public/assets/css')
    .postCss('resources/css/auth.css', 'public/assets/css')
    .js('resources/js/project/index.js', 'public/assets/js/project')
    .js('resources/js/todoTask/index.js', 'public/assets/js/todoTask')
    .js('resources/js/board/index.js', 'public/assets/js/board')
    .js('resources/js/boardTask/index.js', 'public/assets/js/boardTask')
    .browserSync('mykanban.loc');
