<?php
/**
 * Template:			cta.php
 * Description:			The CTA template
 *
 */

$cta_title = get_field( 'cta_title', 'options' );
$cta_whatsapp = get_field( 'cta_whatsapp', 'options' );
$cta_wechat = get_field( 'cta_wechat', 'options' );							
$cta_form = get_field( 'cta_form', 'options' );		
$cta_employees = get_field( 'cta_employee', 'options' );
$cta_random = $cta_employees[ array_rand( $cta_employees ) ];				

?>

<div class="cta">
    <div class="cta__header">
        <figure class="cta__avatar">
            <img src="<?php echo $cta_random[ 'photo' ][ 'url' ]; ?>" alt="<?php echo $cta_random[ 'photo' ][ 'alt' ]; ?>">
        </figure>
        <div class="cta__title">
            <h3><?php echo $cta_title; ?></h3>
            <p><?php echo $cta_random[ 'name' ]; ?></p>
        </div>
    </div>
    <?php if ( is_array( $cta_whatsapp ) ) { ?>
        <a href="<?php echo $cta_whatsapp[ 'url' ]; ?>" target="<?php echo $cta_whatsapp[ 'target' ]; ?>" title="<?php echo $cta_whatsapp[ 'title' ]; ?>" class="cta__link">
            <div class="cta__message">
                <figure class="cta__icon">	
                    <img src="<?php echo get_template_directory_uri(); ?>/img/whatsapp.svg" alt="WhatsApp">									
                </figure>
                <p><?php echo $cta_whatsapp[ 'title' ]; ?></p>
            </div>
            <svg width="7" height="11" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path fill="#2B3147" d="M-304-212H56v697h-360z"/><g stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M2.222 1.444L5.778 5M5.778 5L2.222 8.555"/></g></g></svg>
        </a>
    <?php } ?>
    <?php if ( is_array( $cta_wechat ) ) { ?>
        <a href="<?php echo $cta_wechat[ 'url' ]; ?>" target="<?php echo $cta_wechat[ 'target' ]; ?>" title="<?php echo $cta_wechat[ 'title' ]; ?>" class="cta__link">
            <div class="cta__message">
                <figure class="cta__icon">	
                    <img src="<?php echo get_template_directory_uri(); ?>/img/wechat.svg" alt="WeChat">									
                </figure>
                <p><?php echo $cta_wechat[ 'title' ]; ?></p>
            </div>
            <svg width="7" height="11" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path fill="#2B3147" d="M-304-212H56v697h-360z"/><g stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M2.222 1.444L5.778 5M5.778 5L2.222 8.555"/></g></g></svg>
        </a>
    <?php } ?>	
    <?php if ( $cta_form ) { ?>
        <div class="cta__form">
            <?php echo do_shortcode('[gravityform id=' . $cta_form . ' title=true description=false ajax=false]'); ?>
        </div>								
    <?php } ?>
</div>