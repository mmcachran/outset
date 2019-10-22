const { spawn } = require('child_process');

function php(cb) {
  return spawn('phpcs', [], { stdio: 'inherit' })
    .on('close', cb)
    .on('exit', () => cb())
    .on('error', err => {
      console.error(err);
      process.exit(err);
    });
}

export { php };
