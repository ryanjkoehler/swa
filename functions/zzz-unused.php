<?php 

class myTaxMeta
{
	public $v1 = 'hello';
	
	function __construct($id) {
		$this->id = $id;            
	}
	


   // valid property declarations:
   
 //  public $v2 = $post->ID;




}


// Don't know if this works; was commented out, as of 2011-10-12

// 
// 
// function hey_taxonomy_meta( $taxonomy, $field ) {
// 	$taxonomy = '';
// 	$pt = '';
// 	
// 	$taxonomy_posttype = array (
// 	// What post type is associated with each taxonomy
// 	// 'taxonomy_name' => 'post_type'
// 		'people' => 'bio',
// 		'topic' => 'issue',
// 		'issue' => 'issue',
// 		'type' => '',
// 
// 		);
// 		
// 	$pt = $taxonomy_posttype[$taxonomy]; // Get the associated post_type
// 	$terms = wp_get_object_terms(get_the_id(), $taxonomy);
// 	
// 	foreach ($terms as $term) {
// 		$objects = get_objects_in_term($term->term_id, $taxonomy);
// 		$the_query = new WP_Query( array(
// 			'post__in' => $objects,
// 			'post_type' => $pt,
// 			'posts_per_page' => '1',				
// 		) );
// 			while ( $the_query->have_posts() ) : $the_query->the_post();
// 			$photo = '';
// 			$photo = get_post_meta(get_the_id(), 'post_image', true);
// 	}
// 	
// }

