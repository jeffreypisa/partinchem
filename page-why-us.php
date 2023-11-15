<?php
/**
 * Template Name: About 
 */

get_header(); ?>

<!--Main-->
<div class="main main--new">
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="box-md-8">
                    <div class="block__header">
                        <?php the_field( 'hero_header'); ?>
                        <a title="Download" class="why_header-link" target="_blank" href="<?php the_field('header_download_link'); ?>"><?php the_field('header_download_text'); ?></a>                                  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="block timeline">
        <div class="container">
            <div class="row justify-center items-start">
                <div class="box-md-12">
                    <h2><?php the_field('timeline_title'); ?></h2>
                </div>
                <div class="box-md-10">
                    <?php if( have_rows( 'timeline_item') ):
                        while( have_rows( 'timeline_item') ) : the_row();
                            ?>
                                <div class="timeline_grid">
                                <div class="timeline_block">
                                    <p class="title"><?php the_sub_field('title'); ?></p>
                                    <p><?php the_sub_field('text'); ?></p>
                                </div>
                                <div class="timeline_date">
                                    <div><?php the_sub_field('date'); ?></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="block timeline">
        <div class="container">
            <div class="row justify-between">
                <div class="box-md-12">
                    <h3>
                        <?php the_field('partinchem_title'); ?>
                    </h3>
                </div>
                <div class="box-md-5">
                    <div class="why_content">
                        <?php the_field('why_content_left'); ?>
                    </div>
                </div>
                <div class="box-md-5">
                    <div class="why_content">
                        <?php the_field('why_content_right'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>


