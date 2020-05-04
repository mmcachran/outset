import { series, parallel } from 'gulp';
import { scripts, setupStyles, globalStyles, blockStyles, tailwindStyles, adminStyles, fonts, templates, images, svgs, sprite, clean, monitor, vendors, phpcs, phpcbf } from './tools/index';
import { serve } from './tools/tasks/serve';

const start = series(
  setupStyles,
  parallel(
    serve,
    monitor,
  ),
);

const build = series(
  clean,
  setupStyles,
  series(
    globalStyles,
    blockStyles,
    tailwindStyles,
    adminStyles,
    scripts,
    fonts,
    templates,
    svgs,
    sprite,
    images,
    vendors,
    phpcs,
    phpcbf,
  ),
);

const prod = series(
  clean,
  setupStyles,
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
