/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: '#003049',
        secondary: '#1A4D7C',
        accent: '#F65A11',
        cream: '#EFEDE7',
        abu: '#6A6D69',
        danger: '#B22222'
      },
      fontFamily: {
        body: ['Poppins']
      },
      backgroundImage: {
        'custom-gradient': 'linear-gradient(115deg, #62cff4, #2c67f2)',
        'new-gradient': 'linear-gradient(45deg, hsl(201deg 100% 14%) 0%, hsl(207deg 69% 24%) 47%, hsl(209deg 65% 29%) 100%)',
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
],
}


