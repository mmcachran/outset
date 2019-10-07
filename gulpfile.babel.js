import { series, parallel } from 'gulp';
import { scripts, globalStyles, blockStyles, tailwindStyles, fonts, templates, images, svgs, sprite, clean, monitor, vendors, php } from './tools/index';
import { serve } from './tools/tasks/serve';

const start = parallel(
  serve,
  monitor,
);

const build = series(
  clean,
  series(
    globalStyles,
    blockStyles,
    tailwindStyles,
    scripts,
    fonts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
    // TODO: Do not enable php task until fully working
    // php,
  ),
);

const prod = series(
  clean,
  parallel(
    // scripts,
    // globalStyles,
    // blockStyles,
    // tailwindStyles,
    // fonts,
    // templates,
    // svgs,
    // sprite,
    // images,
    vendors,
    // TODO: Do not enable php task until fully working
    // php,
  ),
);

export {
  build,
  start,
  prod,
  php
};
