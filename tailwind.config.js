/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [
    "./application/views/front/**/*.{php,js}",
    "./application/views/layout/*.{php,js}",
    "./application/views/errors/**/*.{php,js}",
    "./public/assets/front/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
