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
        primary: '#3498DB',
        secondary: '#2ECC71',
        accent: '#F39C12',
        abu: '#F4F6F6',
        teks: '#2C3E50',
      },
      fontFamily: {
        body: ['Poppins']
      },
      backgroundImage: {
        'custom-gradient': 'linear-gradient(115deg, #62cff4, #2c67f2)',
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
],
}


