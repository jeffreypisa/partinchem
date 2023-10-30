<?php
/**
 * Template Name: Front 
 */

get_header(); ?>

<!--Main-->
<div class="main main--new">
    <div class="block banner-home" style="background-image: url(<?php $image = get_field('hero_image'); echo esc_url($image['url']); ?>">
        <div class="container">
            <div class="row">
                <div class="box-12">
                    <div class="block__header">
                        <?php the_field( 'hero_header'); ?>                                 
                    </div>
                    <div class="block__header-search">
                        <form role="search" method="get" id="search-form-front" action="<?php echo home_url( '/' ); ?>">
                            <label for="s">Search</label>
                            <input type="text" class="input input-search" value="" name="s" id="s" placeholder="<?php _e( 'Search for CAS no. or Product name', 'partinchem' ); ?>" />
                            <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                        </form>
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
        <div class="container-full">
            <div class="row gutterless">
                <?php for ( $x = 1; $x <= 3; $x++ ) {             
                    $item = get_field( 'grid_item_' . $x );
                    $search = $item[ 'search' ];
                    $background = $item[ 'background' ]; 
                    $color = $item[ 'color' ];
                    ?> 
                    <div class="box-md-4" style="margin-bottom: 0 !important">
                        <?php if ( !empty( $search ) ) { ?>
                            <div class="grid__item grid__item--<?php echo $color; ?>"> 
                        <?php } else { ?>
                            <a title="<?php echo $item[ 'header' ]; ?>" class="grid__item grid__item--<?php echo $color; ?>" href="<?php echo $item[ 'button' ][ 'url' ]; ?>">
                        <?php } ?>    
                            <picture class="grid__thumbnail">
                                <source media="(max-width: 480px)" srcset="<?php echo $background['sizes']['medium']; ?>">
                                <img loading="lazy" src="<?php echo $background[ 'sizes' ][ 'large' ]; ?>" alt="<?php echo $background[ 'alt' ]; ?>">
                            </picture>
                           <div class="grid__mask"></div>
                           <div class="grid__content">
                               <div class="grid__content-text">
                                   <h3><?php echo $item[ 'header' ]; ?></h3>
                                    <p><?php echo $item[ 'text' ]; ?></p>
                                </div>
                                <?php if ( !empty( $search ) ) { ?>
                                    <form role="search" method="get" id="searchform-1" action="<?php echo home_url( '/' ); ?>">
                                        <input type="text" class="input input-search" value="" name="s" id="s" placeholder="<?php echo $item[ 'button' ][ 'title' ]; ?>" />
                                        <button id="searchsubmit"><span class="icon icon-search"></span></button>
                                    </form>
                                <?php } else { ?>
                                    <?php if ( !empty( $item[ 'button' ] ) ) { ?>
                                        <span class="button button--standard"><?php echo $item[ 'button' ][ 'title' ]; ?></span>
                                    <?php } ?>
                                <?php } ?>
                           </div>
                        <?php if ( !empty( $search ) ) { ?>  
                            </div>
                        <?php } else { ?>
                            </a>  
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php 
    $usps_content = get_field( 'usps_content' ); 
    $usps_button = $usps_content[ 'button' ]; 
    ?>
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
                                <?php if ( is_array( $usps_button ) ) { ?>
                                    <a href="<?php echo $usps_button[ 'url' ]; ?>" class="block__usp" title="<?php echo $usps_button[ 'title' ]; ?>">
                                <?php } else { ?>
                                    <div class="block__usp">
                                <?php } ?>    
                                    <div class="block__usp-inner">
                                        <div class="block__usp-logo">
                                            <img width="75" height="75" loading="lazy" src="<?php echo $icon[ 'sizes' ][ 'thumbnail' ]; ?>" alt="<?php echo $icon[ 'alt' ]; ?>">
                                        </div>
                                        <p class="title"><?php the_sub_field( 'title' ); ?></p>
                                        <p><?php the_sub_field( 'text' ); ?></p>
                                    </div>
                                <?php if ( is_array( $usps_button ) ) { ?>    
                                    </a>
                                <?php } else { ?>
                                </div>
                                <?php } ?>
                                <?php if ( $count == 3 ) { 
                                    break; 
                                } ?>
                            <?php endwhile; ?>
                        </div>
                        <div class="block__usps">
                            <?php while( have_rows( 'usps_repeater' ) ): the_row(); ?>
                                <?php $icon = get_sub_field( 'icon' ); ?>
                                <?php if ( is_array( $usps_button ) ) { ?>
                                    <a href="<?php echo $usps_button[ 'url' ]; ?>" class="block__usp" title="<?php echo $usps_button[ 'title' ]; ?>">
                                <?php } else { ?>
                                    <div class="block__usp">
                                <?php } ?> 
                                    <div class="block__usp-inner">
                                        <div class="block__usp-logo">
                                            <img width="75" height="75" loading="lazy" src="<?php echo $icon[ 'sizes' ][ 'thumbnail' ]; ?>" alt="<?php echo $icon[ 'alt' ]; ?>">
                                        </div>
                                        <p class="title"><?php the_sub_field( 'title' ); ?></p>
                                        <p><?php the_sub_field( 'text' ); ?></p>
                                    </div>
                                <?php if ( is_array( $usps_button ) ) { ?>    
                                    </a>
                                <?php } else { ?>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="box-md-5">
                    <div class="block__column block__column--padding-l"> 
                        <h2><?php echo $usps_content[ 'title' ]; ?></h2>
                        <p><?php echo $usps_content[ 'text' ]; ?></p>
                        <?php if ( is_array( $usps_button ) ) { ?>
                            <a href="<?php echo $usps_button[ 'url' ]; ?>" class="button button--alternate" title="<?php echo $usps_button[ 'title' ]; ?>"><?php echo $usps_button[ 'title' ]; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php 
    $form_title = get_field( 'form_title' );
    $form_stock = get_field( 'form_stock' );
    $form_products = get_field( 'form_products' );
    $form_id = get_field( 'form_id' );
    ?>

    <div class="block block--blue block--overflow-hidden" id="stock" style="padding-bottom:0;">
        <div class="container">
            <div class="row justify-center">
                <div class="box-static">
                    <h2><?php echo $form_title; ?></h2>
                </div>
            </div>
            <div class="row justify-between items-stretch">
                <div class="box-md-5">
                    <div class="block__form block__form--overflow">
                        <h3><?php echo $form_stock; ?></h3>
                        <?php
                        $stock_terms = get_terms( 'stock' );
                        $stock_term_ids = [];
                        
                        foreach ( $stock_terms as $stock_term ) {
                            array_push( $stock_term_ids, $stock_term->term_id );
                        }
                        
                        $stock_args = array (
                            'post_type' 		=> array( 'products' ),
                            'post_status' 		=> array( 'publish' ),
                            'posts_per_page'	=> -1,
                            'orderby'			=> 'menu_order',
                            'order'				=> 'ASC',
                            'tax_query'         => array(
                                array(
                                    'taxonomy'      => 'stock', 
                                    'field'         => 'id',
                                    'terms'         => $stock_term_ids, 
                                    'operator'      => 'IN'
                                )
                            ),
                            'suppres_filters'  => false,
                        );
                        
                        $stock_query 	= new WP_Query( $stock_args );  
                        
                        if ( $stock_query->have_posts() ) { ?>
                            <?php $count = 0 ?>
                            <div class="stock">
                                <ul class="stock__list">          
                                    <?php while( $stock_query->have_posts() ) { $stock_query->the_post() ?>
                                        <?php 
                                        $count++; 
                                        $term_obj_list = get_the_terms( $post->ID, 'stock' );
                                        $stock = join(', ', wp_list_pluck($term_obj_list, 'name'));
                                        ?>                                        
                                        <li class="stock__item"> 
                                            <label class="stock__label" for="checkbox<?php echo $count; ?>">
                                                <?php the_title(); ?>
                                                <span><?php echo $stock; ?></span>
                                                <input class="stock__checkbox" id="checkbox<?php echo $count; ?>" name="<?php the_title(); ?>" value="<?php the_title(); ?>" type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    <?php } wp_reset_postdata(); ?>
                                </ul>
                            </div>
                            <!-- <i class="fa fa-angle-down"></i> -->
                        <?php } ?> 
                    </div>
                </div> 
                <div class="box-md-7">
                    <div class="block__form">
                        <?php echo do_shortcode('[gravityform id=' . $form_id . ' name=Request a Quote title=true description=true ajax=true]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>


