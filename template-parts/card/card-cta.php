<?php
/**
 * Template:			card-cta.php
 * Description:			CTA card template
 */

global $delay;
$delay += 0.125;
$cta_title = get_field( 'cta_title', 'options' );
$cta_whatsapp = get_field( 'cta_whatsapp', 'options' );
$cta_wechat = get_field( 'cta_wechat', 'options' );							
$cta_employees = get_field( 'cta_employee', 'options' );
$cta_form = get_field( 'cta_form', 'options' );		
$cta_random = $cta_employees[ array_rand( $cta_employees ) ];	
?>

<article class="card card--cta fadeInUp" style="animation-delay: <?php echo $delay; ?>s">
    <div class="card__inner">
        <div class="card__body">
            <picture class="card__avatar">
                <img src="<?php echo $cta_random[ 'photo' ][ 'url' ]; ?>" alt="<?php echo $cta_random[ 'photo' ][ 'alt' ]; ?>">
            </picture>
            <h4 class="card__heading"><?php echo $cta_title; ?></h4>
            <div class="card__contact">
                <?php if ( is_array( $cta_whatsapp ) ) { ?>
                    <a href="<?php echo $cta_whatsapp[ 'url' ]; ?>" target="<?php echo $cta_whatsapp[ 'target' ]; ?>" title="<?php echo $cta_whatsapp[ 'title' ]; ?>">
                        <div class="card__contact-icon">	
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>								
                        </div>
                        <p>Whatsapp: <?php echo $cta_whatsapp[ 'title' ]; ?></p>                    
                    </a>
                <?php } ?>
                <?php if ( is_array( $cta_wechat ) ) { ?>
                    <a href="<?php echo $cta_wechat[ 'url' ]; ?>" target="<?php echo $cta_wechat[ 'target' ]; ?>" title="<?php echo $cta_wechat[ 'title' ]; ?>">            
                        <div class="card__contact-icon">	
                            <i class="fab fa-weixin" aria-hidden="true"></i>									
                        </div>
                        <p>Wechat: <?php echo $cta_wechat[ 'title' ]; ?></p>        
                    </a>
                <?php } ?>	
                <?php if ( $cta_form ) { ?>
                    <a href="#" class="button button--alternate button--small js-open-modal"><?php _e( 'Send us a request', 'partinchem' ); ?></a>						
                <?php } ?>  
            </div>
        </div>
    </a>
</article>	