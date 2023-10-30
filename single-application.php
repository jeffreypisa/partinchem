<?php get_header(); ?>

<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

        <main class="main main--new">
            <section class="hero hero--background">
                <div class="container">
                    <div class="row">
                        <div class="box-md-8">
                            <div class="hero__content">
                                <h1 class="hero__title hero__title--small"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="container">
                    <div class="row">
                        <div class="box-md-5">
                            <?php if ( have_rows( 'recommendations' ) ) { while ( have_rows( 'recommendations' ) ) { the_row(); ?>
                                <div class="section__header">
                                    <p class="section__text"><?php the_sub_field('recommendation_text_area' ); ?></p>
                                    <?php if ( get_field( 'application_faq' ) ) { ?>
                                        <div class="section__text">
                                            <?php echo do_shortcode('[faq]'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php $recommended_products = get_sub_field( 'recommendedsynergistic_products' ); ?>
                                <?php if ( $recommended_products ) { ?>
                                    <div class="product_list">
                                        <h4><?php _e( 'Products for this application', 'partinchem' ); ?></h4>
                                        <ul>
                                            <?php foreach ( $recommended_products as $post ) { setup_postdata( $post ); ?>
                                                <li>
                                                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </li>                                        
                                            <?php } wp_reset_postdata(); ?>
                                        </ul>            
                                    </div>
                                <?php } ?>
                            <?php } } ?>
                        </div>
                        <div class="box-md-5 box-to-right">
                            <div class="single_product_form">
                                <h3><?php _e( 'In need of more information about this application?', 'partinchem' ); ?></h3>
                                <p class="form_info"><?php _e( 'Fill in the form below and we will be in touch within 24 hours. No less.', 'partinchem' ); ?></p>
                                <?php echo do_shortcode('[gravityform id=2 title=false field_values="product-group=' . get_the_title() . '"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ( $recommended_products ) { ?>
                <section class=" highlighted_products product-related">
                    <div class="container">
                        <div class="row">
                            <div class="box-md-12">
                                <h3><?php _e( 'Application Products', 'partinchem' ); ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="related-slider slick-slider">
                                <?php foreach ( $recommended_products as $post ) { setup_postdata( $post ); ?>
                                    <?php get_template_part( './template-parts/card/card', '' ); ?>
                                
                                <?php } wp_reset_postdata(); ?>                        
                            </div>
                            <div class="slider_buttons">
                                <button class="btn_prev icon-left-arrow"><i class="fas fa-chevron-left"></i></button>
                                <button class="btn_next icon-right-arrow"><i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </main>

<?php } } ?>

<?php get_footer(); ?>