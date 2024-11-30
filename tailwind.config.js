/** @type {import('tailwindcss').Config} */
import flowbitePlugin from 'flowbite/plugin';

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#003049',
        secondary: '#1A4D7C',
        secondary2: '#3498DB',
        accent: '#F65A11',
        cream: '#EFEDE7',
        creamTerang: '#FBF9F2',
        abu: '#6A6D69',
        danger: '#B22222'
      },
      fontFamily: {
        body: ['Poppins']
      },
      backgroundImage: {
        'custom-gradient': 'linear-gradient(115deg, #62cff4, #2c67f2)',
        'new-gradient': 'linear-gradient(45deg, hsl(201deg 100% 14%) 0%, hsl(207deg 69% 24%) 47%, hsl(209deg 65% 29%) 100%)',
        'page-gradient': 'linear-gradient(130deg, hsl(220deg 14% 96%) 0%, hsl(218deg 13% 79%) 40%, hsl(215deg 13% 63%) 61%, hsl(212deg 15% 47%) 74%, hsl(209deg 29% 32%) 86%, hsl(201deg 100% 14%) 100%)'
      },
      boxShadow: {
        'container': '0 3px 10px rgb(0,0,0,0.2)'
      }
    },
  },
  plugins: [
    flowbitePlugin,
  ],
};
