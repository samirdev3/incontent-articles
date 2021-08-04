<?php
/*
   Plugin Name: In-Content Articles
   Plugin URI: https://github.com/samirdev3
   description: This plugin helps to insert latest, related or category articles in-between content automatically OR by using shortcode.
   Version: 1.0.1
   Author: Samir
   Author URI: https://github.com/samirdev3
   License: GPL2+
*/
if ( ! defined( 'ABSPATH' ) ) exit;

/** main function */
if(! function_exists('incontent_articles_code') ){
    function incontent_articles_code($number,$category,$heading){
        if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
            return;
        }
        
		ob_start();
        if(empty($category) || $category === 'latest'){
            $category = '';
        }elseif($category === 'related'){
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                $category = $categories[0]->term_id;   
            }
        }
        $args = array(
            'cat'                 => $category,
            'posts_per_page'      => $number,
            'post_status'         => 'publish',
            'post_type'           => 'post',
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => true,
            'orderby'             => 'ID',
            'order'               => 'DESC'
        );
        $the_query = new WP_Query( $args );
        
        if ( $the_query->have_posts() ) {
            /** files */
            include 'css.php';
            echo '<div id="incontent-articles"><div class="_title">'.$heading.'</div><ul>';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                echo '<li><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
            }
            echo '</ul></div>';
        } else {
            // no posts found
        }
        wp_reset_postdata(); /* Restore original Post Data */
		return ob_get_clean();
    }
}

/** required */
//include 'shortcode.php';
include 'auto.php';