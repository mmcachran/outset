module.exports = {
  important: false,
  theme: {
    // https://tailwindcss.com/docs/theme/#app
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
    },
    // https://tailwindcss.com/docs/container/#app
    container: {
      center: true,
      padding: {
        default: '1rem',
        sm: '2rem',
        lg: '4rem',
        xl: '5rem',
      },
    },
    fontFamily: {
      // Please Keep this under 3 or less fonts if possible. - https://tailwindcss.com/docs/font-family/#app
      base: ['Cardo', 'sans-serif'],
      primary: ['Montserrat', 'sans-serif'],
      // secondary: ['Montserrat', 'sans-serif'],
      // tertiary: ['Montserrat', 'sans-serif'],
    },
    fontSize: {
      // Please base this on https://type-scale.com
      xs: '0.64em',
      sm: '0.8em',
      base: '1em', // p, h6
      md: '1.25em', // h5
      lg: '1.563em', // h4
      xl: '1.953em', // h3
      '1xl': '2.441em', // h2
      '2xl': '3.052em', // h1
      '3xl': '3.815em',
      '4xl': '4.768em',
    },
    colors: {
      // https://tailwindcss.com/docs/customizing-colors/#app
      light: '#FEFFFF',
      dark: '#17252A',
      primary: {
        default: '#3AAfA9',
        light: '#DEF2F1',
        // lighter: '#DEF2F1',
        dark: '#2B7A78',
        // darker: '#2B7A78',
      },
      // secondary: {
      //   default: '#3AAfA9',
      //   light: '#DEF2F1',
      //   lighter: '#DEF2F1',
      //   dark: '#2B7A78',
      //   darker: '#2B7A78',
      // },
      gray: {
        100: '#f5f5f5',
        200: '#eeeeee',
        300: '#e0e0e0',
        400: '#bdbdbd',
        500: '#9e9e9e',
        600: '#757575',
        700: '#616161',
        800: '#424242',
        900: '#212121',
      },
    },
    extend: {
      // https://tailwindcss.com/docs/theme/#app
      screens: {
        '2xl': '1440px',
      },
    },
  },
  corePlugins: {
    float: false,
    objectFit: true,
    objectPosition: false,
    // preflight: false,
  },
};
