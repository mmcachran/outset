<?php
// Hook into the 'wp_dashboard_setup' action to register our function
add_action( 'wp_dashboard_setup', 'remove_dashboard_widget' );
function remove_dashboard_widget() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); //since 3.8
}

add_action( 'admin_menu', 'custom_menu_page_removing' );
function custom_menu_page_removing() {
	if ( ! current_user_can( 'edit_users' ) ) {
		remove_menu_page( 'tools.php' );
	}
	// remove_menu_page( 'edit.php' );
	// remove_menu_page( 'edit.php?post_type=page' );
	// remove_menu_page( 'edit-comments.php' );
}

// add_filter('acf/load_field/name=post_type', 'add_post_types_to_acf_field');
function add_post_types_to_acf_field( $field ) {
	$field['choices'] = [];

	$types   = get_post_types( '', 'names' );
	$exclude = [ 'page', 'attachment', 'revision', 'nav_menu_item', 'acf-field-group', 'acf-field', 'custom-css', 'customize-changeset' ];
	foreach ( $types as $type ) {
		if ( in_array( $type, $exclude ) ) {
			continue;
		}
		$field['choices'][ $type ] = ucwords( str_replace( [ '_', '-' ], ' ', $type ) );
	}

	return $field;
}

add_filter( 'wpseo_metabox_prio', 'yoasttobottom' );
function yoasttobottom() {
	return 'low';
}

function cc_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['json'] = 'application/json';
	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

// Adding Options page to the backend admin
function add_options_pages() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}
	$args = [
		'page_title' => 'Theme Settings',
		'menu_title' => 'Pyxl Settings',
		'capability' => 'edit_posts',
		'icon_url'   => 'dashicons-lightbulb',
	];
	acf_add_options_page( $args );

	$cpt_post_id  = 'job-opening';
	$cpt_acf_page = [
		'page_title'  => 'Global Job Opening Options',
		'menu_title'  => 'Options',
		'parent_slug' => 'edit.php?post_type=' . $cpt_post_id,
		'menu_slug'   => $cpt_post_id . '-options',
		'capability'  => 'edit_posts',
		'post_id'     => $cpt_post_id,
		'position'    => false,
		'icon_url'    => false,
		'redirect'    => false,
	];
	acf_add_options_page( $cpt_acf_page );
}

if ( is_admin() ) {
	add_options_pages();
}

// add_filter('tiny_mce_before_init', 'edit_tiny_mce', 10, 2);
// function edit_tiny_mce($mceInit, $editor){
//     return $mceInit;
// }

add_action( 'admin_init', 'pyxl_tiny_mce_customizations' );
function pyxl_tiny_mce_customizations() {
	add_editor_style( get_template_directory_uri() . '/assets/css/tiny-mce-editor.css' );
	add_filter( 'admin_head', 'send_quicktags_to_js' );
	add_filter( 'mce_external_plugins', 'pyxl_add_buttons' );
	add_filter( 'mce_buttons', 'pyxl_register_buttons' );
}

function pyxl_add_buttons( $plugin_array ) {
	$plugin_array['pyxl']  = get_template_directory_uri() . '/tiny-mce-plugin/pyxl-commands/pyxl-commands.js';
	$plugin_array['table'] = get_template_directory_uri() . '/tiny-mce-plugin/table/plugin.min.js';
	return $plugin_array;
}

function pyxl_register_buttons( $buttons ) {
	unset( $buttons[0] );
	array_push( $buttons, 'table', 'pyxl' );
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

function send_quicktags_to_js() {
	global $shortcode_tags;
	$tags = get_quick_tags();
	?>
	<script>
		var pyxl_tiny_mce_additions = {
			tags: <?php echo json_encode( $tags ); ?>,
			shortcodes: <?php echo json_encode( $shortcode_tags ); ?>
		};
	</script>
	<?php
}

add_action( 'admin_enqueue_scripts', 'pyxl_add_admin_scripts' );
function pyxl_add_admin_scripts() {
	 $theme_dir = get_template_directory_uri();

	$css_file = '/dist/styles/admin.css';
	wp_register_style( 'admin-css', $theme_dir . $css_file, [], get_template_directory() . $css_file, 'all' );
	wp_enqueue_style( 'admin-css' );
}

// Callback function to filter the MCE settings
add_filter( 'tiny_mce_before_init', 'pyxl_mce_before_init_insert_formats' );
function pyxl_mce_before_init_insert_formats( $init_array ) {
	// Add top level items here
	$style_formats = [
		'headings'    => [
			'title' => 'Header Styles',
			'items' => [],
		],
		'buttons'     => [
			'title' => 'Button Styles',
			'items' => [],
		],
		'blockquotes' => [
			'title' => 'Blockquote Styles',
			'items' => [],
		],
		'paragraphs'  => [
			'title' => 'Paragraph Styles',
			'items' => [],
		],
		'misc'        => [
			'title' => 'Miscellaneous Styles',
			'items' => [],
		],
	];

	// add heading sub items
	$headings = [
		'h1' => [
			'title' => 'Heading 1',
		],
		'h2' => [
			'title' => 'Heading 2',
		],
		'h3' => [
			'title' => 'Heading 3',
		],
		'h4' => [
			'title' => 'Heading 4',
		],
		'h5' => [
			'title' => 'Heading 5',
		],
		'h6' => [
			'title' => 'Heading 6',
		],
	];
	foreach ( $headings as $tag => $heading ) {
		$title     = $heading['title'];
		$styled_as = [];
		if ( $tag != 'h1' ) {
			$styled_as[] = [
				'title'   => 'Heading 1',
				'block'   => $tag,
				'classes' => 'h1',
			];
		}
		if ( $tag != 'h2' ) {
			$styled_as[] = [
				'title'   => 'Heading 2',
				'block'   => $tag,
				'classes' => 'h2',
			];
		}
		if ( $tag != 'h3' ) {
			$styled_as[] = [
				'title'   => 'Heading 3',
				'block'   => $tag,
				'classes' => 'h3',
			];
		}
		if ( $tag != 'h4' ) {
			$styled_as[] = [
				'title'   => 'Heading 4',
				'block'   => $tag,
				'classes' => 'h4',
			];
		}
		if ( $tag != 'h5' ) {
			$styled_as[] = [
				'title'   => 'Heading 5',
				'block'   => $tag,
				'classes' => 'h5',
			];
		}
		if ( $tag != 'h6' ) {
			$styled_as[] = [
				'title'   => 'Heading 6',
				'block'   => $tag,
				'classes' => 'h6',
			];
		}
		$style_formats['headings']['items'][] = [
			'title' => $title,
			'items' => [
				[
					'title'   => "Insert $title",
					'block'   => $tag,
					'classes' => '',
				],
				[
					'title' => 'Insert Styled As...',
					'items' => $styled_as,
				],
			],
		];
	}
	$style_formats['headings']['items'][] = [
		'title' => 'Additional Items',
		'items' => [
			[
				'title'    => 'Numbered Header',
				'selector' => 'h6,h1,h2,h3,h4,h5',
				'classes'  => 'numbered-header',
			],
			[
				'title'    => 'Numbered Header Reset',
				'selector' => 'h6.numbered-header,h1.numbered-header,h2.numbered-header,h3.numbered-header,h4.numbered-header,h5.numbered-header',
				'classes'  => 'numbered-header-reset',
			],
			[
				'title'    => 'Green',
				'selector' => 'h6,h1,h2,h3,h4,h5',
				'classes'  => 'green',
			],
			[
				'title'    => 'Blue',
				'selector' => 'h6,h1,h2,h3,h4,h5',
				'classes'  => 'blue',
			],
			[
				'title'    => 'Black',
				'selector' => 'h6',
				'classes'  => 'black',
			],
			[
				'title'   => 'Label',
				'block'   => 'span',
				'classes' => 'label',
			],
		],
	];
	// add button sub items
	$buttons = [
		'Medium'      => [
			'Standard - Green'  => 'button button-green',
			'Standard - Blue'   => 'button button-blue',
			'Solid - Green'     => 'button button-green button-solid',
			'Solid - Blue'      => 'button button-blue button-solid',
			'Alternate - Green' => 'button button-green button-alt',
			'Alternate - Blue'  => 'button button-blue button-alt',
		],
		'Large'       => [
			'Standard - Green'  => 'button button-green large',
			'Standard - Blue'   => 'button button-blue large',
			'Solid - Green'     => 'button button-green button-solid large',
			'Solid - Blue'      => 'button button-blue button-solid large',
			'Alternate - Green' => 'button button-green button-alt large',
			'Alternate - Blue'  => 'button button-blue button-alt large',
		],
		'Extra Large' => [
			'Standard - Green'  => 'button button-green xlarge',
			'Standard - Blue'   => 'button button-blue xlarge',
			'Solid - Green'     => 'button button-green button-solid xlarge',
			'Solid - Blue'      => 'button button-blue button-solid xlarge',
			'Alternate - Green' => 'button button-green button-alt xlarge',
			'Alternate - Blue'  => 'button button-blue button-alt xlarge',
		],
	];
	foreach ( $buttons as $title => $items ) {
		$menu_items = [];
		foreach ( $items as $elem_title => $classes ) {
			$menu_items[] = [
				'title'   => $elem_title,
				'block'   => 'a',
				'classes' => $classes,
			];
		}
		$style_formats['buttons']['items'][] = [
			'title' => $title,
			'items' => $menu_items,
		];
	}

	// // add blockquote subitems
	// $blockquotes = array(
	//   'Red Background' => 'red-bg',
	//   'White Background' => 'white-bg',
	//   'Large Green Text - Left Aligned' => 'green-text left'
	// );
	// foreach($blockquotes as $elem_title => $classes){
	//   $style_formats['blockquotes']['items'][] = array(
	//     'title' => $elem_title,
	//     'block' => 'blockquote',
	//     'classes' => $classes,
	//   );
	// }

	// add paragraph subitems
	$paragraphs = [
		'Large Text'          => 'large-text',
		'Medium Text'         => 'medium-text',
		'Small Text'          => 'small-text',
		'No Margin'           => 'no-spacing',
		'Long Form Copy'      => 'longform',
		'Shorter Line Height' => 'short',
	];
	foreach ( $paragraphs as $elem_title => $classes ) {
		$style_formats['paragraphs']['items'][] = [
			'title'   => $elem_title,
			'block'   => 'p',
			'classes' => $classes,
		];
	}

	// add miscellanious subitems
	$misc = [
		'Scroll For More' => [
			'elem'    => 'span',
			'classes' => 'scroll',
		],
		'Quote Cite'      => [
			'elem'    => 'cite',
			'classes' => '',
		],
	];
	foreach ( $misc as $elem_title => $settings ) {
		$style_formats['misc']['items'][] = [
			'title'   => $elem_title,
			'block'   => $settings['elem'],
			'classes' => $settings['classes'],
		];
	}

	$init_array['style_formats_merge'] = false;
	$init_array['style_formats']       = json_encode( $style_formats );

	return $init_array;
}

add_filter( 'acf/fields/wysiwyg/toolbars', 'pyxl_acf_editor_toolbars' );
function pyxl_acf_editor_toolbars( $toolbars ) {
	// Uncomment to view format of $toolbars
	/*
	echo '< pre >';
	  print_r($toolbars);
	echo '< /pre >';
	die;
	*/
	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Very Simple']         = [];
	$toolbars['Very Simple'][1]      = [ 'bold', 'italic', 'underline', 'pyxl' ];
	$toolbars['Large and Simple'][1] = [ 'bold', 'italic', 'underline', 'pyxl' ];
	// return $toolbars - IMPORTANT!
	return $toolbars;
}
