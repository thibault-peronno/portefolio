/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php, htm}"],
  theme: {
    colors: {
      'primary': '#d8e8f3',
      'title': '#3d5a80',
      'white': '#ffffff',
      'black': '#000000',
      'btn-sec': '#293241',
    },
    fontFamily: {
      sans: ['Rubik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {},
  },
  plugins: [],
}

