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
<div class="main main--new">
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="box-md-8">
                    <div class="block__header">
                        <?php the_field( 'hero_header'); ?>                                 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    $item_1 = get_field( 'grid_item_1' );
    $search_1 = $item_1[ 'search' ];
    $background_1 = $item_1[ 'background' ]; 
    $color_1 = $item_1[ 'color' ]; 
    $item_2 = get_field( 'grid_item_2' );
    $search_2 = $item_2[ 'search' ];
    $background_2 = $item_2[ 'background' ];
    $color_2 = $item_2[ 'color' ];  
    $item_3 = get_field( 'grid_item_3' );
    $search_3 = $item_3[ 'search' ];
    $background_3 = $item_3[ 'background' ];
    $color_3 = $item_3[ 'color' ];  
    ?>
    <div class="grid">
        <div class="container-full" style="width:initial;">
            <div class="row gutterless">
                <div class="box-md-4">
                    <?php if ( !empty( $search_1 ) ) { ?>
                        <div class="grid__item grid__item--<?php echo $color_1; ?>" style="background-image: url(<?php echo $background_1[ 'url' ]; ?>">
                    <?php } else { ?>
                        <a title="<?php echo $item_1[ 'header' ]; ?>" class="grid__item grid__item--<?php echo $color_1; ?>" href="<?php echo $item_1[ 'button' ][ 'url' ]; ?>" style="background-image: url(<?php echo $background_1[ 'url' ]; ?>">
                    <?php } ?>    
                       <div class="grid__content">
                           <div class="grid__content-text">
                               <h3><?php echo $item_1[ 'header' ]; ?></h3>
                                <p><?php echo $item_1[ 'text' ]; ?></p>
                            </div>
                            <?php if ( !empty( $search_1 ) ) { ?>
                                <form role="search" method="get" id="searchform-1" action="<?php echo home_url( '/' ); ?>">
                                    <input type="text" class="input input-search" value="" name="s" id="s" placeholder="<?php echo $item_1[ 'button' ][ 'title' ]; ?>" />
                                    <button id="searchsubmit"><span class="icon icon-search"></span></button>
                                </form>
                            <?php } else { ?>
                                <?php if ( !empty( $item_1[ 'button' ] ) ) { ?>
                                    <span class="button button--standard"><?php echo $item_1[ 'button' ][ 'title' ]; ?></span>
                                <?php } ?>
                            <?php } ?>
                       </div>
                    <?php if ( !empty( $search_1 ) ) { ?>  
                        </div>
                    <?php } else { ?>
                        </a>  
                    <?php } ?>
                </div>
                <div class="box-md-4">
                    <?php if ( !empty( $search_2 ) ) { ?>
                        <div class="grid__item grid__item--<?php echo $color_2; ?> style="background-image: url(<?php echo $background_2[ 'url' ]; ?>">
                    <?php } else { ?>
                        <a title="<?php echo $item_2[ 'header' ]; ?>" class="grid__item grid__item--<?php echo $color_2; ?>" href="<?php echo $item_2[ 'button' ][ 'url' ]; ?>" style="background-image: url(<?php echo $background_2[ 'url' ]; ?>">
                    <?php } ?>    
                       <div class="grid__content">
                           <div class="grid__content-text">
                               <h3><?php echo $item_2[ 'header' ]; ?></h3>
                                <p><?php echo $item_2[ 'text' ]; ?></p>
                            </div>
                            <?php if ( !empty( $search_2 ) ) { ?>
                                <form role="search" method="get" id="searchform-1" action="<?php echo home_url( '/' ); ?>">
                                    <input type="text" class="input input-search" value="" name="s" id="s" placeholder="<?php echo $item_2[ 'button' ][ 'title' ]; ?>" />
                                    <button id="searchsubmit"><span class="icon icon-search"></span></button>
                                </form>
                            <?php } else { ?>
                                <?php if ( !empty( $item_2[ 'button' ] ) ) { ?>
                                    <span class="button button--standard"><?php echo $item_2[ 'button' ][ 'title' ]; ?></span>
                                <?php } ?>
                            <?php } ?>
                       </div>
                    <?php if ( !empty( $search_2 ) ) { ?>  
                        </div>
                    <?php } else { ?>
                        </a>  
                    <?php } ?>
                </div>
                <div class="box-md-4">
                    <?php if ( !empty( $search_3 ) ) { ?>
                        <div class="grid__item grid__item--<?php echo $color_3; ?>" style="background-image: url(<?php echo $background_3[ 'url' ]; ?>">
                    <?php } else { ?>
                        <a title="<?php echo $item_3[ 'header' ]; ?>" class="grid__item grid__item--<?php echo $color_3; ?>" href="<?php echo $item_3[ 'button' ][ 'url' ]; ?>" style="background-image: url(<?php echo $background_3[ 'url' ]; ?>">
                    <?php } ?>    
                       <div class="grid__content">
                           <div class="grid__content-text">
                               <h3><?php echo $item_3[ 'header' ]; ?></h3>
                                <p><?php echo $item_3[ 'text' ]; ?></p>
                            </div>
                            <?php if ( !empty( $search_3 ) ) { ?>
                                <form role="search" method="get" id="searchform-1" action="<?php echo home_url( '/' ); ?>">
                                    <input type="text" class="input input-search" value="" name="s" id="s" placeholder="<?php echo $item_3[ 'button' ][ 'title' ]; ?>" />
                                    <button id="searchsubmit"><span class="icon icon-search"></span></button>
                                </form>
                            <?php } else { ?>
                                <?php if ( !empty( $item_3[ 'button' ] ) ) { ?>
                                    <span class="button button--standard"><?php echo $item_3[ 'button' ][ 'title' ]; ?></span>
                                <?php } ?>
                            <?php } ?>
                       </div>
                    <?php if ( !empty( $search_3 ) ) { ?>  
                        </div>
                    <?php } else { ?>
                        </a>  
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="row justify-between items-start">
                <div class="box-md-6">
                    <?php if( have_rows( 'usps_repeater' ) ): 
                        $count = 0; ?>
                        <div class="block__usps">
                            <?php while( have_rows( 'usps_repeater' ) ): the_row(); ?>
                                <?php $count++; ?>
                                <?php $icon = get_sub_field( 'icon' ); ?>
                                <a href="https://partinchem.com/why-us/" class="block__usp" title="Why us?">
                                    <div class="block__usp-inner">
                                        <div class="block__usp-logo">
                                            <img src="<?php echo $icon[ 'sizes' ][ 'thumbnail' ]; ?>" alt="<?php echo $icon[ 'alt' ]; ?>">
                                        </div>
                                        <p class="title"><?php the_sub_field( 'title' ); ?></p>
                                        <p><?php the_sub_field( 'text' ); ?></p>
                                    </div>
                                </a>
                                <?php if ( $count == 3 ) { 
                                    break; 
                                } ?>
                            <?php endwhile; ?>
                        </div>
                        <div class="block__usps">
                            <?php while( have_rows( 'usps_repeater' ) ): the_row(); ?>
                                <?php $icon = get_sub_field( 'icon' ); ?>
                                <a href="https://partinchem.com/why-us/" class="block__usp" title="Why us?">
                                    <div class="block__usp-inner">
                                        <div class="block__usp-logo">
                                            <img src="<?php echo $icon[ 'sizes' ][ 'thumbnail' ]; ?>" alt="<?php echo $icon[ 'alt' ]; ?>">
                                        </div>
                                        <p class="title"><?php the_sub_field( 'title' ); ?></p>
                                        <p><?php the_sub_field( 'text' ); ?></p>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="box-md-5">
                    <?php 
                    $usps_content = get_field( 'usps_content' ); 
                    $usps_button = $usps_content[ 'button' ]; 
                    ?>
                    <div class="block__column block__column--padding-l"> 
                        <h2><?php echo $usps_content[ 'title' ]; ?></h2>
                        <p><?php echo $usps_content[ 'text' ]; ?></p>
                        <?php if ( !empty( $usps_button ) ) { ?>
                            <a href="<?php echo $usps_button[ 'url' ]; ?>" class="button button--alternate" title="<?php echo $usps_button[ 'title' ]; ?>"><?php echo $usps_button[ 'title' ]; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Map-->
    <div class="map">
        <img src="<?php echo get_template_directory_uri()?>/img/map.png" alt="map" class="map-desctope">
        <img src="<?php echo get_template_directory_uri()?>/img/map-phone.png" alt="map" class="map-phone">
        <a href="/contact" title="Contact">
            <img src="<?php echo get_template_directory_uri()?>/img/map-label01.svg" alt="location" class="map-label map-label01">
        </a>
        <a href="/contact" title="Contact">
            <img src="<?php echo get_template_directory_uri()?>/img/map-label02.svg" alt="location" class="map-label map-label02">
        </a>
        <a href="/contact" title="Contact">
            <img src="<?php echo get_template_directory_uri()?>/img/map-label03.svg" alt="location" class="map-label map-label03">
        </a>
        <a href="/contact" title="Contact">
            <img src="<?php echo get_template_directory_uri()?>/img/map-label04.svg" alt="location" class="map-label map-label04">
        </a>
        <div class="item item--white" style="background-image: url(<?php the_field('map-bg'); ?>);">
            <div>
                <h3><?php the_field('map-title'); ?></h3>
                <p class="item-text"><?php the_field('map-text'); ?></p>
            </div>
        </div>
    </div>

<?php get_footer(); ?>


