<?php
/*
Template Name: Products New
*/
?>

<?php get_header(); ?>

<?php 

global $post;

?>

 
  <!--page-head-->
  <div class="page-head"></div>

    <!--Search bar-->
    <div class="search-bar--alt">
        <div class="container">
            <div class="row">
                <div class="search-form-container">
                    <form action="" class="searchbar-search-form">
                        <input type="text" id="searchInput" class="input input-search input-search--alt" placeholder="<?php _e( 'CAS-nr., equivalent, chemical name', 'partinchem' ); ?>">
                        <span class="icon icon-search"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--page-content-->

<form id="products-filter" method="POST">
    <div class="page-content page-products page-products--alt">
        <div class="container">
            <div class="row row--alt">
                <!--left-->
                <div class="col-left col-left--alt">
                    <div class="sidebar sidebar--alt">
                        <!--sidebar-list-->
                        <?php                   
                        $taxonomies = get_object_taxonomies('products', 'objects'); 
                        $valid_taxonomies = array('products_tax', 'industry_of_use', 'polumers_of_use');
                        $count = 0;
                        foreach( $taxonomies as $taxonomy ) { ?> 
                            <?php if( in_array( $taxonomy->name, $valid_taxonomies ) ) { ?>
                                <?php $count++; ?>
                                <div class="sidebar-item sidebar-list sidebar-list--alt<?php echo ( $count === 1 ? ' sidebar-list--open' : '' ); ?>">
                                    <a class="sidebar-link" href="#">
                                        <h3 class="sidebar-title size4"><?php echo $taxonomy->label; ?></h3>
                                        <i class="fa fa-angle-down"></i>
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                    <ul>
                                        <?php $terms = get_terms( array(
                                            'taxonomy' => $taxonomy->name,
                                            'orderby' => 'menu_order',
                                            'order'   => 'ASC',
                                            'parent'  => 0
                                        ) ); 
                                        
                                        foreach( $terms as $term ) { ?>
                                            <?php if ( $term->taxonomy == 'products_tax' ); {
                                                // echo 'product'; 
                                            } ?>
                                            <?php if ( $term->parent === 0  ) { ?>
                                                <li> 
                                                    <input class="parent-checkbox" id="checkbox<?php echo $term->term_id; ?>" name="<?php echo $taxonomy->name . '[]'; ?>" value="<?php echo $term->term_id; ?>" type="checkbox">
                                                    <label for="checkbox<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label>

                                                    <?php $children = get_terms( array(
                                                        'taxonomy' => $term->taxonomy, 
                                                        'parent' => $term->term_id,
                                                    ) ); 

                                                    if ( !empty( $children ) ) { ?>
                                                        <ul class="sidebar-sublist" id="sublist<?php echo $term->term_id; ?>">
                                                            <?php foreach( $children as $child ) { ?>
                                                                <li>
                                                                    <input id="checkbox<?php echo $child->term_id; ?>" name="<?php echo $taxonomy->name . '[]'; ?>" value="<?php echo $child->term_id; ?>" type="checkbox">
                                                                    <label for="checkbox<?php echo $child->term_id; ?>"><?php echo $child->name; ?></label>

                                                                    <?php $grandchildren = get_terms( array(
                                                                        'taxonomy' => $child->taxonomy, 
                                                                        'parent' => $child->term_id,
                                                                    ) ); 

                                                                    if ( !empty( $grandchildren ) ) { ?>
                                                                        <ul class="sidebar-sublist" id="sublist<?php echo $child->term_id; ?>">
                                                                            <?php foreach( $grandchildren as $grandchild ) { ?>
                                                                                <li>
                                                                                    <input id="checkbox<?php echo $grandchild->term_id; ?>" name="<?php echo $taxonomy->name . '[]'; ?>" value="<?php echo $grandchild->term_id; ?>" type="checkbox">
                                                                                    <label for="checkbox<?php echo $grandchild->term_id; ?>"><?php echo $grandchild->name; ?></label>
                                                                                </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    <?php } ?>                   
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>                                                                                                                                                                                                      
                                                </li>
                                            <?php } ?>                                                                                                    
                                        <?php } ?>
                                    </ul>   
                                </div>
                            <?php } ?>    
                        <?php } ?>
                        <!-- <div class="sidebar-item sidebar-item--range">
                            <h3 class="sidebar-title size4">Wavelength</h3>
                            <p>210 - 470</p>
                            <input type="range" name="points" min="0" max="10">
                        </div> -->
                    </div>
                </div>
                <!--right-->
                <div class="col-right col-right--alt">
                    <img src="<?php echo get_template_directory_uri()?>/img/loader.gif" alt="loader" class="loader">
                    <div id="ajax-container" class="product-content product-content--alt load-content">

               
                        <!--Featured item-->
                        <?php $idPost =  get_field('featured_product-featured'); ?>
                        <?php $info = get_field( 'product_composition', $idPost ); ?>
                        <?php $cas = $info[ 'cas_numbers' ]; ?>
                        <?php $eu_eg = $info[ 'eu_eg' ]; ?>
                        <?php $abbr = get_field( 'abbreviation_product_name', $idPost ); ?>
                        <div class="item item--alt item--featured">
                            <div class="product product-green product--alt simpleCart_shelfItem">
                                <a href="<?php the_permalink($idPost); ?>" target="_blank" class="link-modal"></a>
                                <div class="product-info">
                                    <h2 class="size3 product-title"><?php echo get_the_title($idPost); ?><span style="display:none;"><?php the_field( 'synonyms', $idPost ); ?> <?php echo $cas; ?> <?php echo $abbr; ?> <?php echo $eu_eg; ?></span></h2>
                                    <div class="product-desc">
                                        <p><?php echo wp_trim_words( get_field('product_description_short', $idPost), 20, '...' ); ?><p>
                                    </div>
                                </div>
                                <button class="button-more" onclick="window.location.href='<?php the_permalink($idPost); ?>'"><?php _e( 'More information', 'partinchem' ); ?></button>
                            </div>
                        </div>

                        <!-- Categories -->
                        <?php 
                        $categories = get_field( 'featured_categories' );                        
                        $count = 0;
                        foreach ( $categories as $category ) { 
                            $count++;
                            if ( $count === 3 ) { break; } ;
                            ?>
                            <div class="item item--alt item--small">
                                <a style="cursor:pointer;" href="<?php echo get_home_url() . '/product-group/' . $category->slug . '/'; ?>" class="product product-blue product--alt">
                                    <!-- <input class="category-checkbox" id="checkbox<?php echo $category->term_id; ?>" name="<?php echo $category->name; ?>" value="<?php echo $category->term_id; ?>" type="checkbox">
                                    <label class="link-modal" for="checkbox<?php echo $category->term_id; ?>"></label> -->
                                    <div class="product-info product-info--category">
                                        <span class="product-group"><?php _e( 'Product group', 'partinchem' ); ?></span>
                                        <h2 class="size3 product-title"><?php echo $category->name ?></h2>
                                    </div>
                                    <button class="button-more button-more--alt" onclick="window.location.href='#'"><?php _e( 'View products', 'partinchem' ); ?></button>
                                </a>
                            </div>
                        <?php } ?>

                        <!--New item-->
                        <?php $idPost_new =  get_field('featured_product-new'); ?>
                        <?php $info = get_field( 'product_composition', $idPost_new ); ?>
                        <?php $cas = $info[ 'cas_numbers' ]; ?>
                        <?php $eu_eg = $info[ 'eu_eg' ]; ?>
                        <?php $abbr = get_field( 'abbreviation_product_name', $idPost_new ); ?>
                          <div class="item item--alt item--new">
                            <div class="product product-green product--alt simpleCart_shelfItem">
                                <a href="<?php the_permalink($idPost_new); ?>" class="link-modal" target="_blank"></a>
                                <div class="product-info">
                                    <h2 class="size3 product-title"><?php echo get_the_title($idPost_new); ?><span style="display:none;"><?php the_field( 'synonyms', $idPost_new ); ?> <?php echo $cas; ?> <?php echo $abbr; ?> <?php echo $eu_eg; ?></span></h2>
                                    <div class="product-desc">
                                        <p><?php echo wp_trim_words( get_field('product_description_short', $idPost_new), 20, '...' ); ?><p>
                                    </div>
                                </div>
                                <button class="button-more" onclick="window.location.href='<?php the_permalink($idPost_new); ?>'"><?php _e( 'More information', 'partinchem' ); ?></button>
                            </div>
                        </div>

                         <!-- Categories -->
                         <?php 
                        $categories = get_field( 'featured_categories' );                        
                        $count = 0;
                        foreach ( $categories as $category ) { 
                            $count++;
                            if ( $count === 3 || $count === 4 ) { ?>
                                <div class="item item--alt item--small">
                                    <a style="cursor:pointer;" href="<?php echo get_home_url() . '/product-group/' . $category->slug . '/'; ?>" class="product product-blue product--alt">
                                        <!-- <input class="category-checkbox" id="checkbox<?php echo $category->term_id; ?>" name="<?php echo $category->name; ?>" value="<?php echo $category->term_id; ?>" type="checkbox">
                                        <label class="link-modal" for="checkbox<?php echo $category->term_id; ?>"></label> -->
                                        <!-- <a href="#" class="link-modal"></a> -->
                                        <div class="product-info product-info--category">
                                            <span class="product-group"><?php _e( 'Product Group', 'partinchem' ); ?></span>
                                            <h2 class="size3 product-title"><?php echo $category->name ?></h2>
                                        </div>
                                        <button class="button-more button-more--alt"><?php _e( 'View Products', 'partinchem' ); ?></button>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } ?>

                         <!--Blog posts -->   
                         <?php $idBlog1 =  get_field('featured_blog_1'); ?>

                        <div class="item item--alt item--blog">
                        <div class="item__thumbnail" style="background-image: url(<?php echo get_the_post_thumbnail_url( $idBlog1, 'large' ); ?>)"></div>
                            <div class="product product-green product--alt product--blog simpleCart_shelfItem">
                                <a href="<?php the_permalink($idBlog1); ?>" target="_blank" class="link-modal"></a>
                                <div class="product-info">
                                    <h2 class="size3 product-title"><?php echo get_the_title($idBlog1); ?></h2>
                                    <div class="product-desc">
                                        <p><?php echo wp_trim_words( $idBlog1->post_content, 20, '...' ); ?><p>
                                    </div>
                                </div>
                                <button class="button-more"><?php _e( 'Read more', 'partinchem' ); ?></button>
                            </div>
                        </div>

                        <!--Blog posts -->   
                        <?php $idBlog2 =  get_field('featured_blog_2'); ?>

                        <div class="item item--alt item--blog">
                            <div class="item__thumbnail" style="background-image: url(<?php echo get_the_post_thumbnail_url( $idBlog2, 'large' ); ?>)"></div>
                            <div class="product product-green product--alt product--blog simpleCart_shelfItem">
                                <a href="<?php the_permalink($idBlog2); ?>" target="_blank" class="link-modal"></a>
                                <div class="product-info">
                                    <h2 class="size3 product-title"><?php echo get_the_title($idBlog2); ?></h2>
                                    <div class="product-desc">
                                        <p><?php echo wp_trim_words( $idBlog2->post_content, 20, '...' ); ?><p>
                                    </div>
                                </div>
                                <button class="button-more"><?php _e( 'Read more', 'partinchem' ); ?></button>
                            </div>
                        </div>
                        
                        <!--Initially hidden form-->
                        <div class="product-form" style="display:none;">
                            <h3><?php _e( 'Can\'t find the product you\'re looking for? Send us your request', 'partinchem' ); ?></h3>
                            <a class="button button-light" title="request" href="mailto:info@partinchem.com"><?php _e( 'Send E-mail', 'partinchem' ); ?></a>
                        </div>

                        <!--Initially hidden items-->   
                        <?php $args = array(
                            'post_type'           => 'products',
                            'posts_per_page'      => '-1',
                            'post_status'         => 'publish'
                        );
                        
                        $products = new WP_Query( $args );

                        if ( $products->have_posts() ) { while ( $products->have_posts() ) { $products->the_post(); ?> 

                            <?php $info = get_field( 'product_composition' ); ?>
                            <?php $cas = $info[ 'cas_numbers' ]; ?>
                            <?php $eu_eg = $info[ 'eu_eg' ]; ?>
                            <?php $abbr = get_field( 'abbreviation_product_name'); ?>
                            <?php $product_group_array = get_field( 'product_group'); ?>
                            <?php 
                            $string_array = [];
                            foreach( $product_group_array as $i => $i_value ) {
                                array_push( $string_array, $i_value->name );
                            }
                            $string_tax = implode(' ',$string_array);
                            ?>
                            

                            <div class="item item--alt item--hidden js-search-item" style="display:none;">
                                <div class="product product-green product--alt simpleCart_shelfItem">
                                    <a href="<?php the_permalink() ?>" target="_blank" class="link-modal"></a>
                                    <div class="product-info">
                                        <h2 class="size3 product-title"><?php echo get_the_title(); ?><span style="display:none;"><?php the_field( 'synonyms' ); ?> <?php echo $cas; ?> <?php echo $abbr; ?> <?php echo $eu_eg; ?> <?php echo $string_tax; ?></span></h2>
                                        <div class="product-desc">
                                            <p><?php echo wp_trim_words( get_field('product_description_short'), 20, '...' ); ?><p>
                                        </div>
                                    </div>
                                    <button class="button-more" onclick="window.location.href='<?php the_permalink(); ?>'"><?php _e( 'More information', 'partinchem' ); ?></button>
                                </div>
                            </div> 
                        <?php } } wp_reset_postdata(); ?>

                    </div>
                    <?php
                    $search_title = get_field( 'search_title', 'options' );
                    $search_text = get_field( 'search_text', 'options' );
                    ?>
                    <div id="products-cta" class="products__cta">
                        <div class="row justify-end">
                            <div class="box-md-6">
                                <div class="products__cta-header">
                                    <h2><?php echo $search_title; ?></h2>
                                    <p><?php echo $search_text; ?></p>
                                </div>
                            </div>
                            <div class="box-md-6">
                                <?php get_template_part( './template-parts/cta' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php get_footer(); ?>