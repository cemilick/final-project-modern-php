/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    fontFamily: {
      sans: ['Helvetica', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      spacing: {
        '8xl': '96rem',
        '9xl': '128rem',
      },
      fontFamily: {
        comic: ['Comic Sans MS', 'cursive'],
      },
      colors: {
        'yellow': {
          500: '#ffc82c'
        },
        'blue': {
          500: '#1fb6ff'
        },
        'black': {
          500: '#000'
        }
      }
    }
  },
  plugins: [],
}

