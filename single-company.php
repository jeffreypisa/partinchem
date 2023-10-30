<?php get_header(); ?>



<!--page-head-->
<div class="page-head"></div>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!--page-content-->
    <div class="page-content page-why">
        <!--article-->
        <div class="article">
            <div class="container">
                <div class="row">
                    <h1 class="page-title size1"><?php the_title(); ?></h1>
                </div>
                <div class="row">
                    <div class="article-content">                        
                        <p class="article-desc"><?php the_field('blog-anons'); ?></p>
                        <div class="text text-edit">
                            
                            <?php the_content(); ?>

                        </div>
                    </div>
                    <div class="article-img">

                    <?php if(get_the_post_thumbnail_url()){ ?>

                        <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="fancybox"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="why"></a>

                    <?php }; ?>

                    </div>
                </div>
            </div>
        </div>

        <?php  endwhile;  endif; ?>

        <!--other-articles-->
        <div class="other-articles">
            <div class="container">
                <div class="row">

                <?php   
                    $args = array(
                        'post_type'	 => 'company',
                        'post__not_in' => array($post->ID)
                    );
                    $the_query = new WP_Query( $args ); 
                ?>

                <?php if ( $the_query->have_posts() ) : ?>
	            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        
                    <!--blog-box-->
                    <div class="blog-box">
                        <div class="blog-img">

                        <a href="<?php the_permalink(); ?>">
                            <div class="blog-bg" style="background-image: url(

                                <?php if(get_the_post_thumbnail_url()){ ?>
                                    <?php the_post_thumbnail_url(); ?>
                                <?php }else{ ?>
                                    <?php echo get_template_directory_uri()?>/img/no-photo.png
                                <?php }; ?>

                                );">
                                
                                
                            </div>
                        </a>

                        </div>
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
                            <a href="<?php the_permalink(); ?>" class="button button-light">Read more</a>
                        </div>
                    </div>

                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
                
                </div>
            </div>
        </div>

    <!--Partners plusi-->
    <div class="partners-plusi">
        <div class="container">
            <div class="row">

            <?php while ( have_rows('partners-box', 38) ) : ?>
                <?php the_row(); ?>
                
                <!--item-->
                <div class="item">
                    <div class="item-icon">

                    <?php if(get_sub_field('partners-icon')){ ?>

                        <img src="<?php the_sub_field('partners-icon'); ?>" alt="icon">

                    <?php }; ?>

                    </div>
                    <h3 class="item-title size3"><?php the_sub_field('partners-title'); ?></h3>
                    <p class="item-text usp"><?php the_sub_field('partners-text'); ?></p>
                </div>

            <?php endwhile; ?>

            </div>
        </div>
    </div>

<?php get_footer(); ?>