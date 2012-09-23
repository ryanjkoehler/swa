<?php 

/****************************************************
Linked title getter
Get the linked title of a page or taxonomy term based on the slug 
****************************************************/

function epi_linked_sc ( $atts, $content = null ) { 
	$defaults = array(
		"pagetitle" => null,
		"page" => null,
		"term" => null,
		"text" => null,
		"style" => null,
		"field" => null,
	);

	// Add public taxonomies as accepted shortcode attributes
	$taxonomies = get_taxonomies(array("public"=>true), 'names');
	foreach ($taxonomies as $key => $value) {
		$defaults[$key] = null;
	}

	// Extract shortcode attributes into variables
	extract( shortcode_atts( $defaults, $atts ) ); 

	// Check if the shortcode requests a taxonomy term
	foreach ($taxonomies as $taxonomy) {
		if ( $$taxonomy ) {
			$taxonomyAtt = array(
				'taxonomy' => $taxonomy,
				'term' => $$taxonomy,
			);
		}
	}	


	if ($page) {


		$byTitle = get_page_by_title( $page );
		$bySlug  = get_page_by_path( strtolower($page) );
		$byID = intval( $page ) ? get_post(intval( $page )) : null;

		// @todo we should also check if the post type is public
		if ( $byID && $byID->post_status != 'publish' )
			$byID = null;

		if ( $byID )
			$target = $byID;
		if ( $byTitle )
			$target = $byTitle;
		if ( $bySlug )
			$target = $bySlug;




		// Set up query args
		$args = array();
		$args['post_type'] = $acceptedPostTypes;
		$args['posts_per_page'] = 1;
		$args['titlesearch'] = $page; // @todo only do this if searching by title
		$args['titlesearch_exact'] = $page; // @todo only do this if searching by title
		
		// Add taxonomy specs
		foreach ($taxonomies as $taxonomy) {
			if ( $$taxonomy ) {
				$args[$taxonomy] = $$taxonomy;
			}
		}

		$the_query = new WP_Query($args);
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$target = get_the_id();
			$url = $field ? get_post_meta(get_the_id(), $field, true) : null;
		endwhile;


		if ( $target ) {
			$url = $url ? $url : get_permalink( $target );
			$text = $text ? $text : get_the_title( $target->ID );

			// $text.= ' ' . $target->ID;
		}


	} elseif ( $taxonomyAtt ) {

		$taxonomy = $taxonomyAtt['taxonomy'];
		$term = $taxonomyAtt['term'];

		$byTitle = get_term_by( 'name', $term, $taxonomy );
		$bySlug = get_term_by( 'slug', $term, $taxonomy );
		$byID = intval( $term ) && $term == intval( $term ) ? get_term(intval( $term ), $taxonomy) : null;

		if ( $byTitle )
			$target = $byTitle;
		if ( $bySlug )
			$target = $bySlug;
		if ( $byID )
			$target = $byID;

		if ( $target ) {
			$url = get_term_link( $target );
			$text = $text ? $text : $target->name;
		}
	}


	if ( ! $url ) return;

	return '<a href="'. $url .'">'. $text .'</a>';

}

add_shortcode( 'linked', 'epi_linked_sc' );
add_shortcode( 'safelink', 'epi_linked_sc' );
add_shortcode( 'smartlink', 'epi_linked_sc' );



