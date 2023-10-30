<?php 
/**
 * Template:			pdf-data-sheet.php
*/

if ( have_rows( 'reach_data' ) ) { while ( have_rows( 'reach_data') ) { the_row();
    $registration_no = get_sub_field( 'registration_number' );
    $tonnage_band = get_sub_field( 'tonnage_band_mt' );
}}

?>

<div class="pdf" id="pdf-data-sheet">
    <img style="width:200px" alt="Partinchem logo" src="data:image/png;base64,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">
    <br><br><br><br><br>
    <h2 style="font-size:32px;color:#2b3147"><strong>Product Data Sheet</strong></h2>
    <h4 style="color:#2b3147"><?php the_title(); ?></h4>
    <hr>
    <p style="font-size:14px;color:#2b3147;">Date: <?php echo date("l, M j, Y"); ?></p>   
    <?php 
     $product_composition = get_field( 'product_composition_availability' ); 

     if ( $product_composition === 'YES' ) {
         $type = get_field( 'blend_or_single_component' );
         if ( $type === 'BLEND' ) {
             if ( have_rows( 'product_composition_blend' ) ) { ?>
                <p style="color:#2b3147;"><strong><?php _e( 'Product Composition', 'partinchem' ); ?></strong></p>
                <?php while ( have_rows( 'product_composition_blend' ) ) { the_row( 'product_composition_blend' ); ?>
                    <table style="width:100%;color:#2b3147;"> 
                        <?php if ( get_sub_field( 'product_name' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Product name:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'product_name' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'cas_number' ) ) { ?>
                            <tr>
                                <td><?php _e( 'CAS number:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'cas_number' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'chemical_name' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Chemical name:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'chemical_name' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'moleculair_formula' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Moleculair formula:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'moleculair_formula' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'molecular_weight_gmol' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Molecular weight (g/mol):', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'molecular_weight_gmol' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'product_percentage_of_the_blend' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Product percentage of the blend:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'product_percentage_of_the_blend' ); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>
            <?php } ?>
        <?php } else if ( $type === 'NO BLEND' ) { ?>
            <?php if ( have_rows( 'product_composition_single_component' ) ) { ?>
                <p style="color:#2b3147;"><strong><?php _e( 'Product Composition', 'partinchem' ); ?></strong></p>
                <?php while ( have_rows( 'product_composition_single_component' ) ) { the_row( 'product_composition_single_component' ); ?>
                    <table style="width:100%;color:#2b3147;">                        
                        <?php if ( get_sub_field( 'cas_number' ) ) { ?>
                            <tr>
                                <td><?php _e( 'CAS number:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'cas_number' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'chemical_name' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Chemical name:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'chemical_name' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'moleculair_formula' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Moleculair formula:', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'moleculair_formula' ); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ( get_sub_field( 'molecular_weight_gmol' ) ) { ?>
                            <tr>
                                <td><?php _e( 'Molecular weight (g/mol):', 'partinchem' ); ?></td>
                                <td><?php the_sub_field( 'molecular_weight_gmol' ); ?></td>
                            </tr>
                        <?php } ?>                                                                   
                    </table>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <br>
    <?php $datasheet = get_field( 'datasheet_availability' ); ?>
    <?php if ( $datasheet !== 'NO' ) { ?>
        <p style="color:#2b3147;"><strong><?php _e( 'Product Specification', 'partinchem' ); ?></strong></p>
        <table style="color:#2b3147;"> 
            <?php if ( have_rows( 'product_specifications_&_certifcate_of_analysis' ) ) { while ( have_rows( 'product_specifications_&_certifcate_of_analysis' ) ) { ?> <?php the_row(); ?>
                <tr>
                    <?php $test = get_sub_field('test'); ?>
                    <td><?php echo $test->name ?></td>
                    <td><?php the_sub_field('product_specification'); ?></td>
                </tr>
            <?php } } ?>
            <tr>
                <?php                                                                 
                $forms = get_the_terms( $post, 'product-form' );    
                $form_names = [];
                foreach ( $forms as $form ) {
                    array_push( $form_names, $form->name );
                }                                          
                ?>
                <td>Product form(s):</td>
                <td><?php echo implode( ', ', $form_names ); ?></td>
            </tr>
            <tr>
                <?php                                                                 
                $packaging = get_the_terms( $post, 'packaging' );    
                $packaging_names = [];
                foreach ( $packaging as $package ) {
                    array_push( $packaging_names, $package->name );
                }                                          
                ?>
                <td>Packaging option(s)</td>
                <td><?php echo implode( ', ', $packaging_names ); ?></td>
            </tr>
        </table>
    <?php } ?>
    <?php if ( have_rows( 'tabs_repeater' ) ) { 
        while ( have_rows( 'tabs_repeater' ) ) { the_row( 'tabs_repeater' ); ?>
            <?php 
            $count++;
            $internal = get_sub_field( 'internal' ); 

            if ( !$internal ) { ?>
                <br>
                <p style="color:#2b3147;"><strong><?php the_sub_field( 'title' ); ?></strong></p>
                <?php the_sub_field( 'text' ); ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>