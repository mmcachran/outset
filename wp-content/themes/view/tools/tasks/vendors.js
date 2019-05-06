import { root } from '../utils/paths';
import { src, dest } from 'gulp';
import { config } from '../utils/env';
import pump from 'pump';

function vendors (cb) {
  return pump(
    [
      src(config.vendors),
      dest(`${root}/dist/vendors`),
    ],
    cb
  );
}

export { vendors };