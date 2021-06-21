module.exports = {
  purge: [],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      display: ['group-hover'],
    },
    scrollbar: ['dark']
  },
  plugins: [
    require('tailwind-scrollbar')
  ],
}
