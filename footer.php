<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<footer>
        <div class="container">
            <div class="row">
                 <!--item-->
                 <div class="item item-logo">
                    <div class="item-content">
                        
                    <?php if ( get_the_logo() ) { ?>
                        <div class="logo">
                            <a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                                <picture>
                                    <img width="165" height="36" alt="Partinchem logo" src="<?php the_logo(); ?>" title="Logo">
                                </picture>
                            </a>
				        </div>
                    <?php } ?>
                    <?php 
                    $phone = get_field( 'contact_phone', 'options' ); 
                    $email = get_field( 'contact_email', 'options' ); 
                    ?>
                    <div class="contact-info">
                        <?php if ( $phone ) { ?>
                            <a href="tel:<?php echo $phone; ?>" title="Call"><?php echo $phone; ?></a>
                        <?php } ?>
                        <?php if ( $email ) { ?>
                            <a href="mailto:<?php echo $email; ?>" title="Email"><?php echo $email; ?></a>
                        <?php } ?>
                    </div>
                    <?php if ( is_active_sidebar( 'sidebar-social' ) ) { ?>
							<?php dynamic_sidebar( 'sidebar-social' ); ?>
					<?php } ?>
                </div>

                </div>
                <!--item-->
                <div class="item">
                    <div class="item-content">
                        <h4 class="item-title size4">Most sold</h4>

                        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-products') ); ?>

                        <!-- <ul>
                            <li><a href="">All Products</a></li>
                            <li><a href="">Omnistab</a></li>
                            <li><a href="">Silicone</a></li>
                            <li><a href="">Propylene</a></li>
                        </ul> -->
                    </div>
                    <?php if ( is_front_page() ) { ?> 
                        <a href="#stock" title="Our Stock" class="button stock__button stock__button--footer">Our Stock</a>
                    <?php } else { ?>
                        <a href="<?php echo home_url( '#stock' ); ?>" title="Our Stock" class="button stock__button stock__button--footer">Our Stock</a>
                    <?php } ?>
                    <a href="https://www.partinchem.com/products/" title="Our products" class="button button--ghost">Our products</a>
                </div>
                <!--item-->
                <div class="item">
                    <div class="item-content">
                        <h4 class="item-title size4">Contact</h4>
                        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-contacts') ); ?>
                    </div>
                    <a href="https://www.partinchem.com/contact/" title="Contact us" class="button button--ghost">Contact us</a>
                </div>
                <!--item-->
                <div class="item">
                    <div class="item-content">
                        <h4 class="item-title size4">Company</h4>

                        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-company') ); ?>

                        <!-- <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Research & Development</a></li>
                            <li><a href="">Terms and Conditions</a></li>
                            <li><a href="">Privacy Policy</a></li>
                        </ul> -->
                    </div>
                    <a href="https://www.partinchem.com/why-us/" title="About us" class="button button--ghost">About us</a>
                </div>
                <!--item-->
                <!-- <div class="item">
                    <div class="item-content">
                        <h4 class="item-title size4">Resources</h4>

                        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-resources') ); ?> -->

                        <!-- <ul>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Frequently Asked Questions</a></li>
                            <li><a href="">Support</a></li>
                        </ul> -->
                    <!-- </div>
                </div> -->
            </div>
            <div class="row">
                <div class="copy">
                    ©<?php echo date("Y"); ?> Partners in Chemicals
                </div>
            </div>
        </div>
    </footer>

    <!--Scripts-->
    <!-- <script src="<?php echo get_template_directory_uri()?>/js/simpleCart.js"></script> -->
    
    <?php if ( !is_front_page() ) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
        <script>
            /***** Max height *****/
            $('.product-title').matchHeight();
            $('.blog-box .blog-box-content div').matchHeight();
        </script>
    <?php } ?>
    <?php if ( is_singular( array( 'products' ) ) ) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.min.js'></script> 
        <script src="https://cdn.jsdelivr.net/npm/html-to-pdfmake/docs/browser.js"></script> 
        <script>
            jQuery(document).ready(function($){
                $('#pdf-button-reach').click(function () { 
                    event.preventDefault();
                    var content = document.querySelector('#pdf-reach');
                    var html = htmlToPdfmake(content.innerHTML);
                    var title = document.querySelector('.hero__title').innerHTML;

                    var pdf = {
                        content: [
                            html
                        ],
                        styles: {
                            header: {
                                fontSize: 18,
                                bold: true
                            },
                            subheader: {
                                fontSize: 15,
                                bold: true
                            },
                        }
                    }
                    pdfMake.createPdf(pdf).download(`REACH ${title}.pdf`);
                });

                $('#pdf-button-data-sheet').click(function () { 
                    event.preventDefault();
                    var content = document.querySelector('#pdf-data-sheet');
                    var html = htmlToPdfmake(content.innerHTML);
                    var title = document.querySelector('.hero__title').innerHTML;

                    var pdf = {
                        content: [
                            html
                        ],
                        styles: {
                            header: {
                                fontSize: 18,
                                bold: true
                            },
                            subheader: {
                                fontSize: 15,
                                bold: true
                            },
                        }
                    }
                    pdfMake.createPdf(pdf).download(`Product Data Sheet ${title}.pdf`);
                });

                //you can now use $ as your jQuery object.
                var body = $( 'body' );

                /***** Gif Loader  *****/
                var doc1 = new jsPDF('p', 'pt','a4',true);
                var doc2 = new jsPDF('p', 'pt','a4',true);
                var doc3 = new jsPDF('p', 'pt','a4',true);
                var specialElementHandlers = {
                    '#eee': function (element, renderer) {
                        return true;
                    }
                };

                $('#cmd').click(function () {   
                    doc1.fromHTML($('#pdf').get(0), 10, 10, {
                    'width':500,
                    'elementHandlers': specialElementHandlers
                    }, function (dispose) {
                        var pdfName1 = $('.product-info .col-left .item_name').text() + '.pdf';
                        doc1.save(pdfName1);
                    });
                });

                $('#cmd-metal').click(function () {   
                    doc2.fromHTML($('#pdf-metal').get(0), 10, 10, {
                    'width':500,
                    'elementHandlers': specialElementHandlers
                    }, function (dispose) {
                        var pdfName2 = $('.product-info .col-left .item_name').text() + '.pdf';
                        doc2.save(pdfName2);
                    });
                });
            });
        </script>

    <?php } ?>

    <?php wp_footer(); ?>

</body>

</html>
