<?php
/**
 * The template for displaying Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

 <!--page-head-->
 <div class="page-head"></div>
    <h1>CATEGORY 321312321</h1>
    <!--page-content-->
    <div class="page-content page-products">
        <div class="container">
            <div class="row">
                <!--left-->
                <div class="col-left">
                    <div class="sidebar">
                        <!--sidebar-list-->
                        <div class="sidebar-item sidebar-list">
                            <h3 class="sidebar-title size4">Categories</h3>
                            <ul>

                                <?php                                 
                                    $terms = get_terms( array(
                                        'taxonomy' => 'product-group',
                                        'exclude' => 3
                                    ) );
                                    foreach( $terms as $term ){ ?>

                                        <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>

                                <?php } ?>
                        
                            </ul>
                        </div>
                        <div class="sidebar-item sidebar-search">
                            <h3 class="sidebar-title size4">Search</h3>
                            <form action="">
                                <input type="text" class="input input-search" placeholder="CAS-nr., equivalent, application">
                            </form>
                        </div>
                    </div>
                </div>
                <!--right-->
                <div class="col-right">
                    <h1 class="page-title size3">Products</h1>
                    <!--filter-->
                    <!-- <div class="filter">
                        <div class="dropdown">
                            <div class="dropdown-default">
                                <span>Products</span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                            <ul class="dropdown-list">
                                <li><a href="#">Omnistab UV 234</a></li>
                                <li><a href="">Omnistab UV 1577</a></li>
                                <li><a href="">Vulcanizing agent</a></li>
                                <li><a href="">Anti oxidant</a></li>
                                <li><a href="#">Omnistab UV 234</a></li>
                                <li><a href="">Omnistab UV 1577</a></li>
                                <li><a href="">Vulcanizing agent</a></li>
                                <li><a href="">Anti oxidant</a></li>
                                <li><a href="#">Omnistab UV 234</a></li>
                                <li><a href="">Omnistab UV 1577</a></li>
                                <li><a href="">Vulcanizing agent</a></li>
                                <li><a href="">Anti oxidant</a></li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- <div class="filter-buttons"> -->
                        <!--
<a id="buttonClear" class="button-clear">Clear all Filters</a>
<a class="button-category">Optical brightener <span class="icon icon-cancel"></span></a>
<a class="button-category">Anti oxidant <span class="icon icon-cancel"></span></a>
-->
                    <!-- </div> -->
                    <div id="pjax-container" class="product-content">

                    <?php   
                    $args = array(
						'post_type'	 => 'products',
						// 'category' => 0
                    );
                    $the_query = new WP_Query( $args ); 
                    ?>

                    <?php if ( $the_query->have_posts() ) : ?>
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                        <!--item-->
                        <div class="item">
                            <div class="product product-green small">
                                <a href="#product-modal<?php the_ID(); ?>" class="fancybox link-modal"></a>
                                <div class="product-info">
                                    <h2 class="size3 product-title"><?php the_title(); ?></h2>
                                    <p><?php the_field('product_description_short'); ?></p>
                                </div>
                                <button class="button-plus" onclick="window.location.href='<?php the_permalink(); ?>'"><span class="icon icon-plus"></span></button>
                            </div>
                        </div>

                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer();
