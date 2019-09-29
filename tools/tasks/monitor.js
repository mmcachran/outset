import { series, watch } from 'gulp';
import { quit, reload } from './serve';
import { scripts, globalStyles, blockStyles, svgs, fonts, clean, sprite, templates } from '../index';

function monitor(cb) {
  watch(
    [
      './tools/**/*',
      './gulpfile.babel.js',
      './postcss.config.js',
      './babel.config.js',
      './package.json',
    ],
    quit,
  );
  watch(
    [
      './src/**/*.svg',
    ],
    series(
      svgs,
      sprite,
      reload,
    ),
  );
  watch(
    [
      './src/**/*.js',
      './views/**/*.js',
    ],
    series(
      scripts,
      reload,
    ),
  );
  watch(
    [
      './src/**/*.scss',
    ],
    series(
      globalStyles,
      blockStyles,
    ),
  );
  watch(
    [
      './src/images/**/*',
    ],
    series(
      reload,
    ),
  );
  watch(
    [
      './src/**/*.twig',
    ],
    series(
      templates,
      reload,
    ),
  );
  cb();
}

export { monitor };
