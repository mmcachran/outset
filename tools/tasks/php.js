const { spawn } = require('child_process');
import { paths } from '../utils/paths';

function php(cb) {
  return cb();
  // return spawn(`${paths.root}/vendor/squizlabs/php_codesniffer/bin/phpcs`, [], { stdio: 'inherit' })
  //   .on('close', cb)
  //   .on('exit', () => cb())
  //   .on('error', err => {
  //     console.error(err);
  //     process.exit(err);
  //   });
}

export { php };
