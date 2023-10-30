<?php
/**
 *  Template: content-product-group.php
 */
// Get current term.
 $term              = get_queried_object();
 $parent_term_id    = $term->parent;
 $parent_term       = get_term_by('id', $parent_term_id, 'products_tax');

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
                                echo '<a title="' . $parent_term->name .'" href="' . get_home_url() . '/product-group/' . $parent_term->slug .'" style="font-weight:300;font-size:3.5rem;">' . $parent_term->name . ' > </a>'; 
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
                    <?php if ( !empty( $parent_term ) ) { ?>
                        href="<?php echo get_home_url() . '/products?product-group-1=' . $parent_term->term_id . '&product-group-2=' . $term->term_id; ?>"
                    <?php } else { ?>
                        href="<?php echo get_home_url() . '/products?product-group-1=' . $term->term_id; ?>"
                    <?php } ?> 
                    >
                    Find specific products
                    </a>
                </div>
            </div>
        </div>
    </div>
   
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="box-md-5">
                    <div class="product_description">
                        <h3>Description of the <?php echo $term->name; ?></h3>
                        <p><?php echo $term->description; ?></p>
                    </div>

                    <div class="product_list">
                        <?php
                        // If there are any children.
                        if ( empty($parent_term) && !empty( $child_terms ) ) { ?> 
                            <h4>Looking for a specific <?php echo $term->name; ?>?</h4>
                            <ul>
                                <?php foreach( $child_terms as $child_term ) { ?>
                                    <li>
                                        <a title="<?php echo $child_term->name; ?>" href="<?php echo get_home_url() . '/product-group/' . $child_term->slug; ?>"><?php echo $child_term->name; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                              <h4>More in our assortiment</h4>
                              <ul>
                                <?php foreach( $sibling_terms as $sibling_term ) { ?>
                                    <li>
                                        <a title="<?php echo $sibling_term->name; ?>" href="<?php echo get_home_url() . '/product-group/' . $sibling_term->slug; ?>"><?php echo $sibling_term->name; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="box-md-5 box-to-right">
                    <div class="single_product_form">
                        <h3 >In need of more information about <?php echo $term->name; ?>?</h3>
                        <p class="form_info">Fill in the form below and we will be in touch within  24 hours. No less.</p>
                        <?php echo do_shortcode('[gravityform id=2 title=false field_values="product-group=' . $term->name . '"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--product-related-->
    <div class=" highlighted_products product-related">
        <div class="container">
            <div class="row">
                <div class="box-md-12">
                    <h3>Highlighted Products</h3>
                </div>
            </div>
            <div class="row">
                <div class="related-slider slick-slider">

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
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                        <div class="highlighted_item">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                <div class="highlighted_product">
                                    <h5>
                                        <?php the_title(); ?>
                                    </h5>
                                    <div class="product_desc">
                                        <p class="highlighted_desc">
                                            <?php echo wp_trim_words( get_field('product_description_short'), 10, '' ); ?> 
                                        </p>
                                    </div>
                                    <span class="highlighted_link">
                                        View product
                                    </span>
                                </div>
                            </a>
                        </div>
                    
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                    
                </div>

                <div class="slider_buttons">
                        <button class="btn_prev icon-left-arrow"></button>
                        <button class="btn_next icon-right-arrow"></button>
                    </div>
            </div>
        </div>
    </div>
    
</div>

<?php get_footer(); ?> 