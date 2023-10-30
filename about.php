<?php
/*
Template Name: About
*/
?>
<?php get_header(); ?>

<div class="page page-about">
    <div class="page-head">
        <div class="container">
            <div class="row">
                <h1 class="title"><?php the_field("ac-title"); ?></h1>
            </div>
        </div>
        <div class="page-content">
            <div class="about">
                <div class="container">
                    <div class="col-sm-4">
                        <div class="about-img">
                            <img src="<?php the_field("about-img"); ?>" alt="about">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="about-text">
                            <div class="text-box">
                               
                                <?php the_field("about-text"); ?>

                            </div>
                        </div>
                        <div class="btn-box">
                            <a href="<?php the_field("about-link"); ?>" class="btn-castom"><?php the_field("about-btn"); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Stat-->
        <div class="stat" style="background-image: url(<?php the_field('stat-bg', 11); ?>); background-size: cover;">
            <div class="container text-center">
                <div class="row">
                    <div id="counter">

                    <?php while ( have_rows('stat-box', 11) ) : ?>
                        <?php the_row(); ?>

                        <div class="col-sm-4">
                            <div class="counter-value" data-count="<?php the_sub_field('stat-num'); ?>">0</div>
                            <div class="counter-label"><?php the_sub_field('stat-text'); ?></div>
                        </div>

                    <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
        <!--Reviews-->
        <div class="reviews indent">
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

<?php get_footer(); ?>
