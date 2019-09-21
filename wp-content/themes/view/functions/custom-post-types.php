<?php

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_staff() {
	$labels = [
		'name'               => __( 'Staff', 'pxyl' ),
		'singular_name'      => __( 'Staff Member', 'pxyl' ),
		'add_new'            => _x( 'Add New Staff Member', 'pxyl', 'pxyl' ),
		'add_new_item'       => __( 'Add New Staff Member', 'pxyl' ),
		'edit_item'          => __( 'Edit Staff Member', 'pxyl' ),
		'new_item'           => __( 'New Staff Member', 'pxyl' ),
		'view_item'          => __( 'View Staff Member', 'pxyl' ),
		'search_items'       => __( 'Search Staff', 'pxyl' ),
		'not_found'          => __( 'No Staff found', 'pxyl' ),
		'not_found_in_trash' => __( 'No Staff found in Trash', 'pxyl' ),
		'parent_item_colon'  => __( 'Staff Member:', 'pxyl' ),
		'menu_name'          => __( 'Staff', 'pxyl' ),
	];

	$args = [
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'The Staff of Pyxl',
		'taxonomies'          => [],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => [
			'slug'       => 'person',
			'with_front' => false,
		],
		'capability_type'     => 'post',
		'supports'            => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'staff', $args );
}

add_action( 'init', 'pyxl_post_type_staff' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxp_post_type_resources() {
	$labels = [
		'name'               => __( 'Resources', 'pyxl' ),
		'singular_name'      => __( 'Resource', 'pyxl' ),
		'add_new'            => _x( 'Add New Resource', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Resource', 'pyxl' ),
		'edit_item'          => __( 'Edit Resource', 'pyxl' ),
		'new_item'           => __( 'New Resource', 'pyxl' ),
		'view_item'          => __( 'View Resource', 'pyxl' ),
		'search_items'       => __( 'Search Resources', 'pyxl' ),
		'not_found'          => __( 'No Resources found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Resources found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Resource:', 'pyxl' ),
		'menu_name'          => __( 'Resources', 'pyxl' ),
	];

	$args = [
		'labels'              => $labels,
		'hierarchical'        => true,
		'description'         => 'Pyxl Resources',
		'taxonomies'          => [],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-media-spreadsheet',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => [
			'slug'       => 'resource',
			'with_front' => false,
		],
		'capability_type'     => 'post',
		'supports'            => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'resources', $args );
}

add_action( 'init', 'pyxp_post_type_resources' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_offices() {
	$labels = [
		'name'               => __( 'Offices', 'pyxl' ),
		'singular_name'      => __( 'Office', 'pyxl' ),
		'add_new'            => _x( 'Add New Office', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Office', 'pyxl' ),
		'edit_item'          => __( 'Edit Office', 'pyxl' ),
		'new_item'           => __( 'New Office', 'pyxl' ),
		'view_item'          => __( 'View Office', 'pyxl' ),
		'search_items'       => __( 'Search Offices', 'pyxl' ),
		'not_found'          => __( 'No Offices found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Offices Closed', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Office:', 'pyxl' ),
		'menu_name'          => __( 'Offices', 'pyxl' ),
	];

	$args = [
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'Pyxl Offices',
		'taxonomies'          => [],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-admin-multisite',
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => [
			'slug'       => 'office',
			'with_front' => false,
		],
		'capability_type'     => 'post',
		'supports'            => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'offices', $args );
}

add_action( 'init', 'pyxl_post_type_offices' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_facts() {
	$labels = [
		'name'               => __( 'Facts', 'pyxl' ),
		'singular_name'      => __( 'Fact', 'pyxl' ),
		'add_new'            => _x( 'Add New Fact', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Fact', 'pyxl' ),
		'edit_item'          => __( 'Edit Fact', 'pyxl' ),
		'new_item'           => __( 'New Fact', 'pyxl' ),
		'view_item'          => __( 'View Fact', 'pyxl' ),
		'search_items'       => __( 'Search Facts', 'pyxl' ),
		'not_found'          => __( 'No Facts found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Facts found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Fact:', 'pyxl' ),
		'menu_name'          => __( 'Facts', 'pyxl' ),
	];

	$args = [
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'Pyxl Facts',
		'taxonomies'          => [],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-star-filled',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'facts', $args );
}

add_action( 'init', 'pyxl_post_type_facts' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_quotes() {
	$labels = [
		'name'               => __( 'Quotes', 'pyxl' ),
		'singular_name'      => __( 'Quote', 'pyxl' ),
		'add_new'            => _x( 'Add New Quote', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Quote', 'pyxl' ),
		'edit_item'          => __( 'Edit Quote', 'pyxl' ),
		'new_item'           => __( 'New Quote', 'pyxl' ),
		'view_item'          => __( 'View Quote', 'pyxl' ),
		'search_items'       => __( 'Search Quotes', 'pyxl' ),
		'not_found'          => __( 'No Quotes found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Quotes found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Quote:', 'pyxl' ),
		'menu_name'          => __( 'Quotes', 'pyxl' ),
	];

	$args = [
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'Pyxl Quotes',
		'taxonomies'          => [],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-format-quote',
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => false,
		'capability_type'     => 'post',
		'supports'            => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'quotes', $args );
}

add_action( 'init', 'pyxl_post_type_quotes' );


/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_work() {
	$labels = [
		'name'               => __( 'Work', 'pyxl' ),
		'singular_name'      => __( 'Work', 'pyxl' ),
		'add_new'            => _x( 'Add New Work', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Work', 'pyxl' ),
		'edit_item'          => __( 'Edit Work', 'pyxl' ),
		'new_item'           => __( 'New Work', 'pyxl' ),
		'view_item'          => __( 'View Work', 'pyxl' ),
		'search_items'       => __( 'Search Work', 'pyxl' ),
		'not_found'          => __( 'No Work found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Work found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Work:', 'pyxl' ),
		'menu_name'          => __( 'Work', 'pyxl' ),
	];

	$args = [
		'labels'              => $labels,
		'hierarchical'        => true,
		'description'         => 'Work that Pyxl has done',
		'taxonomies'          => [],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-welcome-view-site',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => [ 'with_front' => false ],
		'capability_type'     => 'post',
		'supports'            => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'work', $args );
}

add_action( 'init', 'pyxl_post_type_work' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_clients() {
	$labels = [
		'name'               => __( 'Clients', 'pyxl' ),
		'singular_name'      => __( 'Client', 'pyxl' ),
		'add_new'            => _x( 'Add New Client', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Client', 'pyxl' ),
		'edit_item'          => __( 'Edit Client', 'pyxl' ),
		'new_item'           => __( 'New Client', 'pyxl' ),
		'view_item'          => __( 'View Clients', 'pyxl' ),
		'search_items'       => __( 'Search Clients', 'pyxl' ),
		'not_found'          => __( 'No Clients found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Clients found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Clients:', 'pyxl' ),
		'menu_name'          => __( 'Clients', 'pyxl' ),
	];

	$args = [
		'labels'              => $labels,
		'hierarchical'        => true,
		'description'         => 'Clients',
		'taxonomies'          => [],
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-groups',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'supports'            => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'clients', $args );
}

add_action( 'init', 'pyxl_post_type_clients' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_talents() {
	$labels = [
		'name'               => __( 'Talents', 'pyxl' ),
		'singular_name'      => __( 'Talent', 'pyxl' ),
		'add_new'            => _x( 'Add New Talent', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Talent', 'pyxl' ),
		'edit_item'          => __( 'Edit Talent', 'pyxl' ),
		'new_item'           => __( 'New Talent', 'pyxl' ),
		'view_item'          => __( 'View Talent', 'pyxl' ),
		'search_items'       => __( 'Search Talents', 'pyxl' ),
		'not_found'          => __( 'No Talents found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Talents found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Talent:', 'pyxl' ),
		'menu_name'          => __( 'Talents', 'pyxl' ),
	];

	$args = [
		'labels'          => $labels,
		'hierarchical'    => false,
		'description'     => 'description',
		'taxonomies'      => [],
		'public'          => true,
		'show_ui'         => true,
		'menu_position'   => null,
		'menu_icon'       => 'dashicons-awards',
		'query_var'       => 'services',
		'can_export'      => true,
		'rewrite'         => [
			'with_front' => false,
			'slug'       => 'services',
		],
		'capability_type' => 'post',
		'supports'        => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'talents', $args );
}

add_action( 'init', 'pyxl_post_type_talents' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_careers() {
	$labels = [
		'name'               => __( 'Job Openings', 'pyxl' ),
		'singular_name'      => __( 'Job Opening', 'pyxl' ),
		'add_new'            => _x( 'Add New Job Opening', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Job Opening', 'pyxl' ),
		'edit_item'          => __( 'Edit Job Opening', 'pyxl' ),
		'new_item'           => __( 'New Job Opening', 'pyxl' ),
		'view_item'          => __( 'View Job Opening', 'pyxl' ),
		'search_items'       => __( 'Search Job Openings', 'pyxl' ),
		'not_found'          => __( 'No Job Openings found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Job Openings found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Job Opening:', 'pyxl' ),
		'menu_name'          => __( 'Job Openings', 'pyxl' ),
	];

	$args = [
		'labels'            => $labels,
		'hierarchical'      => false,
		'description'       => 'description',
		'taxonomies'        => [],
		'public'            => true,
		'show_ui'           => true,
		'show_in_admin_bar' => true,
		'menu_position'     => null,
		'menu_icon'         => 'dashicons-clipboard',
		'has_archive'       => true,
		'query_var'         => true,
		'can_export'        => true,
		'rewrite'           => [
			'slug'       => 'career',
			'with_front' => false,
		],
		'capability_type'   => 'post',
		'supports'          => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'job-opening', $args );
}

add_action( 'init', 'pyxl_post_type_careers' );

/**
 * Registers a new post type
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * @uses $wp_post_types Inserts new post type object into the list
 *
 */
function pyxl_post_type_landing_page() {
	$labels = [
		'name'               => __( 'Landing Pages', 'pyxl' ),
		'singular_name'      => __( 'Landing Page', 'pyxl' ),
		'add_new'            => _x( 'Add New Landing Page', 'pyxl', 'pyxl' ),
		'add_new_item'       => __( 'Add New Landing Page', 'pyxl' ),
		'edit_item'          => __( 'Edit Landing Page', 'pyxl' ),
		'new_item'           => __( 'New Landing Page', 'pyxl' ),
		'view_item'          => __( 'View Landing Page', 'pyxl' ),
		'search_items'       => __( 'Search Landing Pages', 'pyxl' ),
		'not_found'          => __( 'No Landing Pages found', 'pyxl' ),
		'not_found_in_trash' => __( 'No Landing Pages found in Trash', 'pyxl' ),
		'parent_item_colon'  => __( 'Parent Landing Page:', 'pyxl' ),
		'menu_name'          => __( 'Landing Pages', 'pyxl' ),
	];

	$args = [
		'labels'            => $labels,
		'hierarchical'      => false,
		'description'       => 'Pyxl Landing Pages',
		'taxonomies'        => [],
		'public'            => true,
		'show_ui'           => true,
		'show_in_admin_bar' => true,
		'menu_position'     => null,
		'menu_icon'         => 'dashicons-media-document',
		'has_archive'       => true,
		'query_var'         => true,
		'can_export'        => true,
		'rewrite'           => [
			'slug'       => 'landing',
			'with_front' => false,
		],
		'capability_type'   => 'post',
		'supports'          => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		],
	];

	register_post_type( 'landing-page', $args );
}

add_action( 'init', 'pyxl_post_type_landing_page' );

/**
 * Create a taxonomy
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 */
function pyxl_taxonomy_industry() {
	$labels = [
		'name'                  => _x( 'Industries', 'Taxonomy plural name', 'pyxl' ),
		'singular_name'         => _x( 'Industry', 'Taxonomy singular name', 'pyxl' ),
		'search_items'          => __( 'Search Industries', 'pyxl' ),
		'popular_items'         => __( 'Popular Industries', 'pyxl' ),
		'all_items'             => __( 'All Industries', 'pyxl' ),
		'parent_item'           => __( 'Parent Industry', 'pyxl' ),
		'parent_item_colon'     => __( 'Parent Industry', 'pyxl' ),
		'edit_item'             => __( 'Edit Industry', 'pyxl' ),
		'update_item'           => __( 'Update Industry', 'pyxl' ),
		'add_new_item'          => __( 'Add New Industry', 'pyxl' ),
		'new_item_name'         => __( 'New Industry Name', 'pyxl' ),
		'add_or_remove_items'   => __( 'Add or remove Industries', 'pyxl' ),
		'choose_from_most_used' => __( 'Choose from most used Industries', 'pyxl' ),
		'menu_name'             => __( 'Industry', 'pyxl' ),
	];

	$args = [
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => [],
	];

	register_taxonomy( 'industry', [ 'post', 'work', 'resources' ], $args );
}

add_action( 'init', 'pyxl_taxonomy_industry' );

/**
 * Create a taxonomy
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 */
function pyxl_taxonomy_topic() {
	$labels = [
		'name'                  => _x( 'Topics', 'Taxonomy plural name', 'pyxl' ),
		'singular_name'         => _x( 'Topic', 'Taxonomy singular name', 'pyxl' ),
		'search_items'          => __( 'Search Topics', 'pyxl' ),
		'popular_items'         => __( 'Popular Topics', 'pyxl' ),
		'all_items'             => __( 'All Topics', 'pyxl' ),
		'parent_item'           => __( 'Parent Topic', 'pyxl' ),
		'parent_item_colon'     => __( 'Parent Topic', 'pyxl' ),
		'edit_item'             => __( 'Edit Topic', 'pyxl' ),
		'update_item'           => __( 'Update Topic', 'pyxl' ),
		'add_new_item'          => __( 'Add New Topic', 'pyxl' ),
		'new_item_name'         => __( 'New Topic Name', 'pyxl' ),
		'add_or_remove_items'   => __( 'Add or remove Topics', 'pyxl' ),
		'choose_from_most_used' => __( 'Choose from most used Topics', 'pyxl' ),
		'menu_name'             => __( 'Topic', 'pyxl' ),
	];

	$args = [
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => [],
	];

	register_taxonomy( 'topic', [ 'post', 'work', 'resources' ], $args );
}

add_action( 'init', 'pyxl_taxonomy_topic' );

/**
 * Create a taxonomy
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 */
function pyxl_taxonomy_type() {
	$labels = [
		'name'                  => _x( 'Type', 'Taxonomy plural name', 'pyxl' ),
		'singular_name'         => _x( 'Type', 'Taxonomy singular name', 'pyxl' ),
		'search_items'          => __( 'Search Type', 'pyxl' ),
		'popular_items'         => __( 'Popular Type', 'pyxl' ),
		'all_items'             => __( 'All Type', 'pyxl' ),
		'parent_item'           => __( 'Parent Type', 'pyxl' ),
		'parent_item_colon'     => __( 'Parent Type', 'pyxl' ),
		'edit_item'             => __( 'Edit Type', 'pyxl' ),
		'update_item'           => __( 'Update Type', 'pyxl' ),
		'add_new_item'          => __( 'Add New Type', 'pyxl' ),
		'new_item_name'         => __( 'New Type Name', 'pyxl' ),
		'add_or_remove_items'   => __( 'Add or remove Type', 'pyxl' ),
		'choose_from_most_used' => __( 'Choose from most used Type', 'pyxl' ),
		'menu_name'             => __( 'Type', 'pyxl' ),
	];

	$args = [
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => [],
	];

	register_taxonomy( 'type', [ 'resources' ], $args );
}

add_action( 'init', 'pyxl_taxonomy_type' );
