<?php
/*
Template Name: Articles
*/
?>
<?php get_header(); ?>

<div class="page articles">
        <div class="page-head">
            <div class="container">
                <div class="row">
                    <h1 class="title"><?php the_field('ap-title'); ?></h1>
                </div>
            </div>
            <div class="page-content">
                <div class="container">


                <!-- the loop -->
                <?php 
                $wp_query = new WP_Query('cat=4');
                while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                    <!--item-->
                    <div class="col-sm-6 col-md-4">
                        <a href="<?php the_permalink(); ?>" class="box article-box">
                            <div class="box-img" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
                            <h2 class="box-title"><?php the_title(); ?></h2>
                        </a>
                    </div>
                
                <?php endwhile; ?>
                
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
