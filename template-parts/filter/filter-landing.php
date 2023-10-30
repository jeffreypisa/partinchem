<?php
/**
 * Template:			filter-landing.php
 * Description:			Filter landing page template
 */

global $count;
$featured_products = get_field( 'products_featured', 8598 );
$featured_group = get_field( 'products_group', 8598 );
$featured_news = get_field( 'products_news', 8598 );
$delay = 0;
$count = 0;
?>

<?php foreach ( $featured_products as $post ) { setup_postdata( $post ); 
    get_template_part( './template-parts/card/card', 'featured' );    	
} wp_reset_postdata(); ?>

<?php foreach ( $featured_group as $post ) { setup_postdata( $post );
    get_template_part( './template-parts/card/card', 'taxonomy' ); 
} wp_reset_postdata(); ?>

<?php foreach ( $featured_news as $post ) { setup_postdata( $post ); 
    get_template_part( './template-parts/card/card', 'news' ); 
} wp_reset_postdata(); ?>