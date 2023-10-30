<?php
/**
 * Template:			card-taxonomy.php
 * Description:			Taxonomy card template
 */

global $delay;
global $post;
global $count;
$terms = wp_get_object_terms( $post->ID, 'products_tax' );
$delay += 0.125;
?>

<article class="card card--featured fadeInUp" style="animation-delay: <?php echo $delay; ?>s">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank" class="card__inner">   
        <div class="card__body">
            <h4 class="card__heading"><?php the_title(); ?></h4>
            <?php if ( $terms ) { ?>
                <div class="card__labels">
                    <?php foreach( $terms as $term ) {
                        if ( $term->name === 'Others' ) { continue; } 
                        $count++; 
                        echo '<p><i class="fas fa-tag"></i>' . $term->name . '</p>';
                        if ( $count === 1 ) break;
                    } ?>
                </div>
            <?php } ?>
            <?php $description = get_field( 'product_description_short' ); ?>
            <p class="card__text"><?php echo wp_trim_words( $description, 15, '...') ?></p>
        </div>
    </a>
</article>