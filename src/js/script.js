/* jshint esversion: 6 */

/**
 * @author Control <info@controldigital.nl>
 * @file script.js
 * @version 1.0
 * @license
 * Copyright (c) 2020 Control.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
 
import $ from "jquery";

// Import modules.
import { initAccordion } from './modules/initAccordion';
import { initFilter } from './modules/initFilter';
import { initSelectActions } from './modules/initSelectactions';
// import '../../js/simpleCart.js';
import { initAnchorScroll } from './modules/initAnchorScroll';
import { initModal } from './modules/initModal';
import { initFormValidation } from './modules/initFormValidation';

// Main thread
(function () {
	'use strict';

	// Use modules
	initSelectActions();
	initAnchorScroll();
    initModal();
    initFilter(); 
    initFormValidation();
    
    // Wacht tot de pagina volledig is geladen
    window.addEventListener('DOMContentLoaded', function() {
        // Check of de body de class 'home' heeft
        if (document.body.classList.contains('home')) {
            // Selecteer de header met de class 'header'
            var header = document.querySelector('.header');
    
            // Voeg een event listener toe voor het scrollen van de pagina
            window.addEventListener('scroll', function() {
                // Check of de scroll positie bovenaan de pagina is
                if (window.pageYOffset === 0) {
                    // Voeg de 'is_transparent' class toe als de pagina bovenaan is
                    header.classList.add('is_transparent');
                } else {
                    // Verwijder de 'is_transparent' class als er gescrolled is
                    header.classList.remove('is_transparent');
                }
            });
        }
    });
    
	window.addEventListener('load', () => {
        initAccordion();
    })

    // YOAST FAQ
    const yoastFAQ = document.querySelector('.wp-block-yoast-faq-block');

    if (yoastFAQ) {
        yoastFAQ.classList.add('fcp-faq');

        const yoastFAQQuestions = yoastFAQ.querySelectorAll('.schema-faq-question');

        [...yoastFAQQuestions].forEach(question => {
            question.addEventListener('click', ()=> {
                question.parentElement.classList.toggle('fcp-opened');
            });
        }); 
    }

}());

$(document).ready(function($){

    var body = $( 'body' );
   

    /***** Product descriptions *****/
    // $('.product-desc').ellipsis({
    //     type: 'lines',
    //     count: 5
    //   });

    // var $p = $('.product-desc p');
    // var divh = $('.product-desc').height();
    // while ($p.outerHeight() > divh) {
    //     $p.text(function (index, text) {
    //         return text.replace(/\W*\s(\S)*$/, '...');
    //     });
    // }



    /***** Search *****/
    // $('.product-content').append('<p id="noSearch01" class="noresult">No results found</p>');

    $(function(){
        $('#searchInput').keyup(function(){

            //Products
            // $("#noSearch01").hide();
            // $('.product-form').hide();
            $('.product-content .item').removeClass('show');
            $('#products-cta').removeClass('is-visible');
            $('#products-category-description').hide();
        
            var val = $(this).val().toLowerCase();
            $(".product-content .item").hide();

            $(".product-content .js-search-item").each(function(){
                var text = $(this).find('.product-title').text().toLowerCase();
                    if(text.indexOf(val) != -1)
                    {  
                        $(this).addClass('show');   
                        $(this).show();  
                    }
            });

            if($('#searchInput').val() == ''){
                $(".product-content .item").show();
                $(".product-content .item--hidden").hide();
                $('#products-cta').removeClass('is-visible');
                // $('.product-form').hide();
            }
        
            // console.log($(".product-content .item.show").length);
            
            if($(".product-content .item.show").length == 0){
                $('#products-cta').addClass('is-visible');
                // $("#noSearch01").show();
                // $('.product-form').show();
            }

            // //Products Filter
            // $("#noSearch02").hide();
            // $('.product-search .item-category').removeClass('show');
            
            // var val02 = $(this).val().toLowerCase();

            // $(".product-search .item-category").hide();
            // $(".product-search .item-category ul li").hide();

            // $(".product-search .item-category").each(function(){
            //     var text02 = $(this).find('.product-title').text().toLowerCase();
            //         if(text02.indexOf(val02) != -1)
            //         {   
            //             $(this).addClass('show');
            //             $(this).show();   
            //             $(this).find('li').show();  
            //         }
            // });

            // if($(".product-search .item-category.show").length == 0){
            //     $("#noSearch02").show(); 
            // }
        });
    });

    /***** Button All Posts *****/
    $('#buttonAll').click(function () {
        $('.blog-box').removeClass('blog-box-hidden');
        $('.button-all').remove();
    });

    /***** Modal Close *****/
    $('.modal-close').click(function () {
        $.fancybox.close();
    });


    /***** Dropdown *****/
    $('#ajax-container').on('click', '.dropdown-default', function(){ 
        $(this).parent().toggleClass('open');
        $(this).parent().find('li a').click(function () {
            $(this).parent().parent().parent().removeClass('open');
        });
        return false;
    });
      
    $('body').click(function () {
        $('.dropdown').removeClass('open');
    });

    if($(".product-slider .item").length){
    }else{
        $("#titleRelated").remove();
    }


    /***** Simple Cart *****/
    
    // simpleCart.bind( 'beforeAdd' , function( item ){
    //     // return false if the item is in the cart, 
    //     // so it won't be added again
    //     // return !simpleCart.has( item );
    //     if(simpleCart.has( item )){
    //         return !simpleCart.has( item );
    //     }

    //     simpleCart({
    //         cartColumns: [
    //             {
    //                 attr: "name",
    //                 label: false
    //             },
    //                 {
    //                 view: "remove",
    //                 text: "<span class='icon icon-cancel'></span>",
    //                 label: false
    //             }
    //             ]
    //         });
        
    //         simpleCart.currency({
    //             symbol: "",
    //             delimiter: " ",
    //             decimal: ".",
    //             after: true,
    //             accuracy: 0
    //         });
    //   });

    // simpleCart({
    // cartColumns: [
    //     {
    //         attr: "name",
    //         label: false
    //     },
    //         {
    //         view: "remove",
    //         text: "<span class='icon icon-cancel'></span>",
    //         label: false
    //     }
    //     ]
    // });

    // simpleCart.currency({
    //     symbol: "",
    //     delimiter: " ",
    //     decimal: ".",
    //     after: true,
    //     accuracy: 0
    // });


    // simpleCart.bind('update', function () {
        
    //     $('.product-list').addClass('load-content');
    //     $('.loader').fadeIn();
    //     setTimeout(function () {
    //         $('.loader').fadeOut();
    //     }, 500); 

    //     setTimeout(function () {
    //         $('.product-list').removeClass('load-content');
    //     }, 800);

    //     if ($(".product-count").text() == "0") {
    //         $('.product-list .text').fadeIn();
    //         $('.page-product-list').addClass('empty');
    //     }
    //     else{
    //         $('.product-list .text').fadeOut();
    //         $('.page-product-list').removeClass('empty');
    //     }

    //     var newarr = new Array();
    //     arr = $('.simpleCart_items .itemRow');
    //     for (i = 0; i < arr.length; i++) {
    //         $name = $(arr).eq(i).find(".item-name").text();
    //         $order = i+1 + '-' + $name+' ';
    //         newarr.push($order);
    //     }

    //     $(".hidden").val(newarr);
    // });

    // simpleCart.bind( 'beforeAdd' , function( item ){
    //     // return false if the item is in the cart, 
    //     // so it won't be added again
    //     return !simpleCart.has( item );
    //   });

   

    /***** Navigation *****/
    $('#navigationButton').click(function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(".header__navigation").addClass('is-open');
        } else {
            $(".header__navigation").removeClass('is-open');
        }
        return false;
    });

    /***** Search *****/
    $('#searchButton').click(function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(".search-panel").slideToggle().addClass('in');
            $(".search-panel .input-search").focus();
        } else {
            $(".search-panel").slideToggle().removeClass('in');
        }
        return false;
    });
    
    /***** Fancybox *****/
    $('.fancybox').fancybox();

    $('.product-modal .button-cart').click(function () {
        $.fancybox.close();
    });

    $("#ajax-container").on("focusin", function(){
        $("a.fancybox").fancybox({
         'padding': 0
        });
    });
    
    /***** Product slider *****/
    $('.product-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        prevArrow: '<span class="slide-nav slide-prev icon-left-arrow"></span>',
        nextArrow: '<span class="slide-nav slide-next icon-right-arrow"></span>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

     /***** Product slider *****/
     $('.related-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        rows: 0,
        prevArrow: $('.btn_prev'),
        nextArrow: $('.btn_next'),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    /***** Sidebar filter *****/
    $('.sidebar-link').click(function () {
        $(this).parent().toggleClass("sidebar-list--open");
    });

    // $('.sidebar-button-clear').click(function () {
    //     $('.sidebar-list ul li input').removeClass("active");
	// });
	
	// TODO: check active inputs on page load? 
	var $form = $('#products-filter');

	if ($form) {
		localStorage.clear();
	}

	/***** Gif Loader  *****/
	$('.loader').fadeIn();
	setTimeout(function () { 
		$('.loader').fadeOut();
	}, 500); 

	setTimeout(function () {
		$('#ajax-container').removeClass('load-content');
	}, 800);

	setTimeout(function () {
		$('.product-list').removeClass('load-content');
	}, 800);


	/***** Filter Category Tags Delete *****/
	$('#ajax-container').on('click', '.icon-cancel', function(e){

		e.preventDefault();
		var revId = $(this).attr('data-category');
		var $checkbox = $('#checkbox'+revId);

		// console.log(selectId);

		updateSidebar($checkbox);
		var $form = $('#products-filter');
		var query = $form.serialize();

		getProducts(query);

	});

	/***** Keep submenu open if parent item is checked on refresh *****/
	$(window).on('load', function(){
		$( ".page-products--alt input.parent-checkbox.active" ).each(function( index ) {
			var sublistId = ('#sublist' + this.value);
			$(sublistId).addClass('show');
		});
	});

	function getProducts(query) {
		$('#ajax-container').addClass('load-content');
		$('#products-cta').removeClass('is-visible');
		$('.loader').fadeIn();

		$.ajax({
			type: "POST",
			url: window.wp_data.ajax_url + '?action=get_products',
			data: query,
			success: function (data) {
			localStorage.removeItem("content9");
			$('#ajax-container').html(data);
			localStorage.setItem("content9", data);   
			$('.fancybox').fancybox();
			if(data.indexOf("ajaxnoresultsfound") > -1) {
				setTimeout(function () {
				$('#products-cta').addClass('is-visible');
				$('#products-category-description').hide();
				}, 0);
			}
			},  
			complete: function() {
				$('.loader').fadeOut();
				setTimeout(function () {
					$('#ajax-container').removeClass('load-content');
					$('#products-cta').removeClass('load-content');
				}, 0);
			}
		});
	}

	var urlParams = location.search.substring(1).split('&'),
	params = {};

	urlParams.forEach(function(el){
		var tmpArr = el.split('=');
		params[tmpArr[0]] = tmpArr[1];
	});

	var parentId = params['product-group-1'];
	var termId = params['product-group-2'];

	if (parentId && termId) {
		getProducts('products_tax[]=' + parentId + '&products_tax[]=' + termId);
		var $target = $('#checkbox' + [parentId]);
		var $target2 = $('#checkbox' + [termId]);
		updateSidebar($target);
		updateSidebar($target2);
	} else if (parentId) {
		getProducts('products_tax[]=' + parentId);
		var $target = $('#checkbox' + [parentId]);
		updateSidebar($target);
	}

	$('#products-filter').on('change', function(event) {

		var $target = $(event.target);
		var $form = $(this);

		if (!$target.is('input[type="checkbox"]')) {
			return;
		}

		updateSidebar($target);

		var query = $form.serialize();
		getProducts(query);
	});

	function updateSidebar($target) {
		var targetValue = $target.val();
		var $sublist = $('#sublist' + targetValue);
		var $checkbox = $('#checkbox' + targetValue);

		if ($sublist.length) {
			if ($sublist.hasClass('show')) {
				$sublist.removeClass('show');
			} else {
				$sublist.addClass('show');
			}
		} else {
			$checkbox.parent().parent().addClass('show');
		}

		if ($target.hasClass('active')) {
			$target.removeClass('active').prop('checked', false); 
			$sublist.find('input.active').each(function(i, e){
				$(e).removeClass('active').prop('checked', false);
			});
		} else {
			$target.addClass('active');
		};
	}

	/***** Save Localstorage *****/ 

	if(localStorage.getItem("content9") !== null){
		$('#ajax-container').html(localStorage.getItem("content9"));
	}

	$('.button-category .icon').each(function() {
		var actId = $(this).attr('data-category');
		var checkId = "#checkbox"+actId;
		$(checkId).addClass('active');  
	});

	$('#menu-footer-products a').on('click', function(e){
		localStorage.removeItem("content9");
	});

	$('.product-content--alt').on('click', '#buttonClear', function(){
		localStorage.clear();
	});

	$('.page-item-3688 a').on('click', function(e){
		localStorage.clear();
	});



	/***** Fill Stock Gravityform dynamically *****/ 
	const stockField = document.querySelector('.gfield--stock');

	if (stockField) {
		let stockValue = stockField.querySelector('input');
		const stockInputs = document.querySelectorAll('.stock__checkbox'); 
		let activeStockInputs = [];

		if (stockInputs) {
			for (var i = 0; i < stockInputs.length; i++) {
				stockInputs[i].addEventListener("change", updateStock);
			}
		}

		function updateStock(event) {
			if ( event.target.checked) {
				activeStockInputs.push(this.value);
			} else {
				activeStockInputs.pop(this.value);
			}
			stockValue.value = activeStockInputs.join(", ");
		}
	}

});






