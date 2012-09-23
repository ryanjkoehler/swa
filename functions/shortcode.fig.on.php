<?php

/****************************************************
	EPI Widget shortcodes
****************************************************/

function epi_FiguresTablesCharts_shortcode ( $atts, $content=null ) { 
	extract( shortcode_atts( array(
		'label' => null,
 		'url' => null,
 		'style' => null
  	), $atts ) );
	
	
	$view = $_GET["view"]; 
	
	// Check if there is a URL present
	// (We can't use if (strpos( $url, 'http' )) because it returns 0, which evaluates to false)
	if (  $url && strpos( $url, 'ttp' )  ) {
	
		if ( $view == "print" ) { 
			$figure = '<img src="' . $url . '" alt="' . $label . '">';
		} elseif ( get_post_type() == 'blog'  ) {
			$figure = '<img src="http://www.epi.org/m/?src=' . $url . '&w=536" alt="' . $label . '">';
		} elseif ( get_post_type() != 'blog' ) {
			$figure = '<img src="http://www.epi.org/m/?src=' . $url . '&w=608" alt="' . $label . '">';
		} else {
			$figure = null;
		}
	} else {
		$figure = null;
	}

	// ob_start();
	// return ob_get_clean();
	
	return $figure;
}

add_shortcode( 'fig', 'epi_FiguresTablesCharts_shortcode' );

