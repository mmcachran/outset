module.exports = {
  important: true,
  theme: {
    fontFamily: {
      display: ['Gilroy', 'sans-serif'],
      body: ['Graphik', 'sans-serif'],
    },
    colors: {
      blue: 'blue',
      red: '#de3618',
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
      margin: {
        96: '24rem',
        128: '32rem',
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
