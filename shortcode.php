<?php
/**
 * Manual placement using shortcode method
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if(! function_exists('incontent_articles_shortcode') ){
	add_shortcode( 'incontent_articles', 'incontent_articles_shortcode' );
	function incontent_articles_shortcode( $atts ) {
		if(!is_admin() & is_single()){
            return incontent_articles_code(3, '','Latest'); //num,category,title
		}
	}
}
?>