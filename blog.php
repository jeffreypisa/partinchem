<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<!--page-head-->
<div class="page-head"></div>
    <!--page-content-->
    <div class="page-content page-blog">
        <div class="container">
            <div class="row">
                <div class="box-static">
                    <h1 class="page-title size1"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row">

            <?php 
            $args = array (
                'post_type' => 'post',
                'post_status' => 'publish',
                'order'        => 'ASC',
                'orderby'   => 'menu_order',
            );

            $query = new WP_Query( $args );

            if( $query->have_posts() ){
                $count = 0;
                while( $query->have_posts() ){ $query->the_post();
                $count++;
                ?>
                    
                <!--blog-box-->

                <?php if($count < 10){ ?>

                    <div class="blog-box">

                <?php }else{ ?>

                    <div class="blog-box blog-box-hidden">

                <?php }; ?>

                <a href="<?php the_permalink(); ?>">
                
                    <div class="blog-img">

                        <div class="blog-bg" style="background-image: url(

                            <?php if(get_the_post_thumbnail_url()){ ?>  
                                <?php the_post_thumbnail_url(); ?>
                            <?php }else{ ?>
                                <?php echo get_template_directory_uri()?>/img/no-photo.png
                            <?php }; ?>

                            );">
                            
                        </div>

                    </div>

                </a>
                
                    <div class="blog-box-content">
                        <div class="blog-info">
                            <span class="blog-title size3" style="font-weight:700;display:block;font-family: var(--font-roboto);">
                            
                            <?php if(get_field('blog-short-title')){ 
                                    the_field('blog-short-title');
                            }else{
                            ?>

                            <?php the_title(); ?>

                            <?php }; ?>
                        
                            </span>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="button button-light"><?php _e( 'Read more', 'partinchem' ); ?></a>
                    </div>
                </div>

                <?php
                }
                wp_reset_postdata(); 
            } 
            ?>

            </div>
            <div class="row">
                <div class="box-static">
                    <a id="buttonAll" class="button-all"><?php _e( 'See all blogposts', 'partinchem' ); ?></a>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>