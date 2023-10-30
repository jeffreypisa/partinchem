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

<div class="main" style="background-image: url(<?php the_field('main-bg'); ?>); background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="main-info">
                <h1 class="main-title"><?php the_field('main-title'); ?></h1>
                <h3 class="main-subtitle"><?php the_field('main-subtitle'); ?></h3>
                <a href="#order" class="fancybox btn-castom">Book today</a>
            </div>
        </div>
    </div>
</div>
<div class="about indent">
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                <div class="col-sm-6 col-sm-push-6">
                    <div class="about-img">
                        <img src="<?php the_field('about-photo'); ?>" alt="about">
                    </div>
                </div>
                <div class="col-sm-6 col-sm-pull-6">
                    <div class="about-info text-left">
                        <div class="title"><?php the_field('about-title'); ?></div>
                        <?php the_field('about-text'); ?>
                        <a href="<?php echo get_page_link(51); ?>" class="btn-castom btn-more">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Price-->
<div class="price indent" style="background-image: url(<?php the_field('price-texture'); ?>);">
    <div class="container">
        <div class="row text-center">
            <div class="title"><?php the_field('price-title'); ?></div>
        </div>
        <div class="row text-center">

        <?php while ( have_rows('main-box') ) : ?>
        <?php the_row(); ?>

            <!--price-item-->
            <div class="price-item">
                <div class="price-icon">

                    <?php
                        $priceImg = get_sub_field('price-img');
                        if($priceImg != null){
                    ?>

                    <img src="<?php echo $priceImg; ?>" alt="icon">

                    <?php }; ?>
                </div>
                <div class="price-count"><span><?php the_sub_field('price-count'); ?></span><?php the_sub_field('price-count-text'); ?></div>
                <div class="price-sum"><?php the_sub_field('price-price'); ?><span><?php the_sub_field('price-text'); ?></span></div>
                <a href="#order" class="fancybox btn-castom">Book today</a>
            </div>

            <?php endwhile; ?>

        </div>
        <div class="row btn-box text-center">
            <a href="<?php echo get_page_link(53); ?>" class="btn-castom">LEARN MORE</a>
        </div>
    </div>
</div>
<!--Services-->
<div class="services indent">
    <div class="container">
        <div class="row text-center">
            <div class="title"><?php the_field('serv-title'); ?></div>
            <div class="desc">
                <?php the_field('serv-subtitle'); ?>
            </div>
        </div>
        <div class="col-md-offset-1 col-md-10">
            <div class="row text-center">
                <div class="col-sm-4 col-sm-push-4">
                    <img src="<?php the_field('serv-img'); ?>" alt="service">
                </div>
                <div class="col-sm-4 col-sm-pull-4">
                    <h2 class="service-title"><?php the_field('serv-title-left'); ?></h2>

                    <?php the_field('serv-text-left'); ?>

                    <?php
                    $linkServLeft = get_field('serv-link-left');
                    if($linkServLeft != null){
                    ?>

                    <a href="<?php echo $linkServLeft; ?>" class="btn-castom btn-more">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a>

                    <?php }; ?>

                </div>

                <div class="col-sm-4">
                    <h2 class="service-title"><?php the_field('serv-title-right'); ?></h2>
                    <p>
                        <?php the_field('serv-text-right'); ?>
                    </p>

                    <?php
                    $linkServRight = get_field('serv-link-right');
                    if($linkServRight != null){
                    ?>

                    <a href="<?php echo $linkServRight; ?>" class="btn-castom btn-more">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a>

                    <?php }; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--Company-->
<div class="company indent">
    <div class="container">
        <div class="row text-center">
            <div class="title">
                <?php the_field('tam-title'); ?>
            </div>
            <div class="desc"><?php the_field('tam-subtitle'); ?></div>
        </div>
        <div class="text row">
            <?php the_field('tam-text'); ?>
        </div>
    </div>
</div>

<!--Gallery-->
<div class="gallery indent">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="title"><?php the_field('gal-title'); ?></div>
        </div>
    </div>
    <div class="row text-center">
        <a href="<?php the_field('gal-img01'); ?>" rel="gallery" class="fancybox photo"><img src="<?php the_field('gal-img01'); ?>" alt="photo"><span class="hover"><i class="fa fa-search" aria-hidden="true"></i></span></a>
        <a href="<?php the_field('gal-img02'); ?>" rel="gallery" class="fancybox photo"><img src="<?php the_field('gal-img02'); ?>" alt="photo"><span class="hover"><i class="fa fa-search" aria-hidden="true"></i></span></a>
        <a href="i<?php the_field('gal-img03'); ?>" rel="gallery" class="fancybox photo"><img src="<?php the_field('gal-img03'); ?>" alt="photo"><span class="hover"><i class="fa fa-search" aria-hidden="true"></i></span></a>
        <a href="<?php the_field('gal-img04'); ?>" rel="gallery" class="fancybox photo"><img src="<?php the_field('gal-img04'); ?>" alt="photo"><span class="hover"><i class="fa fa-search" aria-hidden="true"></i></span></a>
        <a href="<?php the_field('gal-img05'); ?>" rel="gallery" class="fancybox photo"><img src="<?php the_field('gal-img05'); ?>" alt="photo"><span class="hover"><i class="fa fa-search" aria-hidden="true"></i></span></a>
    </div>
    <div class="row text-center">
        <a href="<?php the_field('facebook', option); ?>" target="_blank" class="btn-castom"><i class="fa fa-facebook-square" aria-hidden="true"></i> Follow</a>
    </div>
</div>
<!--Reviews-->
<div class="reviews indent" style="background-image: url(<?php the_field('rev-bg'); ?>); background-size: cover;">
    <div class="container">
        <div class="row text-center">
            <div class="title"><?php the_field('rev-title'); ?></div>
        </div>
        <div class="row">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <?php while ( have_rows('rev-block') ) : ?>
                    <?php
                        $i++;
                        the_row();

                        if($i == 1){ ?>

                        <div class="item text-center active">
                            <div class="name"><?php the_sub_field('rev-name'); ?></div>
                            <div class="region"><?php the_sub_field('rev-region'); ?></div>
                            <p><?php the_sub_field('rev-text'); ?></p>
                        </div>

                        <?php } else {?>

                        <div class="item text-center">
                            <div class="name"><?php the_sub_field('rev-name'); ?></div>
                            <div class="region"><?php the_sub_field('rev-region'); ?></div>
                            <p><?php the_sub_field('rev-text'); ?></p>
                        </div>

                        <?php }; ?>

                    <?php endwhile; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
</div>
<!--Map-->
<div class="map indent">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="map"></div>
            </div>
            <div class="col-md-6">
                <div class="title"><?php the_field('map-title'); ?></div>
                <div class="form-box row">
                    <?php echo do_shortcode('[contact-form-7 id="99" title="Main"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
