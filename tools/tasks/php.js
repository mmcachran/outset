const { spawn } = require('child_process');

function php(cb) {
  return spawn('./vendor/squizlabs/php_codesniffer/bin/phpcs', [], { stdio: 'inherit' })
    .on('close', cb)
    .on('exit', () => cb())
    .on('error', err => {
      console.error(err);
      process.exit(err);
    });
}

export { php };
