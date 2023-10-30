<?php get_header(); ?>

<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

        <main class="main main--new">
            <section class="hero hero--background">
                <div class="container">
                    <div class="row">
                        <div class="box-12">
                            <div class="hero__content">
                                <h1 class="hero__title hero__title--small"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="container">
                    <div class="row justify-between">
                        <div class="box-md-7">
                            <div class="section__header">
                                <h2 class="section__title section__title--small"><?php _e( 'About', 'partinchem' ); ?> <?php the_title(); ?></h2>
                                <p class="section__text"><?php echo get_field('product_description_short' ); ?></p>
                                <?php if ( get_field( 'product_faq' ) ) { ?>
                                    <div class="section__text">
                                        <?php echo do_shortcode('[faq]'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <article class="accordion">
                                <?php 
                                $product_composition = get_field( 'product_composition_availability' ); 

                                if ( $product_composition === 'YES' ) {
                                    $type = get_field( 'blend_or_single_component' );
                                    if ( $type === 'BLEND' ) {
                                        if ( have_rows( 'product_composition_blend' ) ) { ?>
                                            <div class="accordion__item">
                                                <button id="accordion-toggle-1" class="accordion__link js-accordion" aria-expanded="false" aria-controls="accordion-panel-1" data-accordion-index="1"> 
                                                    <p><?php _e( 'Product Composition', 'partinchem' ); ?></p>
                                                    <svg width="15" height="9" xmlns="http://www.w3.org/2000/svg"><path d="M.22 1.373l6.197 6.422a1.462 1.462 0 002.12 0l6.244-6.47c.289-.3.293-.785.007-1.09A.732.732 0 0013.72.228l-5.713 5.92a.731.731 0 01-1.06 0L1.279.274a.73.73 0 00-1.06 0 .797.797 0 000 1.099z" fill="#2B3147" fill-rule="evenodd"/></svg>   
                                                </button>
                                                <div id="accordion-panel-1" class="accordion__panel js-accordion-panel" role="region" aria-labelledby="accordion-toggle-1">
                                                    <div class="accordion__content">                                                            
                                                        <?php while ( have_rows( 'product_composition_blend' ) ) { the_row( 'product_composition_blend' ); ?>
                                                            <ul>
                                                                <?php if ( get_sub_field( 'product_name' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Product name:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'product_name' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'cas_number' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'CAS number:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'cas_number' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'chemical_name' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Chemical name:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'chemical_name' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'moleculair_formula' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Moleculair formula:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'moleculair_formula' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'molecular_weight_gmol' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Molecular weight (g/mol):', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'molecular_weight_gmol' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'product_percentage_of_the_blend' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Product percentage of the blend:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'product_percentage_of_the_blend' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?> 
                                    <?php } else if ( $type === 'NO BLEND' ) {
                                            if ( have_rows( 'product_composition_single_component' ) ) { ?>
                                            <div class="accordion__item">
                                                <button id="accordion-toggle-1" class="accordion__link js-accordion" aria-expanded="false" aria-controls="accordion-panel-1" data-accordion-index="1"> 
                                                    <p><?php _e( 'Product Composition', 'partinchem' ); ?></p>
                                                    <svg width="15" height="9" xmlns="http://www.w3.org/2000/svg"><path d="M.22 1.373l6.197 6.422a1.462 1.462 0 002.12 0l6.244-6.47c.289-.3.293-.785.007-1.09A.732.732 0 0013.72.228l-5.713 5.92a.731.731 0 01-1.06 0L1.279.274a.73.73 0 00-1.06 0 .797.797 0 000 1.099z" fill="#2B3147" fill-rule="evenodd"/></svg>   
                                                </button>
                                                <div id="accordion-panel-1" class="accordion__panel js-accordion-panel" role="region" aria-labelledby="accordion-toggle-1">
                                                    <div class="accordion__content">                                                            
                                                        <?php while ( have_rows( 'product_composition_single_component' ) ) { the_row( 'product_composition_single_component' ); ?>
                                                            <ul>                        
                                                                <?php if ( get_sub_field( 'cas_number' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'CAS number:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'cas_number' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'chemical_name' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Chemical name:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'chemical_name' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'moleculair_formula' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Moleculair formula:', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'moleculair_formula' ); ?></span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if ( get_sub_field( 'molecular_weight_gmol' ) ) { ?>
                                                                    <li>
                                                                        <span><?php _e( 'Molecular weight (g/mol):', 'partinchem' ); ?></span>
                                                                        <span><?php the_sub_field( 'molecular_weight_gmol' ); ?></span>
                                                                    </li>
                                                                <?php } ?>                                                                   
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?> 
                                    <?php } ?>
                                <?php } ?>
                                <?php 
                                $datasheet = get_field( 'datasheet_availability' ); 
                                if ( $datasheet !== 'NO' ) { ?>
                                    <div class="accordion__item">
                                        <button id="accordion-toggle-2" class="accordion__link js-accordion" aria-expanded="false" aria-controls="accordion-panel-2" data-accordion-index="2"> 
                                            <p><?php _e( 'Product Specification', 'partinchem' ); ?></p>
                                            <svg width="15" height="9" xmlns="http://www.w3.org/2000/svg"><path d="M.22 1.373l6.197 6.422a1.462 1.462 0 002.12 0l6.244-6.47c.289-.3.293-.785.007-1.09A.732.732 0 0013.72.228l-5.713 5.92a.731.731 0 01-1.06 0L1.279.274a.73.73 0 00-1.06 0 .797.797 0 000 1.099z" fill="#2B3147" fill-rule="evenodd"/></svg>   
                                        </button>
                                        <div id="accordion-panel-2" class="accordion__panel js-accordion-panel" role="region" aria-labelledby="accordion-toggle-2">
                                            <div class="accordion__content">
                                                <ul>
                                                    <?php if ( have_rows( 'product_specifications_&_certifcate_of_analysis' ) ) { while ( have_rows( 'product_specifications_&_certifcate_of_analysis' ) ) { ?> <?php the_row(); ?>                
                                                        <li>
                                                            <?php $test = get_sub_field('test'); ?>
                                                            <span><?php echo $test->name ?>:</span>
                                                            <span><?php the_sub_field('product_specification'); ?></span>
                                                        </li>
                                                    <?php } } ?>                                             
                                                    <li>
                                                        <?php                                                                 
                                                        $forms = get_the_terms( $post, 'product-form' );    
                                                        $form_names = [];
                                                        foreach ( $forms as $form ) {
                                                            array_push( $form_names, $form->name );
                                                        }                                          
                                                        ?>
                                                        <span>Product form(s):</span>
                                                        <span><?php echo implode( ', ', $form_names ); ?></span>
                                                    </li>
                                                    <li>
                                                        <?php                                                                 
                                                        $packaging = get_the_terms( $post, 'packaging' );    
                                                        $packaging_names = [];
                                                        foreach ( $packaging as $package ) {
                                                            array_push( $packaging_names, $package->name );
                                                        }                                          
                                                        ?>
                                                        <span>Packaging option(s):</span>
                                                        <span><?php echo implode( ', ', $packaging_names ); ?></span>                                                      
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>                                
                                <?php if ( have_rows( 'tabs_repeater' ) ) { 
                                    $count = 2;
                                    while ( have_rows( 'tabs_repeater' ) ) { the_row( 'tabs_repeater' ); ?>
                                        <?php 
                                        $count++;
                                        $internal = get_sub_field( 'internal' ); 

                                        if ( !$internal ) { ?>
                                            <div class="accordion__item">
                                                <button
                                                    id="accordion-toggle-<?php echo $count; ?>"
                                                    class="accordion__link js-accordion"
                                                    aria-expanded="false"
                                                    aria-controls="accordion-panel-<?php echo $count; ?>"
                                                    data-accordion-index="<?php echo $count; ?>"> 
                                                    <p><?php the_sub_field( 'title' ); ?></p>
                                                    <svg width="15" height="9" xmlns="http://www.w3.org/2000/svg"><path d="M.22 1.373l6.197 6.422a1.462 1.462 0 002.12 0l6.244-6.47c.289-.3.293-.785.007-1.09A.732.732 0 0013.72.228l-5.713 5.92a.731.731 0 01-1.06 0L1.279.274a.73.73 0 00-1.06 0 .797.797 0 000 1.099z" fill="#2B3147" fill-rule="evenodd"/></svg>   
                                                </button>
                                                <div 
                                                    id="accordion-panel-<?php echo $count; ?>" 
                                                    class="accordion__panel js-accordion-panel"
                                                    role="region"
                                                    aria-labelledby="accordion-toggle-<?php echo $count; ?>">
                                                    <div class="accordion__content">
                                                        <?php the_sub_field( 'text' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </article>
                          
                            <div class="section__buttons">
                                <a class="button button--alternate" title="<?php _e( 'Product Data Sheet', 'partinchem' ); ?>" href="#" id="pdf-button-data-sheet"><?php _e( 'Product Data Sheet', 'partinchem' ); ?></a>
                                <?php get_template_part( './template-parts/pdf/pdf', 'data-sheet' ); ?>
                                <?php
                                $compliant = get_field( 'reach_declaration' );
                                if ( $compliant === 'Compliant' ) { ?>
                                    <a class="button button--alternate" title="<?php _e( 'REACH compliance', 'partinchem' ); ?>" href="#" id="pdf-button-reach"><?php _e( 'REACH compliance', 'partinchem' ); ?></a>
                                    <?php get_template_part( './template-parts/pdf/pdf', 'reach' ); ?>
                                <?php } ?> 
                                <?php if ( have_rows( 'buttons_repeater' ) ) { while ( have_rows( 'buttons_repeater' ) ) { the_row( 'buttons_repeater' ); ?>
                                    <?php 
                                    $type = get_sub_field( 'type' ); 
                                    if ( $type === 'link' ) {
                                        $link = get_sub_field( 'link' ); ?>
                                        <a class="button button--alternate" title="<?php echo $link[ 'title' ]; ?>" href="<?php echo $link[ 'url' ]; ?>" target="<?php echo $link[ 'target' ]; ?>"><?php echo $link[ 'title' ]; ?></a>
                                    <?php } else if ( $type === 'file' ) { 
                                        $label = get_sub_field( 'label' ); 
                                        ?>
                                        <div class="button button--alternate button--select">
                                            <select name="Download File">
                                                <option><?php echo $label; ?></option>
                                                <?php if ( have_rows( 'file' ) ) { while ( have_rows( 'file' ) ) { the_row( 'file' ); 
                                                    $language = get_sub_field( 'language' ); 
                                                    $file = get_sub_field( 'file' );  
                                                    ?>
                                                    <option value="<?php echo $file[ 'url' ]; ?>"><?php echo $label . ' (' . $language . ')'; ?></option>
                                                <?php } } ?>   
                                            </select>                                                                                 
                                        </div>
                                    <?php } ?>
                                <?php } } ?>
                            </div>
                            <?php if ( is_user_logged_in() ) { 
                                $args = array(
                                    'post_type'			=> 'application',                          
                                    'orderby'			=> 'menu_order',
                                    'order'				=> 'ASC',
                                    'post_status'		=> 'publish',
                                    'posts_per_page'	=> -1,
                                );

                                $application = new WP_Query( $args );
                                ?>
                                
                                <?php if ( $application->have_posts() ) { ?>
                                    <?php $post_id = get_the_id(); ?>
                                    <div class="section__application">
                                        <?php while ( $application->have_posts() ) { $application->the_post(); 
                                            $products = get_field( 'application_products' );
                                            
                                            if ( in_array( $post_id, $products ) ) { 
                                                $product_titles = [];
                                                foreach ( $products as $product ) { 
                                                    $product_title = get_the_title( $product );
                                                    $product_link = get_the_permalink( $product );
                                                    $product_full = '<a href="' . $product_link . '">' . $product_title . '</a>';                                
                                                    array_push( $product_titles, $product_full );                                                                  
                                                } ?>      
                                                <p class="section__text">This product is often used together with <?php echo implode( ", ", $product_titles ); ?> for <strong><?php the_title(); ?></strong></p>
                                            <?php } ?>                        
                                        <?php } wp_reset_postdata(); ?>                                                
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="box-md-4">
                            <div class="section__content section__content--pulled-up">
								<?php get_template_part( './template-parts/cta' ); ?>
							</div>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <script type="text/javascript">
       
        </script>

<?php } } ?>

<?php get_footer(); ?>