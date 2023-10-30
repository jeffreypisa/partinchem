<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<div class="page-search">
		<div class="block block--hero">
			<div class="container">
				<div class="row">
					<div class="box-md-8">
						<div class="block__header block__header--search">
							<h1><?php _e( 'You searched for:', 'partinchem' ); ?> <span>"<?php echo $_GET['s']; ?>"</span></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="block">	
			<!-- <div class="product-container"> -->
			<div class="container">
				<div class="row justify-between">
					<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
						<div class="box-md-3">
							<div class="item">
								<div class="product product-green small
								<?php 
								if($post->post_type === 'post') { echo ' product--blog'; } 
								if($post->post_type === 'page') { echo ' product-blue'; } 
								?>">
									<a href="<?php the_permalink(); ?>" target="_blank" class="link-modal"></a>
									<div class="product-info">
										<h2 class="size3 product-title"><?php the_title(); ?></h2>
										<div class="product-desc">
											<p><?php echo get_the_excerpt(); ?></p>
										</div>
									</div>
									<button class="button-more">
										<?php 
										if($post->post_type === 'products') { 
											echo 'More information';
										} else if ($post->post_type === 'page') {
											echo 'Visit Page';
										} else { 
											echo 'Read Post';
										} ?>
									</button>
								</div>
							</div>
						</div>
					<?php } } else { 
						$search_title = get_field( 'search_title', 'options' );
						$search_text = get_field( 'search_text', 'options' );
						$search_highlighted = get_field( 'search_highlighted', 'options' );
						?>
						<div class="box-md-6">
							<div class="block__header block__header--no-results">
								<h2><?php echo $search_title; ?></h2>
								<p><?php echo $search_text; ?></p>
							</div>

							<?php if ( $search_highlighted ) { ?>
								<div class="block__highlighted">
									<h3><?php _e( 'Highlighted Products', 'partinchem' ); ?></h3>
									<div class="row">
										<?php foreach ( $search_highlighted as $post ) { setup_postdata( $post ); ?>
											<div class="box-sm-6">
												<div class="highlighted_item highlighted_item--no-margin">
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
																<?php _e( 'View product', 'partinchem' ); ?>
															</span>
														</div>
													</a>
												</div>
											</div>
										<?php } wp_reset_postdata(); ?>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="box-md-4">
							<div class="block__pulled-up">
								<?php get_template_part( './template-parts/cta' ); ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
