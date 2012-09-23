<?php



/*****************************************
Here's where we make the [showchart] shortcode that converts 
[showchart oldid="28"] into a chart with Excel and Chart page
links on Feature pages.
*****************************************/



function epi_showchart( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'oldid' => '',
      ), $atts ) );

if ( $oldid ) {	

$query = new WP_Query( array( 'meta_key' => '_old_id', 'meta_value' => $oldid ) );
if ( $query->have_posts() ) {
	$image = get_post_meta($query->posts[0]->ID, 'Chart_URL', true);
	$cropped = get_post_meta($query->posts[0]->ID, 'Chart_Cropped_URL', true);
	$excel = get_post_meta($query->posts[0]->ID, 'Excel_URL', true);
	$title = $query->posts[0]->post_title;
	$link = get_permalink( $query->posts[0]->ID );
	
    return '<div align="right"><div class="download-share"><span class="downloads"><ul><li><a href="' . $excel . '">Excel data</a> | <a href="' . $link . '">Go to  chart</a></li></ul></span></div><div class="chart"><img src="/m/?src=' . $image . '&w=640" /></div></div>';

} else {
return '';
}


}

}
add_shortcode("showchart", "epi_showchart");  




/**************  END  ********************/

