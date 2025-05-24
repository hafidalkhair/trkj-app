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
        'bone': '#E5D7C4',
        'tan': '#CFBB99',
      },
      fontFamily: {
        'sans': ['Poppins', 'sans-serif'],
        'playfair': ['"Playfair Display"', 'serif'],
      },
    },
  },
  plugins: [],
} 