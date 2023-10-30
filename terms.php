<?php
/*
Template Name: Privacy Policy, Terms of Use
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