<?php

// Register Custom Post Type
function unslider() {

	$labels = array(
		'name'                => _x( 'Slides', 'Post Type General Name', 'tp_unslider' ),
		'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'tp_unslider' ),
		'menu_name'           => __( 'Image Slides', 'tp_unslider' ),
		'parent_item_colon'   => __( 'Parent Item:', 'tp_unslider' ),
		'all_items'           => __( 'All Slides', 'tp_unslider' ),
		'view_item'           => __( 'View', 'tp_unslider' ),
		'add_new_item'        => __( 'Add New Slide', 'tp_unslider' ),
		'add_new'             => __( 'Add Slide', 'tp_unslider' ),
		'edit_item'           => __( 'Edit Slide', 'tp_unslider' ),
		'update_item'         => __( 'Update Slide', 'tp_unslider' ),
		'search_items'        => __( 'Search Slide', 'tp_unslider' ),
		'not_found'           => __( 'Not found', 'tp_unslider' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'tp_unslider' ),
	);
	$args = array(
		'label'               => __( 'Unslider', 'tp_unslider' ),
		'description'         => __( 'Image slides', 'tp_unslider' ),
		'labels'              => $labels,
		'supports'            => array( 'editor', 'thumbnail', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-gallery',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'unslider', $args );

}

// Hook into the 'init' action
add_action( 'init', 'unslider', 0 );

add_filter( 'manage_edit-unslider_columns', 'my_edit_unslider_columns' ) ;

function my_edit_unslider_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'post_id' => __('Slide ID', 'tp_unslider'),
		'thumbnail' => __('Thumbnail', 'tp_unslider'),
		'post_edit' => __('Edit', 'tp_unslider')
	);

	return $columns;
}

function my_custom_unslider_columns($column)
{
	global $post;
	if($column == 'thumbnail')
	{
		echo get_the_post_thumbnail($post_id, array(100,100) );
	}

	if($column == 'post_id')
	{
		echo get_the_ID();
	}

	if($column == 'post_edit')
	{
		echo '<a href="'.get_edit_post_link().'">'. __('Edit', 'tp_unslider') .'</a>';
	}
}

add_action("manage_pages_custom_column", "my_custom_unslider_columns");

?>