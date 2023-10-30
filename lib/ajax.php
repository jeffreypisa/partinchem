<?php
/**
 * Template:			ajax.php
 * Description:			Ajax related functions
 */

 
/**
 * get_posts_ajax
 * 
 * Generic HTTP GET response that processes
 * all the parameters put through the query
 * to get the posts requested.
 * 
 * @since	1.0
 * @link	https://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_nopriv_(action)
 * @link	https://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_(action)
 * @return	string
 */
add_action( 'wp_ajax_nopriv_get_posts_ajax', 'get_posts_ajax') ;
add_action( 'wp_ajax_get_posts_ajax', 'get_posts_ajax' );

function get_posts_ajax() {
	header( 'Content-Type: text/html' );

	// Get the variables from the GET Request
	$query_post_type		= isset( $_REQUEST[ 'post_type' ] ) ? $_REQUEST[ 'post_type' ] : array( 'products' );
	$query_post_status		= isset( $_REQUEST[ 'post_status' ] ) ? $_REQUEST[ 'post_status' ] : array( 'publish' );	
	$query_posts_per_page	= isset( $_REQUEST[ 'posts_per_page' ] ) ? $_REQUEST[ 'posts_per_page' ] : -1;
	$query_paged			= isset( $_REQUEST[ 'paged' ] ) ? $_REQUEST[ 'paged' ] : 1;
	$query_offset			= isset( $_REQUEST[ 'offset' ] ) ? $_REQUEST[ 'offset' ] : '';
	$query_orderby			= isset( $_REQUEST[ 'orderby' ] ) ? $_REQUEST[ 'orderby' ] : 'date';
	$query_order 			= isset( $_REQUEST[ 'order' ] ) ? $_REQUEST[ 'order' ] : 'DESC';
	$query_p				= isset( $_REQUEST[ 'p' ] ) ? $_REQUEST[ 'p' ] : '';
	$query_s				= isset( $_REQUEST[ 's' ] ) ? $_REQUEST[ 's' ] : '';
	$query_post__in			= isset( $_REQUEST[ 'post__in'] ) ? $_REQUEST[ 'post__in' ] : array();
	$query_post__not_in		= isset( $_REQUEST[ 'post__not_in' ] ) ? $_REQUEST[ 'post__not-in' ] : array();
	$query_meta_key			= isset( $_REQUEST[ 'meta_key' ] ) ? $_REQUEST[ 'meta_key' ] : '';
	$query_meta_value		= isset( $_REQUEST[ 'meta_value' ] ) ? $_REQUEST[ 'meta_value' ] : '';
	$query_page_template	= isset( $_REQUEST[ 'page_template' ] ) ? $_REQUEST[ 'page_template' ] : '';
	$query_type				= isset( $_REQUEST[ 'type' ] ) ? $_REQUEST[ 'type' ] : '';
	$query_suppress_filters = isset( $_REQUEST[ 'suppress_filters' ] ) ? $_REQUEST[ 'suppress_filters' ] : true;
	$query_suppress_filters = isset( $_REQUEST[ 'suppress_filters' ] ) ? $_REQUEST[ 'suppress_filters' ] : true;
	$query_reset 			= isset( $_REQUEST[ 'reset' ] ) ? $_REQUEST[ 'reset' ] : false;

	// Set arguments for query
	$args = array(
		'post_type'			=> $query_post_type,
		'post_status'		=> $query_post_status,
		'posts_per_page'	=> intval( $query_posts_per_page ),
		'paged'				=> $query_paged,
		'offset'			=> $query_offset,
		'orderby'			=> $query_orderby,
		'order'				=> $query_order,
		'p'					=> $query_p,
		// 's'					=> $query_s,
		'post__in'			=> $query_post__in,
		'post__not_in'		=> $query_post__not_in,
		'meta_key'			=> $query_meta_key,
		'meta_value'		=> $query_meta_value,
		'tax_query'			=> array( 'relation' => 'AND'),
		// 'meta_query'		=> array(),
		'meta_query'		=> array( 'relation' => 'OR' ),
		'suppress_filters'  => $query_suppress_filters
	);

	// Fields to ignore for taxonomies
	$excludes = array(
		'action',
		'post_type',
		'posts_per_page',
		'post_status',
		'paged',
		'offset',
		'order',
		'orderby',
		'p',
		's',
		'cat',
		'tag',
		'post__in',
		'post__not_in',
		'meta_key',
		'meta_value',
		'_wp_nonce',
		'_wp_referrer',
		'post_paged',
		'max_num_pages',
		'page_template',
		'type',
		'submit',
		'reset'
	);

	if ( $query_reset ) {
		get_template_part( './template-parts/filter/filter', 'landing');
		get_template_part( './template-parts/card/card', 'cta');
	} else {
		// Get all registered taxonomies
		$taxonomies = ['products_tax', 'industry_of_use', 'polumers_of_use', 'stock' ];

		// Loop over remaining query items and pass them as taxonomy filters
		// Or when the keys are not in the taxonomies and also not in the ignores
		// add them to the meta_query array.
		if ( ! empty( $_REQUEST ) ) {
			$terms_arrays = [];
			foreach( $_REQUEST as $item => $value ) {
				$value_array = explode( ',', $value ); // Turn the stlring from "value,value" to array( "value", "value" )
				if ( in_array( $item, $taxonomies ) ) {
					if ( $value !== '*' ) {
						$args[ 'tax_query' ][] = array(
							'operator'			=> 'IN',
							'taxonomy'			=> $item,
							'field'				=> 'term_id',
							'terms'				=> $value,
							'include_children'  => false,
							'operator'			=> 'AND'
						);		
						array_push( $terms_arrays, implode( ', ', $value ) );
					}
				} else if ( $item === 's' && !empty( $value ) ) {
					$args[ 'meta_query' ][] = array(
						'key'				=> 'synonyms',
						'value'				=> strtolower( $value ),
						'compare'			=> 'LIKE',
					);
					$args[ 'meta_query' ][] = array(
						'key'				=> 'search_title',
						'value'				=> strtolower( $value ),
						'compare'			=> 'LIKE',
					);
					$args[ 'meta_query' ][] = array(
						'key'				=> 'search_terms',
						'value'				=> strtolower( $value ),
						'compare'			=> 'LIKE',
					);
				} 
			}
		}

		// Pretty elaborate way to get a list of the active term names for this request
		$active_terms = [];
		$active_term_names = [];

		foreach ( $terms_arrays as $term_array ) {
			array_push( $active_terms, get_terms( array( 'include' => $term_array ) ) ) ;
		}
		
		$merged_terms = array_merge(...$active_terms);
		
		foreach ( $merged_terms as $merged_term ) {
			array_push( $active_term_names, '<a href="#" class="js-active-filter" data-id="' . $merged_term->term_id . '">' . $merged_term->name . '<i class="fa fa-times" aria-hidden="true"></i></a>' );
		}

		if ( $args[ 'meta_query' ] ) {
			foreach ( $args[ 'meta_query' ] as $meta_item ) {
				if ( $meta_item[ 'key' ] === 'synonyms' || $meta_item[ 'key' ] === 'search_title' || $meta_item[ 'key' ] === 'search_terms' )  {
					array_push( $active_term_names, '<a href="#" class="js-active-filter" data-id="0">"' . $meta_item[ 'value' ] . '"<i class="fa fa-times" aria-hidden="true"></i></a>' );
				}
			}
		}

		$active_term_names = array_unique( $active_term_names );
		
		// Create a new query.
		$query = new WP_Query( $args );

		if ( is_user_logged_in ) {
			// debug( $query->found_posts );
			// debug($args);
		}

		// Loop over the query.
		if ( $query->have_posts() ) {
			$posts = $query->posts;

			$active_terms = [];

			foreach ( $posts as $single_post ) {
				foreach ( $taxonomies as $taxonomy ) {
					$terms_product = wp_get_object_terms( $single_post->ID, $taxonomy );
					foreach ( $terms_product as $term ) {
						array_push( $active_terms, $term->term_id );
					} 
				}	
			}

			$active_terms = array_unique( $active_terms );

			if ( count( $args[ 'tax_query' ] ) > 1 || !empty( $args[ 'meta_query' ][ 0 ] ) )  {
				if ( !empty( $args[ 'meta_query' ][ 0 ] ) && count( $args[ 'tax_query' ] ) > 1 ) {
					$search_value = ', "' . $args[ 'meta_query' ][ 0 ][ 'value' ] . '"';
				} else if ( !empty( $args[ 'meta_query' ][ 0 ][ 'value' ] ) ) {
					$search_value = '"' . $args[ 'meta_query' ][ 0 ][ 'value' ] . '"';
				} 
				if ( $query->found_posts === 1 ) { 
					echo '<div class="filter__results-heading js-single-result"><h4>' . $query->found_posts . ' ' . __( 'result found', 'partinchem' ) . '</h4>' . implode( '', $active_term_names ) . '</div>';
				} else {
					echo '<div class="filter__results-heading"><h4>' . $query->found_posts . ' ' . __( 'results found', 'partinchem' ) . '</h4>' . implode( '', $active_term_names ) . '</div>';
				}
				if ( $args[ 'tax_query' ][0][ "taxonomy" ] === 'products_tax' ) {
					$product_group = get_terms( array( 'include' => ( $args[ 'tax_query' ][0][ "terms" ][0] ) ) );
					echo '<div class="filter__results-description">
					<h5>' . $product_group[0]->name . ': </h5>
					<p>' . wp_trim_words( $product_group[0]->description, 40, '...' ) . ' </p>
					<a href="https://www.partinchem.com/product-group/' . $product_group[0]->slug . '/" target="_blank">' . __( 'Read more', 'partinchem' ) . '</a>
					</div>';  
				} 
				while ( $query->have_posts() ) { $query->the_post();
					get_template_part( './template-parts/card/card', '');
				} 
				get_template_part( './template-parts/card/card', 'cta');
				if ( $query_type === 'switch' ) { 
					echo '<input type="hidden" id="max" name="max_num_pages" value="' . $query->max_num_pages . '">';  
				} wp_reset_postdata();   
			} else {
				get_template_part( './template-parts/filter/filter', 'landing');
				get_template_part( './template-parts/card/card', 'cta');
			} 
			echo '<div style="display:none;position:absolute;top:0;background-color:wheat;" class="js-terms" data-terms="' . implode( ",", $active_terms ) . '">' . implode( "\", \"", $active_terms ) . '</div>';
		} else { 
			// if ( !empty( $args[ 's'][ 'value' ] ) ) {
			// 	$search_value = '"' . $args[ 's'][ 'value' ] . '"';
			// } 
			// Display error message when no posts are found.
			// echo '<h4 class="filter__no-results">' . __( 'No results found for', 'partinchem' ) . ' ' . '</span>' . $search_value . '</span></h4>';
			echo '<div class="filter__results-heading"><h4 class="filter__no-results">' . __( 'No results found', 'partinchem' ) . '</h4>' . implode( '', $active_term_names ) . '</div>';
			get_template_part( './template-parts/card/card', 'cta');
		} 	
	}
		
	// End connection
	die(); 
}