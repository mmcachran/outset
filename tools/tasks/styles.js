import { mode } from '../utils/env';
import { paths, root, theme } from '../utils/paths';
import { server } from './serve';
import { src, dest } from 'gulp';
import noop from 'gulp-noop';
import plumber from 'gulp-plumber';
import pump from 'pump';
import sass from 'gulp-sass';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import sourcemaps from 'gulp-sourcemaps';
import sassImport from 'node-sass-package-importer';
import postcss from 'gulp-postcss';
import inject from 'gulp-header';
import sassGlob from 'gulp-sass-glob';
import autoprefixer from 'autoprefixer';
import tailwindcss from 'tailwindcss';

const options = {
  cleanCSS: {
    level: {
      1: {
        specialComments: false,
      },
    },
  },
  sass: {
    importer: sassImport(),
    // data: '@import styles/utils/**/*";',
    // data: `
    // @import "@/utils/_variables.scss";
    // body { background-color: red; }
    // `,
    includePaths: [
      paths.src.styles,
      paths.src.views,
      // tailwindcss.includePaths,
      // `${paths.src.styles}utils/mixins/screen-reader-text.scss`,
    ],
    // includes: [],
    // indentedSyntax: true,
    // indentWidth: 10,
  },
  rename: {
    suffix: 'production' === mode ? '.min' : '',
    extname: '.css',
  },
  autoprefixer: {
    grid: 'autoplace',
    cascade: false,
  },
};

function globalStyles(cb) {
  return pump([
    src(`${paths.src.styles}/*.scss`),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    inject(`
      @import "utils/**/*";
    `),
    sassGlob(),
    sass(options.sass).on('error', sass.logError),
    'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
    postcss([
      // tailwindcss(`${root}/tailwind.config.js`),
      autoprefixer(options.autoprefixer),
    ]),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write('.'),
    dest(paths.dist.styles),
    server.stream(),
  ], cb);
}

function blockStyles(cb) {
  return pump(
    [
      src(`${paths.src.blocks}**/*.scss`),
      plumber(),
      'production' === mode ? noop() : sourcemaps.init(),
      inject(`
        @import "utils/**/*";
      `),
      sass(options.sass).on('error', sass.logError),
      'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
      postcss([
        // tailwindcss(`${root}/tailwind.config.js`),
        autoprefixer(options.autoprefixer),
      ]),
      rename(options.rename),
      'production' === mode ? noop() : sourcemaps.write('.'),
      dest(paths.dist.blocks),
      server.stream(),
    ],
    cb,
  );
}

export { globalStyles, blockStyles };
