<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


  <!--page-head-->
  <div class="page-head page-head"></div>
  <!--page-content-->
  <div class="page-content page-404">
      <div class="container">
          <div class="row">
              <div class="box-md-6">
                  <h1 class="size2"><?php _e( '404! Page not found!', 'partinchem' ); ?></h1>
                  <div class="text text-edit">
                    <p><?php _e( 'The page you were searching for could not be found.', 'partinchem' ); ?> <a href="<?php echo get_home_url(); ?>"><?php _e( 'Click here to go to the homepage.', 'partinchem' ); ?></a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php get_footer();
