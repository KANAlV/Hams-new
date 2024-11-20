/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'selector',
  content: [
    "./user/*.php",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      screens: {
        'landscape': {
          'raw': '(orientation: landscape)'
        },
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

