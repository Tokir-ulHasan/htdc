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
        // Light Brand Primary
        blPrimary: {
          50: 'rgb(var(--bl-primary-50) / <alpha-value>)',
          100: 'rgb(var(--bl-primary-100) / <alpha-value>)',
          200: 'rgb(var(--bl-primary-200) / <alpha-value>)',
          300: 'rgb(var(--bl-primary-300) / <alpha-value>)',
          400: 'rgb(var(--bl-primary-400) / <alpha-value>)',
          500: 'rgb(var(--bl-primary-500) / <alpha-value>)',
          600: 'rgb(var(--bl-primary-600) / <alpha-value>)',
          700: 'rgb(var(--bl-primary-700) / <alpha-value>)',
          800: 'rgb(var(--bl-primary-800) / <alpha-value>)',
          900: 'rgb(var(--bl-primary-900) / <alpha-value>)',
        },
        // Deep Dark Primary
        ddPrimary: {
          50: 'rgb(var(--dd-primary-50) / <alpha-value>)',
          100: 'rgb(var(--dd-primary-100) / <alpha-value>)',
          200: 'rgb(var(--dd-primary-200) / <alpha-value>)',
          300: 'rgb(var(--dd-primary-300) / <alpha-value>)',
          400: 'rgb(var(--dd-primary-400) / <alpha-value>)',
          500: 'rgb(var(--dd-primary-500) / <alpha-value>)',
          600: 'rgb(var(--dd-primary-600) / <alpha-value>)',
          700: 'rgb(var(--dd-primary-700) / <alpha-value>)',
          800: 'rgb(var(--dd-primary-800) / <alpha-value>)',
          900: 'rgb(var(--dd-primary-900) / <alpha-value>)',
        }
      },
    },
  },
  plugins: [],
}