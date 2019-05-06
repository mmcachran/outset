import { mode } from '../utils/env';
import { paths } from '../utils/paths';
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
import sassGlob from 'gulp-sass-glob';
import autoprefixer from 'gulp-autoprefixer';

const options = {
  cleanCSS: {
    level: {
      1: {
        specialComments: false,
      }
    }
  },
  sass: {
    importer: sassImport(),
  },
  rename: {
    suffix: 'production' === mode ? `.min` : ``,
    extname: `.css`
  },
  autoprefixer: {
    grid: 'autoplace',
    cascade: false
  }
};

function styles (cb) {
  return pump(
    [
      src(`${paths.src.styles}/*.scss`),
      plumber(),
      'production' === mode ? noop() : sourcemaps.init(),
      sassGlob(),
      sass(options.sass),
      'production' === mode ? cleanCSS(options.cleanCSS) : noop(),
      autoprefixer(options.autoprefixer),
      rename(options.rename),
      'production' === mode ? noop() : sourcemaps.write('.'),
      dest(paths.dist.styles),
      server.stream()
    ],
    cb
  );
}

export { styles };
