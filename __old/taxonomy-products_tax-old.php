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


<?php 

$catId = get_queried_object()->term_id; 
$parent = wp_get_term_taxonomy_parent_id($catId, 'products_tax');

?>

 <!--page-head-->
 <div class="page-head"></div>
 
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
                                        'taxonomy' => 'products_tax',
                                        'exclude' => 6
                                    ) );
                                    foreach( $terms as $term ){ ?>
                                             
                                        <li>

                                        <?php if($term->term_id == $catId){ ?>

                                           <input id="checkbox<?php echo $term->term_id; ?>" class="active" name="<?php echo $term->name; ?>" value="<?php echo $term->term_id; ?>" type="checkbox">
                                           <label for="checkbox<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label>

                                        <?php }else{ ?>

                                           <input id="checkbox<?php echo $term->term_id; ?>" name="<?php echo $term->name; ?>" value="<?php echo $term->term_id; ?>" type="checkbox">
                                           <label for="checkbox<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label>
                            
                                        <?php }; ?>

                                        </li>
                                        
                                <?php } ?>

                            </ul>
                        </div>
                        <div class="sidebar-item sidebar-search">
                            <h3 class="sidebar-title size4">Search</h3>
                            <form action="">
                                <input type="text" id="searchInput" class="input input-search" placeholder="CAS-nr., equivalent, application">
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
                    <img src="<?php echo get_template_directory_uri()?>/img/loader.gif" alt="loader" class="loader">
                    <div id="ajax-container" class="product-content">

                    <?php while (have_posts()) : the_post(); ?>

                        <!--item-->
                        <div class="item">
                            <div class="product product-green small">
                                <a href="#product-modal<?php the_ID(); ?>" class="fancybox link-modal"></a>
                                <div class="product-info">
                                    <h2 class="size3 product-title"><?php the_title(); ?></h2>
                                    <div class="product-desc">
                                        <p><?php the_field('product_description_short'); ?></p>
                                    </div>
                                </div>
                                <button class="button-plus" onclick="window.location.href='<?php the_permalink(); ?>'"><span class="icon icon-plus"></span></button>
                            </div>
                        </div>

                    <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer();
