<?php
/**
 * Template:			taxonomies.php
 * Description:			Register custom taxonomies for posts or custom post type
 */


/**
 * Register Custom Taxonomy
 * Uncomment to create the post type
 * 
 * @since	1.0
 */
add_action( 'init', 'create_products_taxonomy', 0 );
function create_products_taxonomy() {
    $labels = array(
        'name'              => _x( 'Product group', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Products group', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Product group', 'textdomain' ),
        'all_items'         => __( 'All Product groups', 'textdomain' ),
        'parent_item'       => __( 'Parent Product group', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Product group', 'textdomain' ),
        'edit_item'         => __( 'Edit Product group', 'textdomain' ),
        'update_item'       => __( 'Update Product group', 'textdomain' ),
        'add_new_item'      => __( 'Add new Product group', 'textdomain' ),
        'new_item_name'     => __( 'New Product group Name', 'textdomain' ),
        'menu_name'         => __( 'Product group', 'textdomain' ),
    );

    // Category
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'publicly_queryable' => true,
        'rewrite'           => array (
            'slug'=>'product-group'
        )
    );

    register_taxonomy( 'products_tax', array( 'products' ), $args );

    //Industry of use
    $labels = array(
		'name'              => _x( 'Applications', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Application', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Applications', 'textdomain' ),
		'all_items'         => __( 'All Industries', 'textdomain' ),
		'parent_item'       => __( 'Parent Application', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Application:', 'textdomain' ),
		'edit_item'         => __( 'Edit Application', 'textdomain' ),
		'update_item'       => __( 'Update Application', 'textdomain' ),
		'add_new_item'      => __( 'Add New Application', 'textdomain' ),
		'new_item_name'     => __( 'New Application Name', 'textdomain' ),
		'menu_name'         => __( 'Applications', 'textdomain' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'publicly_queryable' => true,
        'rewrite'           => array (
            'slug'=>'product-application'
        )
    );

    register_taxonomy( 'industry_of_use', array( 'products' ), $args );

    //End products
    $labels = array(
        'name'              => _x( 'End products', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'End product', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search End products', 'textdomain' ),
        'all_items'         => __( 'All End products', 'textdomain' ),
        'parent_item'       => __( 'Parent End product', 'textdomain' ),
        'parent_item_colon' => __( 'Parent End product:', 'textdomain' ),
        'edit_item'         => __( 'Edit End product', 'textdomain' ),
        'update_item'       => __( 'Update End product', 'textdomain' ),
        'add_new_item'      => __( 'Add New End product', 'textdomain' ),
        'new_item_name'     => __( 'New End product Name', 'textdomain' ),
        'menu_name'         => __( 'End product', 'textdomain' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'end-products'
        )
    );

    register_taxonomy( 'end_products', array( 'products' ), $args );

    //Polymers of use
    $labels = array(
        'name'              => _x( 'Polymers of use', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Polymer of use', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Polymers of use', 'textdomain' ),
        'all_items'         => __( 'All Polymers of use', 'textdomain' ),
        'parent_item'       => __( 'Parent Polymer of use', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Polymer of use:', 'textdomain' ),
        'edit_item'         => __( 'Edit Polymer of use', 'textdomain' ),
        'update_item'       => __( 'Update Polymer of use', 'textdomain' ),
        'add_new_item'      => __( 'Add New Polymer of use', 'textdomain' ),
        'new_item_name'     => __( 'New Polymer of use Name', 'textdomain' ),
        'menu_name'         => __( 'Polymer of use', 'textdomain' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'polymers-of-use'
        )
    );

    register_taxonomy( 'polumers_of_use', array( 'products' ), $args );

    //Stock
    $labels = array(
        'name'              => _x( 'Stock', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Stock', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Stock', 'textdomain' ),
        'all_items'         => __( 'All Stock', 'textdomain' ),
        'parent_item'       => __( 'Parent Stock', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Stock:', 'textdomain' ),
        'edit_item'         => __( 'Edit Stock', 'textdomain' ),
        'update_item'       => __( 'Update Stock', 'textdomain' ),
        'add_new_item'      => __( 'Add New Stock', 'textdomain' ),
        'new_item_name'     => __( 'New Stock Name', 'textdomain' ),
        'menu_name'         => __( 'Stock', 'textdomain' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'stock'
        )
    );

    register_taxonomy( 'stock', array( 'products' ), $args );

    //Features
    $labels = array(
        'name'              => _x( 'Features', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Feature', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Features', 'textdomain' ),
        'all_items'         => __( 'All Features', 'textdomain' ),
        'parent_item'       => __( 'Parent Feature', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Feature:', 'textdomain' ),
        'edit_item'         => __( 'Edit Feature', 'textdomain' ),
        'update_item'       => __( 'Update Feature', 'textdomain' ),
        'add_new_item'      => __( 'Add New Feature', 'textdomain' ),
        'new_item_name'     => __( 'New Feature Name', 'textdomain' ),
        'menu_name'         => __( 'Features', 'textdomain' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'features'
        )
    );

    register_taxonomy( 'features', array( 'products' ), $args );

    //Specifications
    $labels = array(
    'name'              => _x( 'Specifications', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'Specification', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search Specifications', 'textdomain' ),
    'all_items'         => __( 'All Specifications', 'textdomain' ),
    'parent_item'       => __( 'Parent Specification', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Specification:', 'textdomain' ),
    'edit_item'         => __( 'Edit Specification', 'textdomain' ),
    'update_item'       => __( 'Update Specification', 'textdomain' ),
    'add_new_item'      => __( 'Add New Specification', 'textdomain' ),
    'new_item_name'     => __( 'New Specification Name', 'textdomain' ),
    'menu_name'         => __( 'Specifications', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'specifications'
        )
    );

    register_taxonomy( 'specifications', array( 'products' ), $args );

     //Packaging
     $labels = array(
        'name'              => _x( 'Packaging', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Packaging', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Packaging', 'textdomain' ),
        'all_items'         => __( 'All Packaging', 'textdomain' ),
        'parent_item'       => __( 'Parent Packaging', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Packaging:', 'textdomain' ),
        'edit_item'         => __( 'Edit Packaging', 'textdomain' ),
        'update_item'       => __( 'Update Packaging', 'textdomain' ),
        'add_new_item'      => __( 'Add New Packaging', 'textdomain' ),
        'new_item_name'     => __( 'New Packaging Name', 'textdomain' ),
        'menu_name'         => __( 'Packaging', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'packaging'
        )
    );

    register_taxonomy( 'packaging', array( 'products' ), $args );

     //Product form
     $labels = array(
        'name'              => _x( 'Product form', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Product form', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Product form', 'textdomain' ),
        'all_items'         => __( 'All Product form', 'textdomain' ),
        'parent_item'       => __( 'Parent Product form', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Product form:', 'textdomain' ),
        'edit_item'         => __( 'Edit Product form', 'textdomain' ),
        'update_item'       => __( 'Update Product form', 'textdomain' ),
        'add_new_item'      => __( 'Add New Product form', 'textdomain' ),
        'new_item_name'     => __( 'New Product form Name', 'textdomain' ),
        'menu_name'         => __( 'Product form', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'product-form'
        )
    );

    register_taxonomy( 'product-form', array( 'products' ), $args );

     //Sub-industry
     $labels = array(
        'name'              => _x( 'Sub-industry', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Sub-industry', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Sub-industry', 'textdomain' ),
        'all_items'         => __( 'All Sub-industry', 'textdomain' ),
        'parent_item'       => __( 'Parent Sub-industry', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Sub-industry:', 'textdomain' ),
        'edit_item'         => __( 'Edit Sub-industry', 'textdomain' ),
        'update_item'       => __( 'Update Sub-industry', 'textdomain' ),
        'add_new_item'      => __( 'Add New Sub-industry', 'textdomain' ),
        'new_item_name'     => __( 'New Sub-industry Name', 'textdomain' ),
        'menu_name'         => __( 'Sub-industry', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'meta_box_cb'       => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array (
            'slug'=>'sub-industry'
        )
    );

    register_taxonomy( 'sub-industry', array( 'products' ), $args );
   
};