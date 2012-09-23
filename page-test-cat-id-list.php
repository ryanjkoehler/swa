<?php
/**
* Description of Template goes here
*
Template Name: Category-ID-Thing
*/

?>
<?php 
$args = array(
	'post_type'      => post,
	'order'    => 'ASC'
);
query_posts( $args );

// The Loop
while ( have_posts() ) : the_post();
	echo $post->ID . ', ' . get_post_meta($post->ID, 'Old ID', true) . '<br>';
endwhile;












// Reset Query
wp_reset_query();

?>
