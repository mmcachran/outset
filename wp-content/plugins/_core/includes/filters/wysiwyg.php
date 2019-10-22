<?php

namespace _core\filters\wysiwyg;

function acf( $toolbars ) {
	$toolbars['Basic']    = [];
	$toolbars['Basic'][1] = [
		'bold',
		'italic',
		'underline',
		'aligncenter',
		'alignleft',
		'alignright',
		'link',
		'bullist',
		'formatselect',
	];

	// return $toolbars - IMPORTANT!
	return $toolbars;
}

function wp( $args ) {
	// Just omit h1 from the list
	// $args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Pre=pre';
	$args['block_formats'] = 'Paragraph=p;Heading 6=h6;Heading 5=h5;Heading 4=h4;Heading 3=h3;Heading 2=h2;';
	return $args;
}
