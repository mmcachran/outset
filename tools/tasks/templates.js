
import pump from 'pump';
import { dest, src } from 'gulp';
import { paths } from '../utils/paths';

const fileTypes = ['twig'];

function templates(cb) {
  return pump(
    [
      src(fileTypes.map(fileType => `${paths.src.views}/**/*.${fileType}`)),
      dest(paths.dist.views),
    ],
    cb,
  );
}

export { templates };
