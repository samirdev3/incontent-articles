<?php
/**
 * Auto placement using percentage method
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if(! function_exists('incontent_articles_prefix_insert') ){
    add_filter( 'the_content', 'incontent_articles_prefix_insert' );
    function incontent_articles_prefix_insert( $content ) {
        
        if ( is_single() && ! is_admin() ) {
            
            $total_paragraphs = substr_count($content,"</p>");
            $percent = 50; // percentage
            $element = incontent_articles_code(3, '','Latest'); //num,category,title
            return incontent_articles_prefix_insert_after_paragraph( $element, $content, $total_paragraphs, $percent);
            
        }
        
        return $content;
    }
}

if(! function_exists('incontent_articles_prefix_insert_after_paragraph') ){
    function incontent_articles_prefix_insert_after_paragraph( $element, $content, $total_paragraphs, $percent ) {

        if(empty($content)){
            return $content;
        }

        $closing_p = '</p>';
        $paragraphs = explode( $closing_p, $content );
        $box_place = round(($total_paragraphs * $percent)/100);

        foreach ($paragraphs as $index => $paragraph) {
            $count_one = $index + 1;

            if ( trim( $paragraph ) ) {
                $paragraphs[$index] .= $closing_p;
            }

            if ( $count_one == $box_place ) {
                $paragraphs[$index] .= $element;
            }
        }
        return implode( '', $paragraphs );
    }
}

?>