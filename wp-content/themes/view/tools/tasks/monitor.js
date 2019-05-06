import { series, watch } from 'gulp';
import { quit, reload } from './serve';
import { scripts, styles, svgs, fonts, clean, sprite } from '../index';

function monitor (cb) {
  watch(
    [
      `./tools/**/*`,
      `./gulpfile.babel.js`,
      `./postcss.config.js`,
      `./babel.config.js`,
      `./package.json`,
    ],
    quit
  );
  watch(
    [
      `./src/**/*.svg`,
    ],
    series(
      svgs,
      sprite,
      reload
    )
  );
  watch(
    [
      `./src/**/*.js`,
    ],
    series(
      scripts,
      reload
    )
  );
  watch(
    [
      `./src/**/*.scss`,
      `./views/**/*.scss`,
    ],
    series(
      styles
    )
  );
  watch(
    [
      `./src/images/**/*`,
    ],
    series(
      reload
    )
  );
  watch(
    [
      `./**/*.php`,
      `./**/*.twig`
    ],
    series(
      reload
    )
  );
  cb();
}

export { monitor };