<?php
/**
 * Template:			card-taxonomy.php
 * Description:			Taxonomy card template
 */

global $delay;
$delay += 0.125;
$taxonomy_details = get_taxonomy( $post->taxonomy ); 
?>

<article class="card card--news fadeInUp" style="animation-delay: <?php echo $delay; ?>s">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank" class="card__inner">
        <div class="card__header">
            <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'medium_large' );
            } ?>
        </div>   
        <div class="card__body">
            <h4 class="card__heading"><?php the_title(); ?></h4>
            <p class="card__text"><?php echo get_the_excerpt(); ?></p>
            <div class="card__footer">
                <p class="card__more"><?php _e( 'Read more', 'partinchem' ); ?><i class="fas fa-chevron-right"></i></p>
            </div>
        </div>
    </a>
</article>	