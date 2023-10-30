<?php
/**
 * Template:			card-product.php
 * Description:			Product card template
 */

$terms = get_the_terms( $post, 'products_tax' );
$terms_array = [];
foreach ( $terms as $term ) {
    array_push ( $terms_array, $term->term_id );
}
global $delay;
$delay += 0.125;
?>


<article class="card fadeInUp" data-terms="<?php echo implode( ",", $terms_array ); ?>" style="animation-delay: <?php echo $delay; ?>s">
    <div class="card__inner">   
        <h4><?php the_title(); ?></h4>
        <p>Etiam sit amet orci eget eros faucibus tin cidunt. Duis leo. Sed fringill</p>
    </div>
</article>	