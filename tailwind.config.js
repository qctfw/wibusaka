module.exports = {
  purge: [],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
    scrollbar: ['dark']
  },
  plugins: [
    require('tailwind-scrollbar')
  ],
}
