import { series, parallel } from 'gulp';
import { scripts, globalStyles, blockStyles, tailwindStyles, fonts, templates, images, svgs, sprite, clean, monitor, vendors } from './tools/index';
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
  ),
);

const prod = series(
  clean,
  parallel(
    scripts,
    globalStyles,
    blockStyles,
    tailwindStyles,
    fonts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
  ),
);

export {
  build,
  start,
  prod
};
