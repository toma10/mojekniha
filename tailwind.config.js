const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      maxWidth: {
        '10xl': '120rem',
      },
    },
  },
  variants: {
    margin: ['responsive', 'first'],
    backgroundColor: ['responsive', 'hover', 'focus', 'even'],
  },
  plugins: [
    require('@tailwindcss/ui'),
  ],
}
