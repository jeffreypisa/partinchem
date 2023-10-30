<?php
/**
 * Template Name: Products-2020 
 * Template Post Type: post, page
 */

get_header();
?>

<main id="site-main" class="main">

    <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
        
        <?php 
        $post_per_page = -1;

        $taxonomies = get_object_taxonomies( 'products' );
        $taxonomies_selection = [ 'products_tax', 'industry_of_use', 'polumers_of_use', 'stock' ]; 

		$args = array (
			'post_type' 		=> array( 'products' ),
			'post_status' 		=> array( 'publish' ),
			'posts_per_page'	=> 0,
			'orderby'			=> 'menu_order',
            'order'				=> 'ASC',
            'paged'				=> 1,
            'offset'            => 0,
            'meta_query'	=> array(),
            'suppres_filters'  => false,
		);

        $post_query 	= new WP_Query( $args );        
         ?>
        
        <div class="filter filter--alternate">
            <h1 class="filter__heading"><?php the_title(); ?> - <?php echo ICL_LANGUAGE_CODE; ?></h1>
            <form class="filter__form js-filter" name="filter" id="filter-products" action="<?php echo home_url( $wp->request ); ?>" method="GET">
                <input type="hidden" name="action" value="get_posts_ajax">
                <input type="hidden" name="post_type" value="products">                                        
                <input type="hidden" id="posts-per-page" name="posts_per_page" value="<?php echo $post_per_page; ?>">
                <input type="hidden" id="type" name="type" value="">
                <input type="hidden" id="offset" name="offset" value="0">
                <div class="filter__header">
                    <div class="container">
                        <div class="row justify-center">
                            <div class="box-md-8">
                                <div class="filter__search">
                                    <input class="js-filter-search" type="text" value="" name="s" id="s" placeholder="<?php _e( 'Search for CAS no. or Product name', 'partinchem' ); ?>" />
                                    <button type="submit"><p><?php _e( 'Search', 'partinchem' ); ?></p><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter__body">
                    <div class="container">
                        <div class="row">
                            <div class="box-sm-4">
                                <div class="filter__inputs js-filter-controls"> 
                                    <?php foreach ( $taxonomies_selection as $taxonomy ) { ?>
                                        <?php $taxonomy_object = get_taxonomy( $taxonomy ); ?> 
                                        <fieldset class="filter__category js-filter-category">
                                            <legend class="js-accordion" aria-expanded="false">
                                                <div class="filter__legend">
                                                    <span><?php echo $taxonomy_object->label; ?></span>
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </legend>
                                            <div class="filter__panel js-accordion-panel" role="region">
                                                <?php
                                                $terms = get_terms( array(
                                                    'post_type' => 'products',
                                                    'taxonomy' => $taxonomy,
                                                )); 
                                                ?>
                                                    <?php foreach ($terms as $term) { ?>
                                                    <?php if ( $term->parent === 0 ) { ?>
                                                        <?php $child_terms = get_term_children( $term->term_id, $taxonomy ); ?>
                                                        <div class="filter__group">
                                                            <p class="filter__input<?php if ( !empty( $child_terms ) ) { echo ' js-filter-group'; } ?>">
                                                                <label>
                                                                    <input class="checkbox-parent" name="<?php echo $taxonomy; ?>[]" id="<?php echo $term->term_id;?>" value="<?php echo $term->term_id;?>" type="checkbox">
                                                                    <span><?php echo $term->name;?></span>
                                                                    <?php if ( !empty( $child_terms ) ) { ?>    
                                                                        <!-- <i class="fas fa-chevron-down"></i> -->
                                                                    <?php } ?>
                                                                </label>                                                        
                                                            </p>
                                                            <?php if ( !empty( $child_terms ) ) { ?>                                                               
                                                                <div class="filter__subgroup js-filter-subgroup">                                                              
                                                                    <?php foreach ( $child_terms as $child_term ) { ?> 
                                                                        <?php $child_term_object = get_term( $child_term, $taxonomy ); ?>                                                                 
                                                                        <p class="filter__input filter__input--child">
                                                                            <label>
                                                                                <input class="checkbox-child" type="checkbox" name="<?php echo $taxonomy; ?>[]" id="<?php echo $child_term_object->term_id;?>" value="<?php echo $child_term_object->term_id;?>">
                                                                                <span class="checkmark"></span>
                                                                                <span><?php echo $child_term_object->name;?></span>
                                                                            </label>                                                                       
                                                                        </p>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </fieldset>
                                    <?php } ?>                         
                                    <div class="filter__reset">
                                        <a class="button button--reset js-reset js-anchor" href="#filter-products" title="<?php _e( 'Reset all filters', 'partinchem' ); ?>"><?php _e( 'Reset all filters', 'partinchem' ); ?></a>
                                    </div>          	
                                </div>
                            </div>
                            <div class="box-sm-8">
                                <div class="filter__content">
                                    <?php $delay = 0; ?>
                                    <ul class="filter__results js-filter-ajax-results">                             
                                        <?php get_template_part( './template-parts/filter/filter', 'landing'); ?>
                                        <?php get_template_part( './template-parts/card/card', 'cta'); ?>    	
                                        <input type="hidden" id="max" name="max_num_pages" value="<?php echo $post_query->max_num_pages; ?>">                            
                                    </ul>
                                    <?php if ( $post_query->max_num_pages > 1 ) { ?>
                                        <!-- <input type="hidden" id="paged" name="post_paged" value="2"> -->
                                        <!-- <button class="filter__button" type="submit" name="submit" title="Meer artikelen laden" href="#"> -->
                                            <!-- Meer producten laden -->
                                        <!-- </button> -->
                                    <?php } ?>
                                    <div class="filter__loader"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="filter__toggle js-filter-toggle">
                        <svg width="15" height="14" xmlns="http://www.w3.org/2000/svg"><g fill="#B8E12A" fill-rule="nonzero"><path d="M14.2 12.674H5.395C5.153 13.444 4.473 14 3.674 14c-.8 0-1.48-.556-1.722-1.326H.578c-.32 0-.578-.277-.578-.618 0-.342.259-.62.578-.62h1.374c.242-.769.922-1.325 1.722-1.325.8 0 1.48.556 1.721 1.326H14.2c.319 0 .578.277.578.619 0 .341-.259.618-.578.618zM3.674 11.35c-.364 0-.66.317-.66.707 0 .39.296.706.66.706.364 0 .66-.317.66-.706 0-.39-.296-.707-.66-.707zM14.2 8.008h-1.375c-.242.77-.922 1.325-1.721 1.325-.8 0-1.48-.556-1.722-1.325H.578c-.32 0-.578-.277-.578-.62 0-.34.259-.618.578-.618h8.804c.242-.77.922-1.326 1.722-1.326.8 0 1.48.556 1.721 1.326H14.2c.319 0 .578.277.578.619 0 .342-.259.619-.578.619zm-3.096-1.326c-.364 0-.66.317-.66.707 0 .39.296.707.66.707.364 0 .66-.317.66-.707 0-.39-.296-.707-.66-.707zM14.2 2.563H7.872c-.242.77-.922 1.326-1.721 1.326-.8 0-1.48-.556-1.722-1.326H.579c-.32 0-.579-.277-.579-.619 0-.341.259-.618.578-.618H4.43C4.671.556 5.351 0 6.151 0 6.95 0 7.63.556 7.872 1.326H14.2c.319 0 .578.277.578.618 0 .342-.259.62-.578.62zM6.15 1.238c-.364 0-.66.317-.66.706 0 .39.296.707.66.707.365 0 .66-.317.66-.707 0-.39-.295-.706-.66-.706z"/></g></svg>
                        <span>Filter</span>
                    </a>
                </div>
            </form>
        </div>

        <?php get_template_part( './template-parts/modal', '' ); ?>

	<?php } } ?>

</main>

<?php get_footer(); ?>
