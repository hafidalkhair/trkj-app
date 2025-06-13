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
        'primary': '#CE7DA5',
        'primary-light': '#D8899E',
        'primary-dark': '#B56B8E',
        'secondary': '#BEE5BF',
        'secondary-light': '#CEECD0',
        'secondary-dark': '#A8CCA9',
        'accent': '#FFD1BA',
        'accent-light': '#FFE0D1',
        'accent-dark': '#E8BCA7',
        'neutral': {
          50: '#F8F8F8',
          100: '#F0F0F0',
          200: '#E4E4E4',
          300: '#D1D1D1',
          400: '#B4B4B4',
          500: '#9A9A9A',
          600: '#818181',
          700: '#6A6A6A',
          800: '#5A5A5A',
          900: '#4A4A4A'
        }
      },
      backgroundImage: {
        'subtle-gradient': 'linear-gradient(to right, rgba(206, 125, 165, 0.05), rgba(190, 229, 191, 0.05))',
        'soft-gradient': 'linear-gradient(to bottom, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.95))',
        'fade-gradient': 'linear-gradient(to right, rgba(206, 125, 165, 0.1), rgba(255, 209, 186, 0.1))'
      },
      fontFamily: {
        'sans': ['Poppins', 'sans-serif'],
        'playfair': ['"Playfair Display"', 'serif'],
      },
    },
  },
  plugins: [],
} 