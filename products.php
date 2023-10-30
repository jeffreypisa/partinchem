<?php
/*
Template Name: Products
*/
?>

<?php get_header(); ?>

<?php 

global $post;

?>

  <!--page-head-->
  <div class="page-head"></div>
    <!--page-content-->
    <div class="page-content page-products">
        <div class="container">
            <div class="row row--alt">
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
                                        'exclude' => array(6, 19, 20),
                                    ) );
                                    foreach( $terms as $term ){ ?>
                                             
                                        <li>
                                           <input id="checkbox<?php echo $term->term_id; ?>" name="<?php echo $term->name; ?>" value="<?php echo $term->term_id; ?>" type="checkbox">
                                           <label for="checkbox<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label>
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
                    <img src="<?php echo get_template_directory_uri()?>/img/loader.gif" alt="loader" class="loader">
                    <div id="ajax-container" class="product-content load-content">

                    <?php while ( have_rows('top-box') ) : ?>
                    <?php the_row(); ?>                    
                        
                        <?php $idPost =  get_sub_field('top-product'); ?>

                        <!--item-->
                        <div class="item">
                            <div class="product product-green small simpleCart_shelfItem">
                                <a href="#product-modal<?php echo $idPost; ?>" class="fancybox link-modal"></a>
                                <div class="product-info">
                                    <h2 class="size3 product-title"><?php echo get_the_title($idPost); ?></h2>
                                    <div class="product-desc"><p><?php the_field('product_description_short', $idPost); ?></p></div>
                                </div>
                                <button class="button-plus" onclick="window.location.href='<?php the_permalink($idPost); ?>'"><span class="icon icon-plus"></span></button>
                            </div>
                        </div>

                    <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>