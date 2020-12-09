const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .copy('resources/js/script.js', 'public/js/script.js')
    .minify('public/js/script.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/style.css', 'public/css/', [
        require('postcss-import')
    ])
    .postCss('resources/css/style_agent.css', 'public/css/', [
        require('postcss-import')
    ])
    .postCss('resources/css/style_client.css', 'public/css/', [
        require('postcss-import')
    ])
    .postCss('resources/css/style_consaltant.css', 'public/css/', [
        require('postcss-import')
    ])
    .postCss('resources/css/style_admin.css', 'public/css/', [
        require('postcss-import')
    ])
    .webpackConfig(require('./webpack.config'));
