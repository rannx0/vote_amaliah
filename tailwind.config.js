/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
    theme: {
      extend: {
        colors: {
          'putih-100': '#FFFFFF',
          'putih-200': '#EDEDED',
          'ijomuda': '#0BBA6A',
          'ijo-200': '#027E46',
          'ijo-400': '#075733',
          'hitam-100': '#262626',
          'hitam-200': '#222222',
          'abu-100': '#6C6C6C',
          'abu-200': '#4F4F4F',
        },
        fontFamily: {
          montserrat: ['Montserrat', 'sans-serif'],
          poppins: ['Poppins', 'sans-serif'],
        },
        ringWidth: {
          '2': '2px',
          '3': '2.4px',
          '4': '4px',
        },
      },
    },
    plugins: [],
  }
