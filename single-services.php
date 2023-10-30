<?php get_header(); ?>



<div class="page page-single service-single">
    <div class="page-head">
        <div class="container">
            <div class="row">
                <h1 class="title"><?php the_title(); ?></h1>
            </div>
            <div class="row">
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="sidebar sticky">
                        <div class="sidebar-menu">
                            <div class="sidebar-title">Услуги</div>
                            <ul>
                                <li><a href="<?php the_permalink(13); ?>">Все услуги</a></li>

                                <?
                                $terms = get_terms(array(
                                    'taxonomy' => 'services_tax',
                                    'hide_empty' => false
                                ));
                                
                                foreach ($terms as $term) {

                                $args =array(
                                    'post_type' => 'services',
                                    'tax_query' => array(
                                        array(
                                        'taxonomy' => 'services_tax',
                                        'field' => $term->term_id,
                                        'terms' => $term->term_id,
                                            'include_children' => false
                                        )
                                    ));

                                $query = new WP_Query($args);
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {  $query->the_post(); ?>

                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>


                                <? }
                                wp_reset_postdata();
                                };// end if query 
                            };
                            ?>

                            </ul>
                        </div>
                    </div>
                    <div class="content-right">

                    <?php while (have_posts()) : the_post(); ?>

                        <div class="full-img"><?php the_post_thumbnail(); ?></div>
                        <div class="text-box">

                            <?php the_content(); ?>

                        </div>

                        <?php $tableHide = get_field('table-hide'); 
                        if($tableHide == false){
                        ?>

                        <div class="price">
                            <table>
                                <tbody>
                                    <tr class="table-titles">
                                        <td>Название услуги</td>
                                        <td>Стоимость</td>
                                        <td>Объем</td>
                                    </tr>

                                          
                                    <?php while ( have_rows('table-box') ) : ?>
                                        <?php the_row(); ?>

                                    <tr>
                                        <td><?php the_sub_field('table-serv'); ?></td>
                                        <td><?php the_sub_field('table-price'); ?></td>
                                        <td><?php the_sub_field('table-size'); ?></td>
                                    </tr>

                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>

                        <?php }; ?>
                        <div class="btn-box text-center">
                            <a href="#order" class="btn-castom fancybox">Заказать уборку</a>
                        </div>
                        <div class="sticky-stopper"></div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="service-content indent" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="text-box">
                        <?php the_field('serv-content'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!--Reviews-->
        <div class="reviews indent" style="padding-top: 60px;">
            <div class="container">
                <div class="row">
                    <h3 class="title">Отзывы</h3>
                </div>
                <div class="row">
                    <div class="slider rev-slider">
                        
                    <?php while ( have_rows('rev-box', 19) ) : ?>
                        <?php the_row(); ?>

                            <div class="rev-item">
                                <div class="rev-img" style="background-image: url(<?php the_sub_field('rev-img'); ?>);"></div>
                                <span class="rev-name"><?php the_sub_field('rev-name'); ?></span>
                                <p class="rev-text"><?php the_sub_field('rev-text'); ?></p>

                                <?php
                                $let = get_sub_field('rev-let'); 
                                if($let != null){ ?>

                                <a href="<?php echo $let; ?>" target="_blank" class="btn-text"><i class="fa fa-file-text" aria-hidden="true"></i> Благодарственное письмо</a>
                                
                                <?php }; ?>
                                
                            </div>

                    <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        

<footer>
        <div class="container">
            <div class="row">
                <div class="footer-col01">
                    <a href="<?php echo get_home_url(); ?>" class="logo">
                        <img src="<?php the_field('logo-img', option)?>" alt="logo">
                        <div class="logo-name">
                            <span class="logo-text01"><?php the_field('logo-text', option)?></span>
                            <span class="logo-text02"><?php the_field('logo-text02', option)?></span>
                        </div>
                    </a>
                    <p class="footer-about">
                    <?php the_field('logo-text03', option)?>
                    </p>
                </div>
                <div class="footer-col02">
                    <div class="footer-label">Меню</div>
                    <div class="footer-nav">

                    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '.footer-nav') ); ?>

                    </div>
                </div>
                <div class="footer-col03">
                    <div class="footer-label">Услуги</div>
                    <div class="footer-nav">
                        <ul>

                        <?
                        $terms = get_terms(array(
                            'taxonomy' => 'services_tax',
                            'hide_empty' => false
                        ));
                        
                        foreach ($terms as $term) {

                        $args =array(
                            'post_type' => 'services',
                            'tax_query' => array(
                                array(
                                'taxonomy' => 'services_tax',
                                'field' => $term->term_id,
                                'terms' => $term->term_id,
                                    'include_children' => false
                                )
                            ));

                        $query = new WP_Query($args);
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {  $query->the_post(); ?>
                            
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                        <? }
                        wp_reset_postdata();
                        };// end if query 
                        };
                        ?>
                           
                        </ul>
                    </div>
                </div>
                <div class="footer-col04">
                    <div class="footer-label">Контакты</div>
                    <ul class="footer-contacts">

                    <?php while ( have_rows('tel-box', option) ) : ?>
                        <?php the_row(); ?>

                        <li><a href="tel:<?php the_sub_field('tel'); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php the_sub_field('tel'); ?></a></li>

                    <?php endwhile; ?>
                        
                        <li><a href="mailto:"><i class="fa fa-envelope" aria-hidden="true"></i> lorem@gmail.com</a></li>
                        <li><span><i class="fa fa-map-marker" aria-hidden="true"></i> Киев, ул.Рыбина 20, оф.102</span></li>
                    </ul>
                    <div class="footer-label">Социальные сети</div>
                    <ul class="footer-social">

                    <?php while ( have_rows('soc-box', option) ) : ?>
                        <?php the_row(); ?>

                        <li><a href="<?php the_sub_field('soc-link'); ?>" target="_blank"><?php the_sub_field('soc-icon'); ?></a></li>
                    
                    <?php endwhile; ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="copy">
            <span><?php the_field('copy', option)?></span>
        </div>
    </footer>
    <div id="order" class="form-modal" style="display: none;">
        <div class="form-title">Оформить заявку</div>
        <?php echo do_shortcode('[contact-form-7 id="93" title="Modal form"]'); ?>
    </div>
    <div id="message-submit" class="text-center form-modal">
        <h3>Спасибо! Ваша заявка отправлена! Мы свяжемся с вами в ближайшее время!</h3>
    </div>
    <!--Scripts-->
    <script src="<?php echo get_template_directory_uri()?>/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/js/jquery.matchHeight-min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>

    <?php wp_footer(); ?>

    <script>
     //Sticky
     var $sticky = $('.sticky');
    var $stickyrStopper = $('.sticky-stopper');
    if (!!$sticky.offset()) { // make sure ".sticky" element exists

        var generalSidebarHeight = $sticky.innerHeight();
        var stickyTop = $sticky.offset().top;
        var stickOffset = 140;
        var stickyStopperPosition = $stickyrStopper.offset().top;
        var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
        var diff = stopPoint + stickOffset;

        $(window).scroll(function () { // scroll event
            var windowTop = $(window).scrollTop(); // returns number

            if (stopPoint < windowTop) {
                $sticky.css({
                    position: 'absolute',
                    top: diff
                });
            } else if (stickyTop < windowTop + stickOffset) {
                $sticky.css({
                    position: 'fixed',
                    top: stickOffset
                });
            } else {
                $sticky.css({
                    position: 'absolute',
                    top: 'initial'
                });
            }
        });

    }
    </script>

</body>
</html>

