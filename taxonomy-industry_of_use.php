<?php
/**
 *  Template: content-product-group.php
 */
// Get current term.
 $term              = get_queried_object();
 $parent_term_id    = $term->parent;
 $parent_term       = get_term_by('id', $parent_term_id, 'industry_of_use');

// Get the children of this term.
$child_terms = get_terms( array(
    'taxonomy'      => $term->taxonomy,
    'parent'        => $term->term_id,
    'orderby'       => 'menu_order',
    'order'         => 'ASC',
    'hide_empty'    => false
) );


// Get the children of this term.
$sibling_terms = get_terms( array(
    'taxonomy'      => $term->taxonomy,
    'parent'        => $parent_term_id,
    'exclude'       =>array(strval($term->term_id)),
    'orderby'       => 'menu_order',
    'order'         => 'ASC',
    'hide_empty'    => false
) );

?>

<?php get_header(); ?>

<div class="tax-product-content">
    <div class="block hero">
        <div class="container">
            <div class="row">
                <div class="box-md-8">
                    <div class="block__header">
                        <h1>
                            <?php
                            if ( !empty( $parent_term ) ) { 
                                echo '<a title="' . $parent_term->name .'" href="' . get_home_url() . '/product-application/' . $parent_term->slug .'/" style="font-weight:300;font-size:3.5rem;">' . $parent_term->name . ' > </a>'; 
                            } 
                            echo $term->name; 
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box-md-5 box-to-right">
                    <a 
                    title="Find specific products" 
                    class="button button--alternate"
                    href="<?php echo get_home_url() . '/products/'; ?>"
                    >
                    <?php _e(' Find specific products', 'partinchem' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
   
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="box-md-5">
                    <?php if ( $term->description ) { ?>
                        <div class="section__header">
                            <h2 class="section__title section__title--small"><?php _e( 'Description of the', 'partinchem' ); ?> <?php echo $term->name; ?></h2>
                            <div class="section__text"><?php echo $term->description; ?></div>
                        </div>                
                    <?php } ?>
                    <div class="product_list">
                        <?php
                        // If there are any children.
                        if ( empty($parent_term) && !empty( $child_terms ) ) { ?> 
                            <h4>Looking for a specific <?php echo $term->name; ?>?</h4>
                            <ul>
                                <?php foreach( $child_terms as $child_term ) { ?>
                                    <li>
                                        <a title="<?php echo $child_term->name; ?>" href="<?php echo get_home_url() . '/product-application/' . $child_term->slug; ?>/"><?php echo $child_term->name; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                              <h4>More in our assortiment</h4>
                              <ul>
                                <?php foreach( $sibling_terms as $sibling_term ) { ?>
                                    <li>
                                        <a title="<?php echo $sibling_term->name; ?>" href="<?php echo get_home_url() . '/product-application/' . $sibling_term->slug; ?>/"><?php echo $sibling_term->name; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="box-md-5 box-to-right">
                    <div class="single_product_form">
                        <h3><?php _e( 'In need of more information about', 'partinchem' ); ?> <?php echo $term->name; ?>?</h3>
                        <p class="form_info"><?php _e( 'Fill in the form below and we will be in touch within 24 hours. No less.', 'partinchem' ); ?></p>
                        <?php echo do_shortcode('[gravityform id=2 title=false field_values="product-group=' . $term->name . '"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--product-related-->
    <?php   
    $args = array(
        'post_type' => 'products',
        'tax_query' => array(
            array(
                'taxonomy' => $term->taxonomy,
                'terms'    => $term->term_id
            ),
        ),
    );
    $the_query = new WP_Query( $args );       
    ?>

    <?php if ( $the_query->have_posts() ) : ?>
        <div class=" highlighted_products product-related">
            <div class="container">
                <div class="row">
                    <div class="box-md-12">
                        <h3><?php _e( 'Highlighted Products', 'partinchem' ); ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="related-slider slick-slider">

                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                            <?php get_template_part( './template-parts/card/card', '' ); ?>
                        
                        <?php endwhile; ?>
                        
                    </div>

                    <div class="slider_buttons">
                        <button class="btn_prev icon-left-arrow"><i class="fas fa-chevron-left"></i></button>
                        <button class="btn_next icon-right-arrow"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; wp_reset_postdata(); ?>
    
</div>

<?php get_footer(); ?> 