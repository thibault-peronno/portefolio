/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: "jit",
  content: [
    "./app/views/inc/*.{tpl.php,php}",
    "./app/views/*.{tpl.php,php}",
    "./**/**/*.{tpl.php,php}",
  ],
  theme: {
    colors: {
      transparent: "transparent",
      current: "currentColor",
      white: "#ffffff",
      purple: "#3f3cbb",
      midnight: "#121063",
      metal: "#565584",
      tahiti: "#3ab7bf",
      silver: "#ecebff",
      "bubble-gum": "#ff77e9",
      bermuda: "#78dcca",
      "text-red-900": "#7f1d1d",
      "lime-600": "#65a30d",
      "orange-600": "#ea580c",
    },
    fontFamily: {
      sans: ["Rubik", "sans-serif"],
      serif: ["Merriweather", "serif"],
    },
    extend: {
      colors: {
        primary: "#d8e8f3",
        secondary: "#3d5a80",
        white: "#ffffff",
        black: "#000000",
        "btn-sec": "#293241",
        "body-fade-grey" : "#F9F9F9",
      },
      screens: {
        '3xl': '2000px',
      },
      padding: {
        dpc: "10%",
        vpc: "20%",
      },
      boxShadow: {
        card: "2px 2px 4px rgba(216, 232, 243)",
        formConnect: "2px 2px 5px 2px rgba(216, 232, 243)",
      },
      keyframes: {
        front: {
          "0%": { opacity: 0 },
          "100%": { opacity: 1 },
        },
        back: {
          "0%": { opacity: 0 },
          "100%": { opacity: 1 },
        },
        devops: {
          "0%": { opacity: 0 },
          "100%": { opacity: 1 },
        },
        borderTop: {
          "0%": { top: "45%", left: "45%" },
          "100%": { top: 0, left: 0, width: "50%" },
        },
        borderLeft: {
          "0%": { top: "45%", left: "45%" },
          "100%": { top: 0, left: 0, width: "50%" },
        },
        borderRight: {
          "0%": { bottom: "45%", right: "45%" },
          "100%": { bottom: 0, right: 0, width: "50%" },
        },
        borderBottom: {
          "0%": { bottom: "45%", right: "45%" },
          "100%": { bottom: 0, right: 0, width: "50%" },
        },
        projectsScale: {
          "0%": { opacity: 0, transform: "scale(0.2)" },
          "100%": { opacity: 1, transform: "scale(1)" },
        },
        notif: {
          "0%": {top:"50px", right:"-400px"},
          "30%": {top:"50px", right:"100px"},
          "90%": {top:"50px", right:"100px"},
          "100%": {top:"50px", right:"-400px"},
        }
      },
      animation: {
        front: "front 5s ease-out 1s forwards",
        back: "front 5s ease-out 2s forwards",
        devops: "front 5s ease-out 3s forwards",
        borderTop: "borderTop 2s ease-out 1s forwards",
        borderLeft: "borderLeft 2s ease-out 1s forwards",
        borderRight: "borderRight 2s ease-out 1s forwards",
        borderBottom: "borderBottom 2s ease-out 1s forwards",
        projectsScale: "projectsScale 2s ease-out 2s forwards",
        notif: "notif 10s ease-out forwards"
      },
    },
  },
  plugins: [require("tailwindcss-animation-delay")],
};
