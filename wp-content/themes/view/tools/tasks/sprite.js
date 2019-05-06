import pump from 'pump';
import { dest, src } from 'gulp';
import { config } from '../utils/env';
import { paths } from '../utils/paths';
import svgSymbols from 'gulp-svg-symbols';
import svgo from 'gulp-svgo';
import rename from 'gulp-rename';
import path from 'path';
import { find } from 'globule';

const { dirname } = path;
const fa = dirname(require.resolve('font-awesome-5/package'));

function sprite (cb) {
  return pump(
    [
      src([
        ...config.svgs['font-awesome'].map(svg => `${fa}/raw-svg/${svg}.svg`),
        ...find(`${paths.src.svgs}/sprite/*.svg`),
      ]),
      svgo(),
      svgSymbols({
        id: 'icon-%f',
        class: '.icon-%f',
        templates: ['default-svg'],
        warn: false,
        svgAttrs: {
          'class': 'svg-icon-lib',
          'aria-hidden': 'true',
          'style': 'position:absolute;width:0;height:0;overflow:hidden;',
          'data-enabled': 'true'
        },
      }),
      rename({
        basename: 'sprite',
      }),
      dest(paths.dist.svgs),
    ],
    cb
  );

}

export { sprite };