const mix = require('laravel-mix')
const WebpackShellPlugin = require('webpack-shell-plugin')
const path = require('path')
const tailwindcss = require('tailwindcss')
const cssImport = require('postcss-import')
const cssNesting = require('postcss-nesting')

mix.js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css/app.css')
  .options({
    postCss: [
      cssImport(),
      cssNesting(),
      tailwindcss('tailwind.config.js'),
    ],
  })
  .webpackConfig({
    output: {
      chunkFilename: 'js/[name].js?id=[chunkhash]',
    },
    plugins: [
      new WebpackShellPlugin({
        onBuildStart: ['php artisan ziggy:generate resources/js/routes.js'],
      }),
    ],
    resolve: {
      alias: {
        vue$: 'vue/dist/vue.runtime.esm.js',
        ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js'),
        '@': path.resolve('resources/js'),
      },
    },
  })
  .version()
  .sourceMaps()
