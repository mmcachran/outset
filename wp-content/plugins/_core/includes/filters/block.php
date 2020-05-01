<?php

namespace _core\filters\block;

use function _core\helpers\utils\merge;

function global_block_data( $block ) {
	return merge(
		$block,
		[]
	);
}
