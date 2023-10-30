<?php
/**		    
 * Template:			modal.php
 * Description:			Default modal template
 */

$cta_form = get_field( 'cta_form', 'options' );		
?>

<div role="dialog" aria-label="<?php _e( 'Modal', 'control' ); ?>" aria-modal="true" id="modal" class="modal modal--default js-modal">
	<div class="modal__container">
		<button class="modal__close js-modal-close" title="<?php _e( 'Close modal', 'control' ); ?>">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
		<div class="modal__content js-modal-content">
            <?php if ( $cta_form ) { ?>
                <div class="modal__form">
                    <h3><?php _e( 'Send us a request' ); ?></h3>
                    <?php echo do_shortcode('[gravityform id=' . $cta_form . ' title=false description=false ajax=true]'); ?>
                </div>
            <?php } ?>
		</div>
	</div>
</div>

