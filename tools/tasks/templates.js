
import pump from 'pump';
import { dest, src } from 'gulp';
import { paths } from '../utils/paths';
import flatten from 'gulp-flatten';

const fileTypes = ['twig'];

function templates(cb) {
  return pump(
    [
      src(fileTypes.map(fileType => `${paths.src.blocks}/**/*.${fileType}`)),
      flatten(),
      dest(paths.dist.blocks),
    ],
    cb,
  );
}

export { templates };
