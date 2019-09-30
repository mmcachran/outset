import { series, watch } from 'gulp';
import { quit, reload } from './serve';
import { scripts, globalStyles, blockStyles, tailwindStyles, svgs, fonts, clean, sprite, templates } from '../index';

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
      tailwindStyles,
      reload,
    ),
  );
  watch(
    [
      './src/**/*.scss',
      './tailwind.config.js',
    ],
    series(
      globalStyles,
      blockStyles,
      tailwindStyles,
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
      tailwindStyles,
      reload,
    ),
  );
  cb();
}

export { monitor };
