<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<!--Main-->
<div class="main" style="

    <?php if(get_field('main-bg')){?>
        background-image: url(<?php the_field('main-bg'); ?>);
    <?php } else { ?>
        background: #2b3147;;
    <?php }; ?>

">

        <div class="container">
            <div class="row">
                <div class="main-info">
                    <!--left-->
                    <div class="main-info-left">
                        <h1 class="main-title">
                            <?php the_field('main-title-light'); ?>
                            <b><?php the_field('main-title-bold'); ?></b>
                        </h1>
                    </div>
                    <!--right-->
                    <div class="main-info-right">
                        <p class="main-text">
                            <?php the_field('main-text'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="main-product">
                
                <?php while ( have_rows('main-box') ) : ?>
                <?php the_row(); ?>

                <?php   
                $colorBox = get_sub_field('main-box-color'); 
                if($colorBox == 'Green'){ 
                    $colorBox = 'product-green'; 
                } 
                elseif ($colorBox == 'Dark blue'){
                    $colorBox = 'product-dark'; 
                } 
                elseif ($colorBox == 'White'){
                    $colorBox = 'product-light'; 
                };
                ?>
                
                    <!--product-->
                    <div class="product <?php echo $colorBox; ?>" onclick="location.href='<?php the_sub_field('main-link'); ?>'">
                        <div class="product-info">
                            <h2 class="size1 product-title"><?php the_sub_field('main-box-title'); ?></h2>
                            <div class="product-desc">
                                <?php the_sub_field('main-box-text'); ?>
                            </div>
                        </div>
                        <button class="button-plus">
                            <span class="icon icon-plus"></span>
                        </button>
                    </div>
                
                <?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>

    <!--Partners offer-->
    <div class="partners-offer">
        <div class="container">
            <div class="row">
                <p class="promo">
                    <?php the_field('info-text'); ?>
                </p>

                <?php if(get_field('info-link')){ ?>

                    <a href="<?php the_field('info-link'); ?>" class="button button-color"><?php the_field('info-btn'); ?></a>
            
                <?php }; ?>

            </div>
        </div>
    </div>

    <!--Partners plusi-->
    <div class="partners-plusi">
        <div class="container">
            <div class="row">

            <?php while ( have_rows('partners-box') ) : ?>
                <?php the_row(); ?>
                
                <!--item-->
                <div class="item">
                    <div class="item-icon">

                    <?php if(get_sub_field('partners-icon')){ ?>

                        <img src="<?php the_sub_field('partners-icon'); ?>" alt="icon">

                    <?php }; ?>

                    </div>
                    <h3 class="item-title size3"><?php the_sub_field('partners-title'); ?></h3>
                    <p class="item-text usp"><?php the_sub_field('partners-text'); ?></p>
                </div>

            <?php endwhile; ?>

            </div>
        </div>
    </div>

    <!--Map-->
    <div class="map">
        <img src="<?php echo get_template_directory_uri()?>/img/map.png" alt="map" class="map-desctope">
        <img src="<?php echo get_template_directory_uri()?>/img/map-phone.png" alt="map" class="map-phone">
        <img src="<?php echo get_template_directory_uri()?>/img/map-label01.svg" alt="location" class="map-label map-label01">
        <img src="<?php echo get_template_directory_uri()?>/img/map-label02.svg" alt="location" class="map-label map-label02">
        <img src="<?php echo get_template_directory_uri()?>/img/map-label03.svg" alt="location" class="map-label map-label03">
        <img src="<?php echo get_template_directory_uri()?>/img/map-label04.svg" alt="location" class="map-label map-label04">
        <div class="item" style="background-image: url(<?php the_field('map-bg'); ?>);">
            <div>
                <h2 class="item-title size1"><?php the_field('map-title'); ?></h2>
                <p class="item-text"><?php the_field('map-text'); ?></p>
            </div>
        </div>
    </div>

    <!--Our partners-->
    <div class="our-partners">
        <div class="container">
            <div class="row">
                <h2 class="title size3"><?php the_field('company-title'); ?></h2>
                <p class="promo"><?php the_field('company-text'); ?></p>
            </div>
            <div class="row">
                <div class="partners-logo">
                    <ul>

                    <?php while ( have_rows('logos-box') ) : ?>
                        <?php the_row(); ?>

                        <?php if(get_sub_field('company-logo')){ ?>

                            <li><a><img src="<?php the_sub_field('company-logo'); ?>" alt="partner"></a></li>

                        <?php }; ?>

                    <?php endwhile; ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
 
<?php get_footer(); ?>


