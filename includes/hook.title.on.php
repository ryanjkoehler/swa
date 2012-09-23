<?php 



/**
 * Remove extra lines and spaces from a post on save
 *
 * @todo Enable per-post override by custom field
 * @since 2012-09-01 15:30:33
 */



add_filter( 'the_title', 'hey_chart_title_filter', 0 );
add_filter( 'the_title_attribute', 'hey_chart_title_filter', 0 );
add_filter( 'wp_title', 'hey_chart_title_filter', 10 );

// I think this prepends "Chart:" to chart post titles in the front end
function hey_chart_title_filter( $title ) {
	if(!is_admin()) {
	    global $id, $post;
		// We have to check for ID, or else this filter will affect menu items too
		// http://wordpress.stackexchange.com/questions/26115/how-to-correctly-get-post-type-in-a-the-title-filter
	    if ( $id && $post && $post->post_type == 'chart' ) {
			$titlebits = explode(' | ', $title);

			$post->epi_original_title = $title;

			$title = array_pop($titlebits);
			$label = array_pop($titlebits);
			$number = array_pop(explode(' ', $label));

			global $epiglobal;
			$post->epi_chart_label = $label;
			$post->epi_chart_number = $number;
			$post->epi_chart_title = $title;

			if ($number)
				$epiglobal[$id]['image'] = 'http://www.epi.org/files/swa/'. $number .'.png';
			

			return $title;
		}	

		// if (get_post_type() !== 'chart')
			// return $title;

		// if (function_exists('get_epi_chart'))
			// return 'bla';
		// return $post->title;
		// return get_epi_chart('title');
	}
        
    return $title;
}
