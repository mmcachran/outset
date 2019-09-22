import { series, parallel } from 'gulp';
import { scripts, styles, fonts, templates, images, svgs, sprite, clean, monitor, vendors, blockStyles } from './tools/index';
import { serve } from './tools/tasks/serve';

const start = parallel(
  serve,
  monitor,
);

const build = series(
  clean,
  series(
    // styles,
    scripts,
    fonts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
    blockStyles,
  ),
);

const prod = series(
  clean,
  parallel(
    scripts,
    styles,
    fonts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
    blockStyles,
  ),
);

export {
  build,
  start,
  prod,
  svgs,
  styles,
  scripts,
  fonts,
  templates,
  sprite,
  images,
  vendors
};
