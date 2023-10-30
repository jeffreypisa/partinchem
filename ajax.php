<?php if(isset($_POST['filter'])){ ?>
 <?php 
   $cat=array();
   
   $cat_term=$_POST[6];

   $cat_arg = array(
    'taxonomy'=>'products_tax',
    'child_of'=> 0,
    'parent'=> 0,
    'orderby'=> 'name',
    'show_count'=> 0,
    'pad_counts'=> 0,
    'hierarchical' => 0,
    'title_li'=> '',
    'hide_empty'=> 0
   );
   
  $cats = get_categories($cat_arg);
  print_r($cats);
  
 
 
 //if brand is empty then choose all the brands
 if(count($_POST['cat'])==0){
   foreach($cats as $a){
     array_push($cat,$a->term_id);
   }
 }
 if(count($_POST['cat'])!=0){
   $cat=$_POST['cat'];
 }
 
 $filter_set=true;
 ?>
 <!-- if filter set -->
 <?php if($filter_set){ ?>
 
 <?php 
   $args=array(
    'post_type'=>'products',
    'tax_query' => array(
    'relation' => 'AND',
       array(
         'taxonomy' => 'products_tax',
         'field' => 'term_id',
         'terms' => array($cat_term),
         'operator' => 'IN'
       )
    )
 );
 ?>
 <?php $the_query = new WP_Query( $args ); ?>
 <?php if ( $the_query->have_posts() ) : ?>
 <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
 <div class="single_prod">
   <div class="single_prod_top row">
     <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
   </div>
   <div class="single_prod_bot row">
     <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
   </div>
 </div>
 <?php endwhile; ?>
 <?php wp_reset_postdata(); ?>
 <?php else : ?>
 <p><?php _e( 'Sorry, no products matched your criteria.' ); ?></p>
 <?php endif; ?>
 <?php } ?>
 <?php } ?>