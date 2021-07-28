module.exports = {
  mode: process.env.NODE_ENV ? 'jit' : undefined,
  purge: ['./index.html', './src/**/*.{vue,js}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        'nunito': ['Nunito', 'sans-serif'],
        'poppins': ['Poppins', 'sans-serif'],
      },
    },
  },
  variants: {
    extend: {},
  },
}
