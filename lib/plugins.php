<?php
/**
 * Template:			plugins.php
 * Description:			plugins options and settings
 */

/** ACF */

/**
 * Add options and sub options pages to theme
 * 
 * Here we can add fields that are 
 * globally available throughout the theme.
 * 
 * @since	1.0
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	// Main options page
	$parent = acf_add_options_page( array(
		'page_title' 	=> 'Theme settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	) );

}

/**
 * acf_register_google_maps_api_key
 * 
 * Google Maps API key
 * Adds Google Map functionality to ACF
 * 
 * Change the $google_maps_api_key value to
 * the API Key generated by Google
 * 
 * @since	1.0
 */
add_action( 'acf/init', 'acf_register_google_maps_api_key' );
function acf_register_google_maps_api_key() {

	// Google maps API Key
	$google_maps_api_key = '';

	// Update setting
	acf_update_setting( 'google_api_key', $google_maps_api_key );
}

/** GRAVITY FORMS */

/**
 * custom_gf_gfield_content
 * 
 * Customize the output per gfield.
 * Returns a string with the new HTML.
 * 
 * @since	1.0
 * @link	https://docs.gravityforms.com/gform_field_content/
 * 
 * @param	string $field_content
 * @param	Field_Object $field
 * @param	string $value
 * @param	integer $entry_id
 * @param	integer $form_id
 * @return	string
 */
// add_filter( 'gform_field_content', 'custom_gf_gfield_content', 10, 5 );
function custom_gf_gfield_content( $field_content, $field, $value, $entry_id, $form_id ) {
	if ( is_admin() ) return $field_content;
	return $field_content;
}

/**
 * custom_gf_submit_button
 * 
 * Modify the output of the submit button.
 * Returns a string with the new HTML.
 *
 * @since	1.0
 * @link	https://docs.gravityforms.com/gform_submit_button/
 * 
 * @param 	string $button The old button
 * @param 	object $form The form
 * @return	string The new button
 */

// add_filter( 'gform_submit_button', 'custom_gf_submit_button', 10, 2 );
function custom_gf_submit_button( $button, $form ) {
	return '<button type="submit" class="button gform_button" id="gform_submit_button_' . $form[ 'id' ] . '>' . $form[ 'button' ][ 'text' ] . '</button>';
}

/**
 * Load all the GF scripts of a form in the footer
 * 
 * @since	1.0
 * @link	https://docs.gravityforms.com/gform_init_scripts_footer/
 */
add_filter( 'gform_init_scripts_footer', '__return_true' );

/**
 * enqueue_gform_scripts
 * 
 * Enqueues script that are needed for gforms.
 * This gives us the control to load in scripts 
 * only when GForms is used on the page.
 * 
 * @since	1.0
 * @link	https://docs.gravityforms.com/gform_enqueue_scripts/
 * 
 * @param	GF_Form $form
 * @param	boolean $is_ajax
 */
add_action( 'gform_enqueue_scripts', 'enqueue_gform_scripts', 10, 2 );
function enqueue_gform_scripts( $form, $is_ajax ) {
	wp_enqueue_script( 'jquery' );
}

/** WOOCOMMERCE */

/**
 * Get Woocommerce excerpt
 *
 * @param 	number $limit
 * @return	string
 */
function woo_get_excerpt( $limit = 20 ) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
	return $excerpt;
}

/**
 * Echo Woocommerce excerpt
 *
 * @param 	number $limit
 */
function woo_the_excerpt( $limit = 20 ) {
	$excerpt = woo_get_excerpt( $limit );
	if ($excerpt) echo $excerpt;
}

/**
 * Get Woocommerce content
 *
 * @param 	number $limit
 * @return	string
 */
function woo_get_content( $limit = 20 ) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

/**
 * Echo Woocommerce content
 *
 * @param 	number $limit
 */
function woo_the_content( $limit = 20 ) {
	$content = woo_get_content( $limit );
	if ($content) echo $content;
}

/** WPML */

// Prevent WPML from enqueueing CSS an JS files.
define( 'ICL_DONT_LOAD_NAVIGATION_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );

// If WPML is not active
if ( ! function_exists( 'icl_get_languages' ) ) return;

/**
 * the_wpml_lang_switcher
 * 
 * Outputs the a custom WPML language switcher
 * that shows a list of available languages.
 * 
 * @param	string $args The icl_get_languages parameters
 */
// function the_wpml_lang_switcher( $args = 'skip_missing=1' ) {
// 	$langs = icl_get_languages( $args );
// 	if ( ! empty( $langs ) ) {
// 		$current_lang = '';
// 		$other_langs = '';
// 		foreach( $langs as $lang ) {
// 			if ( $lang[ 'active' ] == '1' ) {
// 				$current_lang .= '<span>' . $lang[ 'language_code' ] . '</span>';
// 			} else {
// 				$other_langs .= '<li><a href="' . $lang[ 'url'] . '" title="' . $lang[ 'native_name'] . '">' . $lang[ 'language_code'] . '</a></li>';
// 			}
// 		}
// 		echo '<div class="wpml-language-switcher lang js-lang-switcher">' . $current_lang . '<ul>' . $other_langs . '</ul></div>';
// 		return true;
// 	}
// 	return false;
// }

/**
 * the_wpml_lang_toggle
 * 
 * Outputs a custom WPML toggle that displays
 * the language that is not currently active.
 * 
 * NOTE: Only works with 2 languages
 * 
 * @param	string $args The icl_get_languages parameters
 */
// function the_wpml_lang_toggle( $args = 'skip_missing=0' ) {
// 	$langs = icl_get_languages( $args );
//     if ( ! empty( $langs ) && count( $langs ) < 2 ) {
// 	    foreach ( $langs as $lang ) {
// 		    if ( $lang[ 'active' ] == '0' ) {
// 				echo '<div class="wpml-language-toggle lang js-lang-toggle"><a href="' . $lang[ 'url' ] . '" title="' . $lang[ 'native_name' ] . '">' . $lang[ 'language_code' ] . '</a></div';
// 				return $lang;
// 		    }
// 	    }
// 	}
// 	return false;
// }