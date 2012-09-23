<?php

/****************************************************

Register post relationships for Posts 2 Posts plugin 

****************************************************/


function my_connection_types() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;


	// p2p_register_connection_type( array( 
	// 	'name' => 'charts_to_publications',
	// 	'from' => 'chart',
	// 	'to' => array( 'test', 'publication', 'blog', 'multimedia', 'event', 'press' ),
	// 	'sortable' => 'to',
	// 	// 'reciprocal' => true,
	// 	// 'title' => 'Connected Publication/Charts'
	// 	'title' => array( 'from' => 'Add to publication', 'to' => 'Connected charts' )
	// ) );

	p2p_register_connection_type( array( 
		'name' => 'related_content',
		'from' => 'tax',
		'to' => array( 'page' ),
		'sortable' => 'to',
		'reciprocal' => true,
		// 'title' => 'Connected Publication/Charts'
		'title' => array( 'from' => 'Related content', 'to' => 'Related content' )
	) );

	// p2p_register_connection_type( array( 
	// 	'name' => 'press_to_publications',
	// 	'from' => 'press',
	// 	'to' => array( 'test', 'publication', 'blog', 'multimedia', 'event' ),
	// 	'reciprocal' => true,
	// 	// 'title' => 'Connected Press Release/Publication'
	// 	'title' => array( 'from' => 'Connected publications', 'to' => 'Connected press releases' )
	// ) );

	// p2p_register_connection_type( array( 
	// 	'name' => 'clips_to_publications',
	// 	'from' => 'clip',
	// 	array( 'test', 'publication', 'blog', 'multimedia', 'event', 'press' ),
	// 	// 'reciprocal' => true,
	// 	// 'title' => 'Connected Press Release/Publication'
	// 	'title' => array( 'from' => 'Connected publications', 'to' => 'Connected "EPI in the News" clips' )
	// ) );

}


add_action( 'wp_loaded', 'my_connection_types' );



