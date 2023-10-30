<?php
/*
Template Name: Contacts
*/
?>

<?php get_header(); ?>

 <!--page-head-->
 <div class="page-head"></div>
    <!--page-content-->
    <div class="page-content page-contacts">
        <div class="container">
            <div class="row">
                <div class="box-static">
                    <h1 class="page-title size1"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="map-content" style="background-image: url(<?php the_field('contact-bg'); ?>);">
            <div class="boxes">

            <?php while ( have_rows('contact-box') ) : ?>
                <?php the_row(); ?>

                <div class="contact-box">
                    <h2 class="contact-title"><span class="country"><?php the_sub_field('contact-city'); ?></span><span class="town"> <?php the_sub_field('contact-country'); ?></span></h2>
                    <div class="contact-info">
                        <p><?php the_sub_field('contact-address'); ?></p>
                        <p>

                        <?php if(get_sub_field('contact-phone')){ ?>

                            T <a href="tel:<?php the_sub_field('contact-phone'); ?>"><?php the_sub_field('contact-phone'); ?></a>

                        <?php }; ?>

                            <br> <a href="mailto:<?php the_sub_field('contact-email'); ?>"><?php the_sub_field('contact-email'); ?></a>
                        </p>
                    </div>
                    <div class="border"></div>
                </div>

            <?php endwhile; ?>
                
            </div>
            <?php 
                $phone = get_field( 'contact_phone', 'options' ); 
            ?>
            <div class="call">
                <?php _e( 'For immediate assistance call us at', 'partinchem' ); ?> <a href="tel:<?php echo $phone; ?>" title="Call"><?php echo $phone; ?></a>

            </div>
        </div>
    </div>


<?php get_footer(); ?>
