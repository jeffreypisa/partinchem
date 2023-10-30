<?php
/*
Template Name: Reviews
*/
?>
<?php get_header(); ?>

<div class="page page-reviews">
        <div class="page-head">
            <div class="container">
                <div class="row">
                    <h1 class="title"><?php the_field('rp-title'); ?></h1>
                </div>
            </div>
            <div class="page-content">
                <div class="reviews">
                    <div class="container">

                    <?php while ( have_rows('rev-box') ) : ?>
                        <?php the_row(); ?>

                        <div class="col-sm-6 col-md-4">
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
                        </div>

                    <?php endwhile; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>

