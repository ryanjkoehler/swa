<?php
/*
Plugin Name: WP Table of Contents
Plugin URI: http://rastider.com/wordpress-table-of-contents-plugin
Description: WP Table of Contents plugin creates a "table of contents" of your post.
Version: 1.1
Author: Ahmet Kaya
Author URI: http://rastider.com/
*/

/******************SETTINGS*****************/
// If you don't know how to customize options, check this page http://rastider.com/wordpress-table-of-contents-plugin



$wp_toc["show_hide"] = 1;

/* END OF THE SETTINGS */


if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('Bu sayfayý görüntüleme yetkiniz yok.'); }
$output = '';

function wp_toc_id_ekle( $content ) {
	if ( is_single() ) {
		return preg_replace (
			"/(<h[2-6])([^>]*>)(.*?)(<\/h[2-6]>)/e", 
			"'\\1 id=\"'.wp_duzenle('\\3').'\"'.stripslashes('\\2').''.stripslashes('\\3').'\\4'", 
			$content
		);
	} else {
		return $content;
	}
}

function wp_duzenle ( $content ) {
	return sanitize_title_with_dashes($content);
}

function wp_table_of_contents() {
	global $output;
	wp_toc_ ( get_the_content(), 2 );
	if ( $output != '' ) {
		$output = "
			<div class=\"wp_table_of_contents\" id=\"wp_toc\">
			<strong>Contents</strong> [<a class=\"goster_gizle\" onMouseOver=\"style.cursor='pointer'\" title=\"Show contents &amp; hide\"><small>show/hide</small></a>]
			<div class=\"wp_toc_icerik\">$output</div></div>
		";
	}
	echo $output;
}

function wp_toc_icerik ( $content, $tag ) {
	$bicem = '/<'.$tag.'.*>(.*)<\/'.$tag.'>/Us';
	return preg_split ( $bicem, $content );
}

function wp_toc_bol( $content, $tag ) {
	if(substr_count($content, $tag)<1) return false; 
	$bicem = '/<'.$tag.'.*>(.*)<\/'.$tag.'>/Us';
	preg_match_all($bicem, $content, $cikti);
	return $cikti;
}

function wp_toc_( $content, $i ) {
	global $output;
	$x = 1;
	$tag = 'h'.$i;
	$icerik = 'h'.$i.'_icerik';	
	$y = $i + 1;
	$sonraki_tag = 'h'.$y;
	$sonraki_icerik = 'h'.$y.'_icerik';
	if ( $wp_toc[$tag] = wp_toc_bol( $content, $tag ) ) {
		$output .= '<ol>';
		foreach ( $wp_toc[$tag]["1"] as $baslik ) {
			$output .= "<li><a href=\"#".wp_duzenle($baslik);
			$baslik = htmlentities(trim(strip_tags($baslik)), ENT_QUOTES, "UTF-8");
			$output .= "\" title=\"$baslik\"><small>$baslik</small></a>\n";
			$wp_toc[$icerik] = wp_toc_icerik($content, $tag);
			wp_toc_($wp_toc[$icerik][$x], $y);
			$output .= '</li>';
			$x++;
		}
		$output .= '</ol>';
	}
}
?>
<script type="text/javascript">
$(document).ready(function(){
<?php if( $wp_toc["show_hide"] == 0 ) : ?>
$(".wp_toc_icerik").hide();
<?php endif; ?>
$(".goster_gizle").show();
$('.goster_gizle').click(function(){
$(".wp_toc_icerik").slideToggle();
});
});
</script>
<style type="text/css"> 
	.wp_table_of_contents { background-color: #f1f2f3; border: 1px solid #ccc; padding: 5px; overflow: auto; float: left; margin: 0 5px 5px 0; }
	.wp_table_of_contents ol { padding: 0 10px; margin-bottom: 2px; }
	.wp_table_of_contents li { margin-bottom: 0px; }
	.wp_toc_icerik { padding: 0 5px; }
</style>
<?php
}



add_filter('the_content', 'wp_toc_id_ekle');


?>