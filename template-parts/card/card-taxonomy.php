<?php
/**
 * Template:			card-taxonomy.php
 * Description:			Taxonomy card template
 */

global $delay;
$delay += 0.125;
$taxonomy_details = get_taxonomy( $post->taxonomy ); 
?>

<article class="card card--taxonomy fadeInUp" style="animation-delay: <?php echo $delay; ?>s">
    <a href="<?php echo '/' . $taxonomy_details->rewrite['slug'] . '/' . $post->slug . '/'; ?>" target="_blank" class="card__inner">
        <div class="card__body">
            <span class="card__title"><?php echo $taxonomy_details->label; ?></span>
            <h4 class="card__heading"><?php echo $post->name; ?></h4>
        </div>
    </a>
</article>	