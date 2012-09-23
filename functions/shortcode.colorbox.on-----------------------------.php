<?php

/****************************************************
	For ColorBox display of PDFs 
****************************************************/

//Eric: Asked on http://www.wpquestions.com/question/show/id/2656

# class SCColorbox
class SCColorbox extends ShortCodeScriptLoader {
	function __construct() {
		add_action('wp_print_styles', array($this, 'add_script'));
	}

	function handle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'width' => '864px',
			'height' => '90%',
			'opacity' => '.5',
			'iframe' => '',
		), $atts ) );

		if ($iframe == 'true') {
		$html  = '<script>jQuery(document).ready(function($){$(".colorbox_trigger a").colorbox({width:"'.$width.'", height:"'.$height.'", iframe:true, opacity:"'.$opacity.'"});});</script>';
		$html .= '<div class="colorbox_trigger">'. $content .'</div>';
		} else {
		$html  = '<script>jQuery(document).ready(function($){$(".colorbox_trigger").colorbox({width:"'.$width.'", height:"'.$height.'"});});</script>';
		$html .= $content;
		}
		return $html;
	}

	function add_script() {
		wp_register_script( 'my-jquery-colorbox', get_template_directory_uri().'/jquery.colorbox-min.js', array('jquery'), '1.3.17' );
		wp_enqueue_script('my-jquery-colorbox');
		wp_register_style( 'my-jquery-colorbox-css', get_template_directory_uri().'/css-colorbox-5.css', '', '1.3.17', 'screen, projection' );
		wp_enqueue_style('my-jquery-colorbox-css');
	}    
}

$scc = new SCColorbox();
$scc->register('epi_colorbox');
