<?php
/*
Template Name: Services
*/
?>

<?php get_header(); ?>

<div class="page services-page">
        <div class="page-head">
            <div class="container">
                <div class="row">
                    <h1 class="title">Наши услуги</h1>
                </div>
            </div>
        </div>

        <!--Services-->
        <div class="services">
            <div class="container">
                <div class="col-md-offset-1 col-md-10">
                    <div class="row">

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

                        <!--service-item-->
                        <div class="col-xs-6 col-sm-4">
                            <a href="<? the_permalink(); ?>" class="service-item">               
                                <span class="service-icon"><img src="<?php the_field('serv-icon'); ?>" alt="room"></span>
                                <h2 class="service-title"><?php the_title(); ?></h2>
                            </a>
                        </div>

                    <? }
                    wp_reset_postdata();
                    };// end if query 
                };
                ?>

                    
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>