<?php

/**
 * All the templates to include
 * 
 */
$templates = array(	
	'lib/ajax.php',				// Ajax functions
	'lib/filters.php',			// Filter hooks
	'lib/helpers.php',			// Helper functions
	'lib/theme.php',			// Theme support configuration
	'lib/post-types.php',		// Post Types registration
	'lib/taxonomies.php',		// Taxonomies registration
	'lib/customizer.php',		// Customizer modifications
	'lib/enqueue.php',			// Enqueue CSS and JS
	'lib/admin.php',			// Custom admin settings
	'lib/head.php',				// wp_head functions
	'lib/body.php',				// wp_body_open functions
	'lib/rest.php',				// Rest API configuration
	'lib/widgets.php',			// Widget registration
	'lib/plugins.php',			// Plugins
);

foreach ( $templates as $template ) {
	locate_template( $template, true, true );
}

/**
 * All the classes to include
 * 
 */
$classes = array(	
	// 'classes/nav-walker.php',					// Custom Navigation Walker
	// 'classes/widget-button.php',				// Button Widget
	'classes/widget-social.php',				// Social Widget
	// 'classes/widget-highlight-post.php',		// Highlight Post Widget
	// 'classes/tinymce-customizer.php',			// TinyMCE Customizer
);

foreach ( $classes as $class ) {
	locate_template( $class, true, true );
}

add_theme_support('menus');

add_theme_support( 'title-tag' );

show_admin_bar(false);

add_theme_support( 'post-thumbnails' );

function cf_search_join( $join ) {
    global $wpdb;
    if ( is_search() ) {
    $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
    }
    add_filter('posts_join', 'cf_search_join' );
    /**
    * Modify the search query with posts_where
    *
    * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
    */
    function cf_search_where( $where ) {
    global $pagenow, $wpdb;
    if ( is_search() ) {
    $where = preg_replace(
    "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
    "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }
    return $where;
    }
    add_filter( 'posts_where', 'cf_search_where' );
    /**
    * Prevent duplicates
    *
    * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
    */
    function cf_search_distinct( $where ) {
    global $wpdb;
    if ( is_search() ) {
    return "DISTINCT";
    }
    return $where;
    }
    add_filter( 'posts_distinct', 'cf_search_distinct' );

function wpse83602_search_query( $query )
{
    if (
        ! $query->is_search()
        OR $query->is_admin
    )
        return $query;

    add_filter( 'posts_distinct', 'wpse83602_posts_distinct' );
    return $query;
}

//AJAX
function js_variables(){
    $variables = array (
        'ajax_url' => admin_url('admin-ajax.php'),
    );
    echo '<script type="text/javascript">window.wp_data = ' . json_encode($variables) . ';</script>';
}
add_action('wp_head','js_variables');

// NEW FUNCTION FOR PRODUCTS

$get_product_count = 0;

// Template part load function
function load_template_part($template) {
    ob_start();
    get_template_part($template);
    $template_content = ob_get_contents();
    ob_end_clean();
    return $template_content;
}

function get_products() {
    global $post;
    $product_id = $_POST['product_id'] ? $_POST['product_id'] : ''; //получаем POST данные 
    $paged = $_POST['paged'] ? $_POST['paged'] : 1; // Если в paged пусто, то будем считать, что нужна первая страница
    $return_html = ''; // Весь HTML код мы записываем в переменную
    $return_html02 = ''; // Весь HTML код мы записываем в переменную
    $cta_form = load_template_part( '/template-parts/cta' );

    $args = array(
        'post_type'     => 'products',
        'orderby'       => 'menu_order',
        'post_status'        => 'publish',
        'order'    => 'ASC',
        'tax_query'     => array(
            'relation'  => 'AND',
        )
    );

    // List for valid taxonomies that are found.
    $taxonomies = array();
    $terms      = array();
    $valid_taxonomies = array( 'products_tax', 'industry_of_use', 'end_products', 'polumers_of_use', 'features' );

    // Get query from $_POST array
    foreach ( $_POST as $item => $values ) { 
        if ( in_array( $item, $valid_taxonomies ) ) {
            $args[ 'tax_query' ][] = array(
                'taxonomy'  => $item,
                'terms'     => $values,
                'include_children' => false,
                'operator' => 'AND'
            );
            array_push( $taxonomies, $item );
            $terms = array_merge( $terms, $values );
        }
    }

    if ( !empty( $terms ) ) {
        $return_html .= '<div class="product-search product-search--alt">';
        // Filter labels
        $return_html .= '
        <div class="filter-buttons">
            <a href="'. get_the_permalink(3688) .'" id="buttonClear" class="button-clear">Clear all Filters</a>
        ';

        foreach ( $terms as $term_id ) { 
            // Create labels
            $term = get_term( $term_id );
            // $category_link = get_category_link( $cat->cat_ID );
            $term_name = $term->name;
            $return_html .= '<a class="button-category">'. $term_name . '<span class="icon icon-cancel" data-category="'.$term_id .'"></span></a>';
        }

        if ( !empty( $terms ) ) {
            $return_html .= '</div>';
        }

        if ( !empty( $terms ) ) {

            $valid_ids = array(8, 10, 4, 116, 11, 7, 415, 424, 454, 330, 332, 329, 331, 328, 333, 658, 588, 532, 139, 455, 589, 503, 487, 443);
            $valid_terms = [];
            
            foreach ( $terms as $term ) {
                if ( in_array( $term, $valid_ids ) ) {
                    array_push( $valid_terms, $term );
                }
            }

            $last_term = end( $valid_terms );
            $term_object = get_term( $last_term, 'products_tax' );
            $description = wp_trim_words( $term_object->description, 40, '...' );

            if ( $last_term && $description ) {
                $return_html .= 
                '<div id="products-category-description" class="filter-category-description">
                <h3>' . $term_object->name . '</h3>
                <p>' . $description . '</p>
                <a href="https://www.partinchem.com/product-group/' . $term_object->slug . '" target="_blank">Read more</a>
                </div>';
            }

        }

        $query = new WP_Query( $args );
    
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                // Products
                $return_html .= '
                <div class="item item--alt js-search-item">
                    <div class="product product-green simpleCart_shelfItem">
                        <a href="' . get_the_permalink() .'" target="_blank" class="link-modal"></a>
                        <div class="product-info">
                            <h2 class="size3 product-title js-search-title">'. get_the_title() .'<span style="display:none;">' . get_field( 'synonyms') . ' ' . get_field( 'product_composition')[ 'cas_numbers' ] . ' ' . get_field( 'abbreviation_product_name') . ' '  . get_field( 'product_composition')[ 'eu_eg' ] . '</span></h2>
                                <div class="product-desc"><p>
                                '. wp_trim_words( get_field('product_description_short'), 20, '...' ) .'
                                </p></div>
                        </div>
                        <button class="button-more" href="'. get_the_permalink() .'">More information</button>
                    </div>
                </div>';
            } wp_reset_postdata();
        } else {
            $return_html .= '<div class="no-results" style="display:none;">ajaxnoresultsfound</div>';

            // $return_html .=   
            // '<div class="product-form">
            //     <h3>Can\'t find the product you\'re looking for? Send us your request</h3>
            //     <a class="button button-light" title="request" href="mailto:info@partinchem.com">Send E-mail</a>
            // </div>';    

            // $return_html .= '<div class="product-form">' . $cta_form . '</div>';

        }

        // $return_html .=   
        // '<div class="product-form" style="display:none;">
        //     <h3>Can\'t find the product you\'re looking for? Send us your request</h3>
        //     <a class="button button-light" title="request" href="mailto:info@partinchem.com">Send E-mail</a>
        // </div>';

        // $return_html .= '<div class="product-form" style="display:none;">' . $cta_form . '</div>';

        //    Initially hidden items
        $args = array(
            'post_type'           => 'products',
            'posts_per_page'      => '-1',
            'post_status'         => 'publish'
        );
        
        $products = new WP_Query( $args );

        if ( $products->have_posts() ) { while ( $products->have_posts() ) { $products->the_post();
            $product_group_array = get_field( 'product_group');  
            $string_array = [];
            foreach( $product_group_array as $i => $i_value ) {
                array_push( $string_array, $i_value->name );
            }
            $string_tax = implode(' ',$string_array);
            $return_html .= 
            '<div class="item item--alt item--hidden js-search-item" style="display:none;">
                <div class="product product-green simpleCart_shelfItem">
                    <a href="' . get_the_permalink() . '" target="_blank" class="link-modal"></a>
                    <div class="product-info">
                        <h2 class="size3 product-title">' . get_the_title() . '<span style="display:none;">' . get_field( 'synonyms' ) . ' ' . get_field( 'product_composition')[ 'cas_numbers' ] . ' ' . get_field( 'abbreviation_product_name' ) . ' ' . get_field( 'product_composition')[ 'eu_eg' ] . ' ' . $string_tax . '</span></h2>
                        <div class="product-desc"><p>' . wp_trim_words( get_field('product_description_short'), 20, '...' ) . '<p></div>
                    </div>
                    <button class="button-more" onclick="window.location.href=' . get_the_permalink() . '">More information</button>
                </div>
            </div>'; 
        } } wp_reset_postdata();


        echo $return_html;

    } else {

        if ( get_field( 'featured_product-featured', 3688)) {
            $idPost =  get_field('featured_product-featured', 3688);

            $return_html02 .= '<div class="item item--alt item--featured">
            <div class="product product-green simpleCart_shelfItem">
                <a href="' . get_the_permalink( $idPost ) . '" target="_blank" class="link-modal"></a>
                <div class="product-info">
                    <h2 class="size3 product-title js-search-title">'. get_the_title($idPost) .'<span style="display:none;">' . get_field( 'synonyms', $idPost) . ' ' . get_field( 'product_composition', $idPost)[ 'cas_numbers' ] . ' ' . get_field( 'abbreviation_product_name', $idPost) . ' ' . get_field( 'product_composition', $idPost)[ 'eu_eg' ] . '</span></h2>
                    <div class="product-desc"><p>
                    '. wp_trim_words( get_field('product_description_short', $idPost), 20, '...' ) .'
                    </p></div>
                </div>
                <button class="button-more" href="'. get_the_permalink($idPost) .'">More information</button>
            </div>
            </div>';
        }

        if ( get_field( 'featured_categories', 3688)) {

            $categories = get_field( 'featured_categories', 3688 );                        
            $count = 0;
            foreach ( $categories as $category ) { 
                $count++; 
                if ( $count === 3 ) { break; } ;
                $return_html02 .= 
                '<div class="item item--small">
                    <a style="cursor:pointer;" href="' . get_home_url() . '/product-group/' . $category->slug . '/" class="product product-blue product--alt">
                        <div class="product-info product-info--category">
                            <span class="product-group">Product group</span>
                            <h2 class="size3 product-title">'. $category->name .'</h2>
                        </div>
                        <button class="button-more button-more--alt" onclick="window.location.href="#"">View products</button>
                    </a>              
                </div>';
            };
        };

        if ( get_field( 'featured_product-new', 3688)) {
            $idPost =  get_field('featured_product-new', 3688);

            $return_html02 .= '<div class="item item--alt item--new">
            <div class="product product-green simpleCart_shelfItem">
                <a href="' . get_the_permalink( $idPost ) . '" target="_blank" class="link-modal"></a>
                <div class="product-info">
                    <h2 class="size3 product-title js-search-title">'. get_the_title($idPost) .'<span style="display:none;">' . get_field( 'synonyms', $idPost) . ' ' . get_field( 'product_composition', $idPost)[ 'cas_numbers' ] . ' ' . get_field( 'abbreviation_product_name', $idPost) . ' ' . get_field( 'product_composition', $idPost)[ 'eu_eg' ] . '</span></h2>
                    <div class="product-desc"><p>
                    '. wp_trim_words( get_field('product_description_short', $idPost), 20, '...' ) .'
                    </p></div>
                </div>
                <button class="button-more" href="'. get_the_permalink($idPost) .'">More information</button>
            </div>
            </div>';
        };

        if ( get_field( 'featured_categories', 3688)) {

            $categories = get_field( 'featured_categories', 3688 );                        
            $count = 0;
            foreach ( $categories as $category ) { 
                $count++;
                if ( $count === 3 || $count === 4 ) { 
                    $return_html02 .= 
                    '<div class="item item--small">
                        <a style="cursor:pointer;" href="' . get_home_url() . '/product-group/' . $category->slug . '/" class="product product-blue product--alt">
                            <div class="product-info product-info--category">
                                <span class="product-group">Product group</span>
                                <h2 class="size3 product-title">'. $category->name .'</h2>
                            </div>
                            <button class="button-more button-more--alt" onclick="window.location.href="#"">View products</button>
                        </a>              
                    </div>';
                };
            };
        };

        // Blog post 
        $idBlog1 =  get_field('featured_blog_1', 3688); 

        $return_html02 .=
        '<div class="item item--alt item--blog">
            <div class="item__thumbnail" style="background-image: url(' . get_the_post_thumbnail_url( $idBlog1, 'large' ) . ')"></div>
            <div class="product product-green product--alt product--blog simpleCart_shelfItem">
                <a href="' . get_the_permalink($idBlog1) . '" target="_blank" class="link-modal"></a>
                <div class="product-info">
                    <h2 class="size3 product-title">' . get_the_title($idBlog1) . '</h2>
                    <div class="product-desc">
                        <p>' . wp_trim_words( $idBlog1->post_content, 20, '...' ) . '<p>
                    </div>
                </div>
                <button class="button-more">Read more</button>
            </div>
        </div>';

        // Blog post 
        $idBlog2 =  get_field('featured_blog_2', 3688); 

        $return_html02 .=
        '<div class="item item--alt item--blog">
            <div class="item__thumbnail" style="background-image: url(' . get_the_post_thumbnail_url( $idBlog2, 'large' ) . ')"></div>
            <div class="product product-green product--alt product--blog simpleCart_shelfItem">
                <a href="' . get_the_permalink($idBlog2) . '" target="_blank" class="link-modal"></a>
                <div class="product-info">
                    <h2 class="size3 product-title">' . get_the_title($idBlog2) . '</h2>
                    <div class="product-desc">
                        <p>' . wp_trim_words( $idBlog2->post_content, 20, '...' ) . '<p>
                    </div>
                </div>
                <button class="button-more">Read more</button>
            </div>
        </div>';

        // Initially hidden form
        // $return_html02 .=   
        // '<div class="product-form" style="display:none;">
        //     <h3>Can\'t find the product you\'re looking for? Send us your request</h3>
        //     <a class="button button-light" title="request" href="mailto:info@partinchem.com">Send E-mail</a>
        // </div>';

        // $return_html .= '<div class="product-form" style="display:none;>' . $cta_form . '</div>';

        //    Initially hidden items
        $args = array(
        'post_type'           => 'products',
        'posts_per_page'      => '-1',
        'post_status'         => 'publish'
        );
        
        $products = new WP_Query( $args );

        if ( $products->have_posts() ) { while ( $products->have_posts() ) { $products->the_post(); 
            $product_group_array = get_field( 'product_group'); 
            $string_array = [];
            foreach( $product_group_array as $i => $i_value ) {
                array_push( $string_array, $i_value->name );
            }
            $string_tax = implode(' ',$string_array);
            $return_html02 .= 
            '<div class="item item--alt item--hidden js-search-item" style="display:none;">
                <div class="product product-green simpleCart_shelfItem">
                    <a href="' . get_the_permalink() . '" target="_blank" class="link-modal"></a>
                    <div class="product-info">
                        <h2 class="size3 product-title">' . get_the_title() . '<span style="display:none;">' . get_field( 'synonyms' ) . ' ' . get_field( 'product_composition')[ 'cas_numbers' ] . ' ' . get_field( 'abbreviation_product_name' ) . ' ' . get_field( 'product_composition')[ 'eu_eg' ] . ' ' . $string_tax . '</span></h2>
                        <div class="product-desc"><p>' . wp_trim_words( get_field('product_description_short'), 20, '...' ) . '<p></div>
                    </div>
                    <button class="button-more" onclick="window.location.href=' . get_the_permalink() . '">More information</button>
                </div>
            </div>'; 
        } } wp_reset_postdata();

        echo $return_html02;

        // HTML END
    }


    wp_die(); // обязательно "умираем"
}

add_action('wp_ajax_get_products', 'get_products'); // наши хуки
add_action('wp_ajax_nopriv_get_products', 'get_products');

//END AJAX

function posts_link_next_class($format){
    $format = str_replace('href=', 'class="post-link" href=', $format);
    return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
    $format = str_replace('href=', 'class="post-link" href=', $format);
    return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');


/**
 *
 * Menus
 *
 */

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header menu' ),
            'footer-menu-products' => __( 'Footer menu - Products' ),
            'footer-menu-company' => __( 'Footer menu - Company' ),
            'footer-menu-resources' => __( 'Footer menu - Resources' ),
			'footer-menu-contacts' => __( 'Footer menu - Contacts' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );

function new_excerpt_length($length) {
    return 15;
  }

add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


//Thank you modal

add_action( 'wp_footer', 'mycustom_wp_footer' );

function mycustom_wp_footer() { ?>
    <script type="text/javascript">
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        if ( '107' == event.detail.contactFormId || '124' == event.detail.contactFormId) {
            $.fancybox.open([
                {
                    href: '#message-submit'
                }
            ],);
        };

        // if ( '93' == event.detail.contactFormId) {
        //     $.fancybox.close([
        //         {
        //             href: '#order'
        //         }
        //     ],);
        //     $.fancybox.open([
        //         {
        //             href: '#message-submit'
        //         }
        //     ],);
        // }

    }, false );
    </script>
<?php
}

// Automatically assign products to parent taxonomy upon save

add_action( 'set_object_terms', 'auto_set_parent_terms', 9999, 6 );
/**
 * Automatically set/assign parent taxonomy terms to posts
 * 
 * This function will automatically set parent taxonomy terms whenever terms are set on a post,
 * with the option to configure specific post types, and/or taxonomies.
 *
 *
 * @param int    $object_id  Object ID.
 * @param array  $terms      An array of object terms.
 * @param array  $tt_ids     An array of term taxonomy IDs.
 * @param string $taxonomy   Taxonomy slug.
 * @param bool   $append     Whether to append new terms to the old terms.
 * @param array  $old_tt_ids Old array of term taxonomy IDs.
 */
function auto_set_parent_terms( $object_id, $terms, $tt_ids, $taxonomy, $append, $old_tt_ids ) {
	/**
	 * We only want to move forward if there are taxonomies to set
	 */
	if( empty( $tt_ids ) ) return FALSE;
	/**
	 * Set specific post types to only set parents on.  Set $post_types = FALSE to set parents for ALL post types.
	 */
	$post_types = array( 'products' );
	if( $post_types !== FALSE && ! in_array( get_post_type( $object_id ), $post_types ) ) return FALSE;
	/**
	 * Set specific post types to only set parents on.  Set $post_types = FALSE to set parents for ALL post types.
	 */
	$tax_types = array( 'products_tax', 'end_products', 'industry_of_use', 'polymers_of_use' );
	if( $tax_types !== FALSE && ! in_array( $taxonomy, $tax_types ) ) return FALSE;
	
	foreach( $tt_ids as $tt_id ) {
		$parent = wp_get_term_taxonomy_parent_id( $tt_id, $taxonomy );
		if( $parent ) {
			wp_set_post_terms( $object_id, array($parent), $taxonomy, TRUE );
		}
	}
}

//Change default post permalink structure
add_filter(
    'register_post_type_args',
    function ($args, $post_type) {
        if ($post_type !== 'post') {
            return $args;
        }

        $args['rewrite'] = [
            'slug' => 'blog',
            'with_front' => true,
        ];

        return $args;
    },
    10,
    2
);

add_filter(
    'pre_post_link',
    function ($permalink, $post) {
        if ($post->post_type !== 'post') {
            return $permalink;
        }

        return '/blog/%postname%/';
    },
    10,
    2
);  

// Save post title to meta upon save
add_action('save_post', 'title_to_meta');

function title_to_meta($post_id) {
    update_post_meta($post_id, 'search_title', get_the_title($post_id)); 
}

// Save post taxonomies to meta upon save
add_action('save_post', 'terms_to_meta');

function terms_to_meta($post_id) {
    $term_names = [];
    $terms = get_the_terms( $post_id, 'products_tax' );

    foreach ( $terms as $term ) {
        array_push( $term_names, $term->name );
    }
    update_post_meta( $post_id, 'search_terms', implode( ', ', $term_names ) ); 
}