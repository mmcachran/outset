import { mode } from '../utils/env';
import { paths, root } from '../utils/paths';
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
import inject from 'gulp-header';
import sassGlob from 'gulp-sass-glob';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import purgeCSS from '@fullhuman/postcss-purgecss';
import tailwindCSS from 'tailwindcss';
import TailwindExportConfig from 'tailwindcss-export-config';
import postCSSNoop from 'postcss-noop';

const options = {
  tailwind: require(`${root}/tailwind.config.js`),
  cleanCSS: {
    level: {
      1: {
        specialComments: false,
      },
    },
  },
  sass: {
    importer: sassImport(),
    includePaths: [
      paths.src.styles,
      paths.src.views,
      tailwindCSS.includePaths,
    ],
  },
  rename: {
    suffix: 'production' === mode ? '.min' : '',
    extname: '.css',
  },
  autoprefixer: {
    grid: false, // autoplace,
    cascade: false,
  },
  purgeCSS: {
    whitelist: [
      'body',
    ],
    css: [
      './src/**/*.scss',
    ],
    content: [
      './src/**/*.js',
      './src/**/*.twig',
    ],
  },
};

function globalStyles(cb) {
  return pump([
    src([
      `${paths.src.styles}/*.scss`,
      // Exceptions
      `!${paths.src.styles}/tailwind.scss`,
      `!${paths.src.styles}/fonts.scss`,
      `!${paths.src.styles}/admin.scss`,
      `!${paths.src.styles}/normalize.scss`,
    ]),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    inject(`
      @import "utils/**/*";
    `),
    sassGlob(),
    sass(options.sass).on('error', sass.logError),
    postcss([
      tailwindCSS(),
      'production' === mode ? purgeCSS(options.purgeCSS) : postCSSNoop(),
      autoprefixer(options.autoprefixer),
    ]),
    'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest(paths.dist.styles),
    server.stream(),
  ], cb);
}

function adminStyles(cb) {
  options.tailwind.important = true;

  return pump([
    src([
      `${paths.src.styles}/admin.scss`,
    ]),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    inject(`
      @import "utils/**/*";
    `),
    sassGlob(),
    sass(options.sass).on('error', sass.logError),
    postcss([
      tailwindCSS(options.tailwind),
      'production' === mode ? autoprefixer(options.autoprefixer) : postCSSNoop(),
    ]),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest(paths.dist.styles),
  ], cb);
}

function blockStyles(cb) {
  return pump([
    src(`${paths.src.blocks}/**/*.scss`),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    inject(`
    @import "../../../styles/utils/**/*";
    `),
    sassGlob(),
    sass(options.sass).on('error', sass.logError),
    postcss([
      tailwindCSS(options.tailwind),
      'production' === mode ? purgeCSS(options.purgeCSS) : postCSSNoop(),
      autoprefixer(options.autoprefixer),
    ]),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest(paths.dist.blocks),
    server.stream(),
  ], cb);
}

function setupStyles(cb) {
  const converter = new TailwindExportConfig({
    config: `${root}/tailwind.config.js`,
    destination: 'src/styles/utils/theme',
    format: 'scss',
    prefix: 'tw',
    flat: true,
  });
  converter.writeToFile();

  return pump([
    src(`${paths.src.styles}/normalize.scss`),
    plumber(),
    sourcemaps.init(),
    postcss([
      tailwindCSS(options.tailwind),
      autoprefixer(options.autoprefixer),
    ]),
    cleanCSS(options.cleanCSS),
    rename({
      suffix: '.min',
      extname: '.css',
    }),
    sourcemaps.write(),
    dest(paths.dist.styles),
  ], cb);
}

function tailwindStyles(cb) {
  return pump([
    src(`${paths.src.styles}/tailwind.scss`),
    plumber(),
    'production' === mode ? noop() : sourcemaps.init(),
    postcss([
      tailwindCSS(options.tailwind),
      'production' === mode ? purgeCSS(options.purgeCSS) : postCSSNoop(),
      autoprefixer(options.autoprefixer),
    ]),
    'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
    rename(options.rename),
    'production' === mode ? noop() : sourcemaps.write(),
    dest(paths.dist.styles),
    server.stream(),
  ], cb);
}

export { globalStyles, blockStyles, tailwindStyles, setupStyles, adminStyles };
