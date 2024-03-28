/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php,htm}"],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      'white': '#ffffff',
      'purple': '#3f3cbb',
      'midnight': '#121063',
      'metal': '#565584',
      'tahiti': '#3ab7bf',
      'silver': '#ecebff',
      'bubble-gum': '#ff77e9',
      'bermuda': '#78dcca'
    },
    fontFamily: {
      sans: ['Rubik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      colors: {
        primary: '#d8e8f3',
        title: '#3d5a80',
        white: '#ffffff',
        black: '#000000',
        'btn-sec': '#293241',
      },
    },
  },
  plugins: [],
}

