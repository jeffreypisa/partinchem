<?php
/*
Template Name: Downloads
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="<?php echo get_template_directory_uri()?>/img/ico.ico" type="images/x-icon">
    <link href="<?php echo get_template_directory_uri()?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri()?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri()?>/css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link href="<?php echo get_template_directory_uri()?>/style.css" rel="stylesheet">

    <?php wp_head(); ?>

</head>

<body>
    <header>
        <div class="contacts">
            <div class="container">
                <div class="row text-right">
                    <ul>
                        <li>
                            <a href="tel:<?php the_field('tel', option); ?>">
                                <i class="fa fa-phone" aria-hidden="true"></i><?php the_field("tel", option); ?>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?php the_field("email", option); ?>">
                                <i class="fa fa-envelope" aria-hidden="true"></i><?php the_field("email", option); ?>
                            </a>
                        </li>
                        <li class="social">

                        <?php if(get_field('facebook', option) !== ''){ ?>

                            <a href="<?php the_field('facebook', option); ?>" target="_blank" rel="nofollow">
                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                            </a>

                        <?php }; ?>

                        <?php if(get_field('insta', option) !== ''){ ?>

                            <a href="<?php the_field('insta', option); ?>" target="_blank" rel="nofollow">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>

                        <?php }; ?>

                        <?php if(get_field('linkedin', option) !== ''){ ?>

                            <a href="<?php the_field('linkedin', option); ?>" target="_blank" rel="nofollow">
                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                            </a>

                        <?php }; ?>

                        <?php if(get_field('youtube', option) !== ''){ ?>

                            <a href="<?php the_field('youtube', option); ?>" target="_blank" rel="nofollow">
                                <i class="fa fa-youtube-square" aria-hidden="true"></i>
                            </a>

                        <?php }; ?>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!--logo-->
                <a href="<?php echo get_home_url(); ?>" class="logo">
                    <img src="<?php the_field('logo', option); ?>" alt="logo">
                </a>
                <a href="#" id="btnNav" class="btn-nav-tel"><span></span></a>
                <div class="nav-box">
                    <nav>
                        <ul class="nav-list">
                            <li><a href="<?php echo get_home_url(); ?>/#how-to-work">How it works</a></li>
                            <li><a href="<?php echo get_home_url(); ?>/#services">Services</a></li>
                            <li><a href="<?php echo get_home_url(); ?>/#portfolio">Portfolio</a></li>
                            <li><a href="<?php echo get_home_url(); ?>/#about">About</a></li>
                            <li><a href="<?php the_permalink(112); ?>">Downloads</a></li>
                            <li><a href="<?php echo get_home_url(); ?>/#contacts">Contacts</a></li>
                        </ul>
                    </nav>
                    <a href="#offer" class="btn-castom btn-anсhor btn-line btn-m">Get started</a>
                </div>
            </div>
        </div>
    </header>

<div class="page-head">
        <div class="row text-center">
            <h1><?php the_field('down-title'); ?></h1>
        </div>
    </div>
    <div class="book">
        <div class="container">
            <div class="col-md-offset-1 col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php the_field('down-img'); ?>" alt="book">
                    </div>
                    <div class="col-md-6">
                        <div class="book-info">
                            <?php the_field('down-text'); ?>
                            <h4><?php the_field('down-title02'); ?></h4>
                        </div>
                        <div class="form form-download">
                            <?php echo do_shortcode('[contact-form-7 id="124" title="Download"]'); ?>
                        </div>
                        <div class="book-info book-info02">
                            <h4><?php the_field('down-title03'); ?></h4>
                            <ul>

                            <?php while ( have_rows('down-box') ) : ?>
                                <?php the_row(); ?>

                                <li><?php the_sub_field('down-li'); ?></li>

                            <?php endwhile; ?>

                          </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>