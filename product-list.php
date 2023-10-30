<?php
/*
Template Name: Products List
*/
?>

<?php get_header(); ?>

<?php 

global $post;

?>



<!--page-head-->
<div class="page-head" style="background-image: url(<?php echo get_template_directory_uri()?>/img/product-list-bg.jpg);"></div>
    <!--page-content-->
    <div class="page-content page-product-list">
        <div class="container">
            <div class="row">
                <h1 class="page-title size3">My Product List</h1>
            </div>
            <div class="row">
            <img src="<?php echo get_template_directory_uri()?>/img/loader.gif" alt="loader" class="loader">
                <div class="product-list load-content">
                <div class="text" style="display: none;">
                    <p>Your product list is empty.</p>
                    <p>Select products on the <a href="<?php the_permalink(3688); ?>">product page</a> you would like more information from.</p>
                </div>
                <div class="simpleCart_items">
                    <!--item-->
                    <div class="item">
                        <h3 class="item-title size4 item_name"></h3>
                        <span class="icon icon-cancel simpleCart_remove"></span>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="product-order">
                    <h2 class="order-title size1">Send me more information on these products!</h2>
                    <h3 class="order-subtitle size3">Please, fill in the form and we’ll contact you today</h3>
                    <div class="form">
                       <?php echo do_shortcode('[contact-form-7 id="3328" title="Product List Form"]'); ?>
                    </div>
                    <div class="form-text">For immediate assistance call us at <a href="tel:<?php the_field('tel', option); ?>"><?php the_field('tel', option); ?></a></div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>