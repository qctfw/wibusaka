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
      jp: ['"M PLUS 1p"', ...defaultTheme.fontFamily.serif],
      serif: [...defaultTheme.fontFamily.serif],
      mono: [...defaultTheme.fontFamily.mono]
    },
    extend: {
      animation: {
        blink: 'blink 1s ease-in-out'
      },
      keyframes: {
        blink: {
          '0%, 100%': { opacity: '1' },
          '50%': {opacity: '0'}
        }
      }
    },
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
