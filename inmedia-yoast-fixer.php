<?php
/**
 * Plugin Name: INMEDIA Yoast Fixer
 * URI: https://inmedia-design.com/
 * Description: Fixes QTranslateX(T) integration for Yoast 14.3 upwards
 * Version: 1.0.0
 * Author: INMEDIA Design
 * Author URI: https://inmedia-design.com/
 */

if ( !function_exists('imd_wpseo_frontend_presentation') ) {

	function imd_wpseo_frontend_presentation( $presentation, $context ) {

		global $post;

		// FIX TITLES..
		$presentation->title = wpseo_replace_vars(get_post_meta($post->ID, '_yoast_wpseo_title', true), []);
		$presentation->open_graph_title = $presentation->title;

		// FIX DESCRIPTIONS..
		$presentation->meta_description = wpseo_replace_vars(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true), []);
		$presentation->open_graph_description = $presentation->meta_description;

		// FIX URLS..
		if ( function_exists('qtranxf_convertURL') ) {
			$presentation->canonical = qtranxf_convertURL( '', qtranxf_getLanguage() );
			$presentation->open_graph_url = qtranxf_convertURL( '', qtranxf_getLanguage() );
		}

		return $presentation;
	}
	add_filter( 'wpseo_frontend_presentation', 'imd_wpseo_frontend_presentation', 10, 2 );

	// DEBUG SCHEMA..
	// add_filter( 'yoast_seo_development_mode', '__return_true' );
}
