<?php

namespace _core\filters\block;

use function _core\helpers\utils\merge;

function global_data( $block ) {
	return merge(
		$block,
		[
			// phpcs:disable Squiz.PHP.CommentedOutCode.Found
			// 'example' => 'data',
		]
	);
}
