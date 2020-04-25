const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
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
