const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    fontFamily: {
      primary: ['Catamaran', '"M PLUS 1p"', ...defaultTheme.fontFamily.sans],
      sans: ['Lato', '"M PLUS 1p"', ...defaultTheme.fontFamily.sans],
      serif: [...defaultTheme.fontFamily.serif],
      mono: [...defaultTheme.fontFamily.mono]
    },
    extend: {},
  },
  variants: {
    extend: {
      brightness: ['dark'],
      display: ['group-hover'],
      opacity: ['disabled'],
    },
    scrollbar: ['dark'],
    scrollSnapType: ['responsive']
  },
  plugins: [
    require('tailwind-scrollbar'),
    require('tailwindcss-scroll-snap')
  ],
}
