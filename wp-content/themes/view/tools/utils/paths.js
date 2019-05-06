import path from 'path';

const { resolve } = path;
const root = resolve(process.env.PWD);

const paths = {
  src: {
    styles: resolve(`${root}/src/styles/`),
    scripts: resolve(`${root}/src/scripts/`),
    images: resolve(`${root}/src/images/`),
    fonts: resolve(`${root}/src/fonts/`),
    svgs: resolve(`${root}/src/svgs/`),
  },
  dist: {
    styles: resolve(`${root}/dist/styles/`),
    scripts: resolve(`${root}/dist/scripts/`),
    images: resolve(`${root}/dist/images/`),
    fonts: resolve(`${root}/dist/fonts/`),
    svgs: resolve(`${root}/dist/svgs/`),
  }
};

export { paths, root };
