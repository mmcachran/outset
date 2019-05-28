import { basename, extname } from 'path';
import { src, dest } from 'gulp';
import pump from 'pump';
import plumber from 'gulp-plumber';
import named from 'vinyl-named';
import webpack from 'webpack';
import rename from 'gulp-rename';
import webpackStream from 'webpack-stream';
import { webpackConfig } from '../webpack.config';
import { paths, root } from '../utils/paths';
import { find } from 'globule';

const srcPaths = find([
  `${paths.src.scripts}*.js`,
  `${paths.src.blocks}**/*.js`
]);

/**
 *
 * @param file
 * @returns {string}
 * @note This is specifically to search in globbed paths to identify block modules, for some reason multiple webpack instances wasn't working. The result being something like taking 'views/Blocks/Hero/Hero.js' and outputting to 'dist/blocks/Hero/Hero/js'
 */
function filterToIdentifyBlocks (file) {
  const fileName = basename(file.basename, '.js');

  if ('.js' !== extname(file.basename)) {
    return paths.dist.scripts;
  }

  const blockMatch = srcPaths.find(item => item.includes(`Blocks/${fileName}`));
  if ('undefined' !== typeof blockMatch) {
    return `${paths.dist.blocks}${fileName}`;
  }

  return paths.dist.scripts;
}

function scripts (cb) {
  return pump(
    [
      src(srcPaths),
      plumber(),
      named(),
      webpackStream(webpackConfig, webpack),
      dest(filterToIdentifyBlocks),
    ],
    cb
  );
}

export { scripts };