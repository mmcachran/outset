import { basename, extname } from 'path';
import { src, dest } from 'gulp';
import pump from 'pump';
import plumber from 'gulp-plumber';
import named from 'vinyl-named';
import webpack from 'webpack';
import webpackStream from 'webpack-stream';
import { webpackConfig } from '../webpack.config';
import { paths } from '../utils/paths';
import { find } from 'globule';

const srcPaths = find([
  `${paths.src.scripts}/*.js`,
  `${paths.src.views}/**/*.js`,
]);

/**
 *
 * @param file
 * @returns {string}
 * @note This is specifically to search in globbed paths to identify view modules, for some reason multiple
 *       webpack instances wasn't working. The result being something like taking 'views/blocks/hero/hero.js'
 *       and outputting to 'dist/view/hero/hero.js'
 */
function filterToIdentifyViews(file) {
  const fileName = basename(file.basename, '.js');

  if ('.js' !== extname(file.basename)) {
    return paths.dist.scripts;
  }

  const viewMatch = srcPaths.find(item => item.includes(`views/${fileName}`));
  if ('undefined' !== typeof viewMatch) {
    return `${paths.dist.views}/${fileName}`;
  }

  return paths.dist.scripts;
}

function scripts(cb) {
  return pump(
    [
      src(srcPaths),
      plumber(),
      named(),
      webpackStream(webpackConfig, webpack),
      dest(filterToIdentifyViews),
    ],
    cb,
  );
}

export { scripts };
