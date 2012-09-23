<?php

//Eric: Asked on http://www.wpquestions.com/question/show/id/2656
// 
// class SCColorbox extends ShortCodeScriptLoader {
// 	function handle_shortcode( $atts, $content = null ) {
// 		extract( shortcode_atts( array(
// 			'width' => '300px',
// 			'height' => '300px',
// 		), $atts ) );
// 		
// 		$html = '<script>jQuery(".colorbox_trigger").colorbox({width:'.$width.', height:'.$height.', iframe:false, transition:elastic});</script>';
// 		
// 		// I can add some conditonals here for if it's an iFrame.
// 		
// 		$html .= '<div class="shortcodecontent">' . $content . '</div>';
// 		return $html;
// 	}
// 
// 
// // Why did the path not work when I included bloginfo("template_url") ?
// 	function add_script() {
// 		wp_register_script( 'my-jquery-colorbox', '/wp-content/themes/epi-boilerplate/jquery.colorbox-min.js', array('jquery'), '1.3.17' );
// 		wp_print_scripts('my-jquery-colorbox');
// 		wp_register_style( 'my-jquery-colorbox-css', '/wp-content/themes/epi-boilerplate/css-colorbox-5.css', '', '1.3.17', 'screen, projection' );
// 		wp_print_styles('my-jquery-colorbox-css');
// 	}    
// }
// 
// $scc = new SCColorbox();
// $scc->register('epi_colorbox');
// 
// # class SCColorbox
// class SCColorbox extends ShortCodeScriptLoader {
// 	function __construct() {
// 		add_action('wp_print_styles', array($this, 'add_script'));
// 	}
// 
// 	function handle_shortcode( $atts, $content = null ) {
// 		extract( shortcode_atts( array(
// 			'width' => 300,
// 			'height' => 300,
// 		), $atts ) );
// 		
// //		$html  = '<script>jQuery(".colorbox_trigger").colorbox({width:'.$width.', height:'.$height.', inline:true, href:"#inline_example1"});</script>';
// 		$html = '<script>jQuery(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});</script>';
// //		$html  = '<script>jQuery(".shortcodecontent").colorbox({width:'.$width.', height:'.$height.', iframe:true, transition:"elastic"});</script>';
// 		$html .= $content;
// 		return $html;
// 	}
// 
// 	function add_script() {
// 		wp_register_script( 'my-jquery-colorbox', get_template_directory_uri().'/jquery.colorbox-min.js', array('jquery'), '1.3.17' );
// 		wp_enqueue_script('my-jquery-colorbox');
// 		wp_register_style( 'my-jquery-colorbox-css', get_template_directory_uri().'/css-colorbox-5.css', '', '1.3.17', 'screen, projection' );
// 		wp_enqueue_style('my-jquery-colorbox-css');
// 	}    
// }
// 
// $scc = new SCColorbox();
// $scc->register('epi_colorbox');
// 



# Requires abstract class ShortCodeLoader
require_once( 'scloader.php' );

# class SCColorbox
class SCColorbox extends ShortCodeScriptLoader {
	function __construct() {
		add_action('wp_print_styles', array($this, 'add_script'));
	}

	function handle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'width' => 300,
			'height' => 300,
		), $atts ) );
		
		$html  = '<script>jQuery(".colorbox_trigger").colorbox({width:'.$width.', height:'.$height.', iframe:true, transition:"elastic"});</script>';
		$html .= $content;
		return $html;
	}

	function add_script() {
		wp_register_script( 'my-jquery-colorbox', get_template_directory_uri().'/colorbox/jquery.colorbox-min.js', array('jquery'), '1.3.17' );
		wp_enqueue_script('my-jquery-colorbox');
		wp_register_style( 'my-jquery-colorbox-css', get_template_directory_uri().'/colorbox/colorbox.css', '', '1.3.17', 'screen, projection' );
		wp_enqueue_style('my-jquery-colorbox-css');
	}    
}

$scc = new SCColorbox();
$scc->register('sccolorbox');




