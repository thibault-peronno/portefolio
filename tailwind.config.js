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
        secondary: '#3d5a80',
        white: '#ffffff',
        black: '#000000',
        'btn-sec': '#293241',
      },
      padding: {
        'dpc': '10%',
        'vpc': '20%',
      },
      keyframes: {
        front: {
          '0%': { opacity: 0 },
          '100%': { opacity: 1},
        },
        back: {
          '0%': { opacity: 0 },
          '100%': { opacity: 1},
        },
        devops: {
          '0%': { opacity: 0 },
          '100%': { opacity: 1},
        }
      },
      animation: {
        front: 'front 5s ease-out 1s forwards',
        back: 'front 5s ease-out 2s forwards',
        devops: 'front 5s ease-out 3s forwards',
      }
    },
  },
  plugins: [
    require('tailwindcss-animation-delay'),
  ],
}

