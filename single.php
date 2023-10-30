<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<?php get_header(); ?>

     <!--page-head-->
    <div class="page-head"></div>

    <?php while ( have_posts() ) : the_post(); ?>

    <!--page-content-->
    <div class="page-content page-blog page-blog-single">
        <div class="container">
            <div class="row">
                <div class="box-static">
                    <h1 class="page-title size1"><?php the_title(); ?></h1>
                    <div class="date"><?php the_date(); ?></div>
                </div>
            </div>
        </div>
        <div class="blog-content">
            <div class="container">
                <div class="row">
                    <div class="box-12">
                        <a href="<?php the_post_thumbnail_url(); ?>" class="fancybox"><img src="<?php the_post_thumbnail_url(); ?>" alt="blog"></a>
                        <p class="blog-desc"><?php the_field('blog-anons'); ?></p>
                        <div class="text text-edit">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="row justify-end">
                    <div class="box-static">
                        <div class="share">
                            <span class="share-title">
                            Share
                        </span>
                            <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_the_permalink() ); ?>" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo the_title_attribute(); ?> <?php echo urlencode( get_the_permalink() ); ?>" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/cws/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            <a href="mailto:?subject=<?php echo the_title_attribute(); ?>&body=<?php echo urlencode( get_the_permalink() ); ?>" target="_blank"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile; ?>

        <div class="blog-all">
            <div class="container">
                <div class="row">

                 <?php   
                    $args = array(
                        'post_type'	 => 'post',
                        'post__not_in' => array($post->ID)
                    );
                    $the_query = new WP_Query( $args ); 
                ?>

                <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                        $numPost++;
                ?>
                        
                    <!--blog-box-->

                    <?php if($numPost < 10){ ?>

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
                                <h2 class="blog-title size3">
                                
                                <?php if(get_field('blog-short-title')){ 
                                        the_field('blog-short-title');
                                }else{
                                ?>

                                <?php the_title(); ?>

                                <?php }; ?>
                            
                                </h2>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="button button-light"><?php _e( 'Read more', 'partinchem' ); ?></a>
                        </div>
                    </div>

                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>

            </div>
            <div class="row">
                <div class="box-static">
                    <a id="buttonAll" class="button-all"><?php _e( 'See all blogposts', 'partinchem' ); ?></a>
                </div>
            </div>
        </div>
    </div>
  

<?php get_footer(); ?>