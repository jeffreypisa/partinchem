<?php
/**
 * Template:			post-types.php
 * Description:			Register custom post types to use in the page
 */

/**
 * Register custom post type
 * Uncomment to create the post type
 * 
 * @since	1.0
 */
function create_products() {
    register_post_type('products', array(
        'labels' => array(
            'name'            => __( 'Products', 'theme-domain' ),
            // 'singular_name'   => __( 'Post', 'theme-domain'  ),
            // 'add_new'         => __( 'Add post', 'theme-domain'  ),
            // 'add_new_item'    => __( 'New post', 'theme-domain'  ),
            // 'edit'            => __( 'Edit post', 'theme-domain'  ),
            // 'edit_item'       => __( 'Edit post', 'theme-domain'  ),
            // 'new_item'        => __( 'New post', 'theme-domain'  ),
            // 'all_items'       => __( 'All posts', 'theme-domain'  ),
            // 'view'            => __( 'View post', 'theme-domain'  ),
            // 'view_item'       => __( 'View post', 'theme-domain'  ),
            // 'search_items'    => __( 'Search post', 'theme-domain'  ),
            // 'not_found'       => __( 'Post not found', 'theme-domain'  ),
        ),
        'public' => true, // show in admin panel?
        'menu_position' => 5,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'taxonomies' => array( '' ),
        'has_archive' => false,
        'capability_type' => 'post',
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'menu_icon'   => 'dashicons-format-aside',
        'rewrite' => array(
            'slug' => 'products',
        ),
    ));
}
add_action( 'init', 'create_products' );


function create_application() {
    register_post_type('application', array(
        'labels' => array(
            'name'            => __( 'Applications', 'theme-domain' ),
            'singular_name'   => __( 'Application', 'theme-domain'  ),
            // 'add_new'         => __( 'Add post', 'theme-domain'  ),
            // 'add_new_item'    => __( 'New post', 'theme-domain'  ),
            // 'edit'            => __( 'Edit post', 'theme-domain'  ),
            // 'edit_item'       => __( 'Edit post', 'theme-domain'  ),
            // 'new_item'        => __( 'New post', 'theme-domain'  ),
            // 'all_items'       => __( 'All posts', 'theme-domain'  ),
            // 'view'            => __( 'View post', 'theme-domain'  ),
            // 'view_item'       => __( 'View post', 'theme-domain'  ),
            // 'search_items'    => __( 'Search post', 'theme-domain'  ),
            // 'not_found'       => __( 'Post not found', 'theme-domain'  ),
        ),
        'public' => true, // show in admin panel?
        'menu_position' => 6,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'taxonomies' => array( '' ),
        'has_archive' => false,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-networking',
    ));
}
add_action( 'init', 'create_application' );