<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php $id = get_the_ID(); ?>

  <!--page-head-->
  <div class="page-head"></div>
  <!--page-content-->
  <div class="page-content page-terms">
      <div class="container">
          <div class="row">
              <h1 class="page-title size1"><?php the_title(); ?></h1>
          </div>
          <div class="row">
              <div class="text text-edit">
               
                <?php the_field('text', $id); ?>

              </div>
          </div>
      </div>
  </div>

  <?php get_footer();