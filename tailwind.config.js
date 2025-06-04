/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/**/*.{php,html,js}", // Scan semua file di folder app
    "./public/**/*.{php,html,js}", // Scan semua file di folder public
    ],
  theme: {
    extend: {},
  },
  plugins: [],
}

