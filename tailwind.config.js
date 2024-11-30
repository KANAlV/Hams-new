/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'selector',
  content: [
    "./user/*.php",
    "./user/**/*.php",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      screens: {
        'landscape': {
          'raw': '(orientation: landscape)'
        },
      },
      height: {
        '24rem':'24rem'
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

