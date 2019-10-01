import pump from 'pump';
import { src } from 'gulp';
import plumber from 'gulp-plumber';
import phpcs from 'gulp-phpcs';
import { theme, plugin, root } from '../utils/paths';

function php(cb) {
  return pump(
    [
      src([
          `${theme}/**/*.php`,
          `${plugin}/**/*.php`,
      ]),
      plumber(),
      phpcs({
        standard: 'phpcs.xml',
        bin: 'vendor/bin/phpcs',
        warningSeverity: 0,
      }),
      phpcs.reporter('log'),
    ],
    cb,
  );
}

export { php };
