<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>" class="no-js">

<head>

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/favicon/safari-pinned-tab.svg" color="#000000">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-74312627-1');
    </script>

    <!-- Global site tag (gtag.js) - Google Ads: 666290964 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-666290964"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-666290964');
    </script>

    <?php wp_head(); ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300&display=swap" rel="stylesheet">

</head>


<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <header class="header<?php if ( is_tax() || is_search() || is_singular( array( 'products', 'application' ) ) || is_page(8598) ) { echo ' header--alt'; } ?> is_transparent">
        <div class="header__container">
            <div class="header__logo">
                <a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                    <picture>
                        <img class="logodark" alt="Partinchem logo" width="200" height="43" src="<?php the_field('logo', 'option'); ?>" title="Logo">
                        <img class="logolight" alt="Partinchem logo" width="200" height="43" src="<?php the_field('logo_light', 'option'); ?>" title="Logo">
                    </picture>
                </a>
            </div>			
            <div class="header__navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'nav', 'menu_class' => 'nav-list') ); ?>
            </div>
            <div class="header__sidebar">
                <?php if ( is_front_page() ) { ?>
                    <a href="#stock" class="stock__button button button--alternate" title="<?php _e( 'Available Stock', 'partinchem' ); ?>"><?php _e( 'Available Stock', 'partinchem' ); ?></a>
                <?php } ?>
                <?php if ( is_page(3688) || is_page(8598) ) { ?>
                    <a href="<?php echo home_url( '#stock' ); ?>" class="stock__button button button--alternate" title="<?php _e( 'Available Stock', 'partinchem' ); ?>"><?php _e( 'Available Stock', 'partinchem' ); ?></a>
                <?php } ?>
                <div class="search-basket">
                    <?php if ( !is_front_page() && !is_page( 3688 ) && !is_page(8598) ) { ?>
                        <div id="searchPanelDesktop" class="search-panel--desktop">
                            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                <input type="text" class="input input-search" value="" name="s" id="s" placeholder="<?php _e( 'CAS no. / Product name', 'partinchem' ); ?>"/>
                                <button class="button button-dark" id="searchsubmit" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <button id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                        <div id="searchPanel" class="search-panel">
                            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                <input type="text" class="input input-search" value="" name="s" id="s-mobile" placeholder="<?php _e( 'CAS no. / Product name', 'partinchem' ); ?>" />
                                <button class="button button-dark" id="searchsubmit" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    <?php } ?>
                    <a href="<?php the_permalink(3326); ?>" id="productList" class="product-list">
                        <span class="icon">
                            <svg width="22" height="23" viewBox="0 0 22 23" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.307 4.424C8.111.62 14.278.62 18.082 4.424c3.565 3.565 3.789 9.207.67 13.032l.707 2.12-2.12-.706c-3.826 3.117-9.467 2.894-13.032-.671-3.804-3.804-3.804-9.971 0-13.775z" fill="#FFF" stroke="#2B3147" stroke-width="2" fill-rule="evenodd"/>
                            </svg>
                        </span>
                        <span id="productCount" class="product-count simpleCart_quantity"></span>
                    </a>
                </div>
            </div>
            <div class="header__toggle">
                <a id="navigationButton" class="button-navigation"><span></span></a>
            </div>
        </div>
    </header> 