<?php
/*
Plugin Name: &#9733; EPI Master Plugin &#9733;
Plugin URI: 
Description: Contains all the special functionality for EPI's site.
Version: 0.1
Author: Eric Shansby
Author URI: 
License:
*/

// require dirname( __FILE__ ) . '/types-and-taxonomies.php';
// require dirname( __FILE__ ) . '/epi-post-type-quickedit.php';
// require dirname( __FILE__ ) . '/ShortCodeScriptLoader.php';
// require dirname( __FILE__ ) . '/epi-shortcodes.php';

// require dirname( __FILE__ ) . '/epi-calculator.php';
// requiring calculator made it appear at the top of the page
// require dirname( __FILE__ ) . '/epi-post-type-quickedit.php';


/****************************************************
	Include all script in js-admin.php in the <head>
	by adding it to the wp_head hook
****************************************************/

function add_js_head() {
	$file = dirname( __FILE__ ) . '/wp_head.php';
	include($file);
	// if (file_exists($file)) {echo 'the file does exist';} 
	// elseif (!file_exists($file)) {echo 'the file does not exist';}
}
add_action('wp_head', 'add_js_head');

function add_js_footer() {
	$file = dirname( __FILE__ ) . '/wp_footer.php';
	include($file);
	// if (file_exists($file)) {echo 'the file does exist';} 
	// elseif (!file_exists($file)) {echo 'the file does not exist';}
}
add_action('wp_footer', 'add_js_footer');




/*****************************************
******************************************
******************************************

__FILE__ is a PHP constant.

plugin_dir_path( __FILE__ );

Server path of the plugin directory with a trailing slash

******************************************
******************************************
*****************************************/

// $here = plugins_url( '' , __FILE__ );




/****************************************************
	Add filter to split headlines into Titles/Subtitles
****************************************************/

if(!is_admin()) {

add_filter( 'the_title', 'epi_split_titles' );

function epi_split_titles($title) {
	$delimiter = ": ";
	$splittable = strpos($title, $delimiter);
	
	if (!$splittable) {
		return $title; 
	} else {
		$pieces = explode($delimiter, $title);
		if (count($pieces) == 2) {
			$title = $pieces[0] . '<span class="colon">' . $delimiter . '</span><span class="subtitle">' .  $pieces[1] . '</span>';
			return $title;
		} elseif (count($pieces) == 3){
			$title = $pieces[0] . $delimiter . $pieces[1] . '<span class="colon">' . $delimiter . '</span><span class="subtitle">' .  $pieces[2] . '</span>';
			return $title;
		}
	}
}
}





// add_filter( 'the_title', 'epi_press_titles' );

function epi_press_titles($title) {

	if (get_post_type() == 'press') {
		if(!is_admin()) {
			$title = '<span class="pretitle-press">News from EPI:</span> ' . $title;
			return $title;
		} else {
			$title = 'News from EPI: ' . $title;
			return $title;
		}
	}
}

add_filter( 'the_title', 'add_cpt_prefix' );

function add_cpt_prefix( $title ) {
	
    	global $id, $post;
    	if ( $id && $post && $post->post_type == 'press' ) {
			
			if (!is_admin() ) { 
        		$title = '<span class="pretitle-press">News from EPI<span class="press-colon"> ›</span></span> ' . $title;
    		} else {
					$title = 'News from EPI: ' . $title;
			}
    	
	} 
	return $title;
}




/****************************************************
	Custom Menu shortcode (from Stephanie Leary)
	http://sillybean.net/2010/07/call-a-navigation-menu-using-a-shortcode/
	[menu name="menu-slug"]
****************************************************/

function print_menu_shortcode($atts, $content = null) {
	extract(shortcode_atts(array( 'name' => null ), $atts));
	return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
	}
add_shortcode('menu', 'print_menu_shortcode');





/****************************************************
	EPI Widget shortcodes
****************************************************/

function epi_widget_shortcode ( $atts ) { 
	extract( shortcode_atts( array(
 		'widget' => '',
 		'style' => ''
  	), $atts ) );

	ob_start();
	if ($widget == 'signup') { ?>	
	<form action="http://secure.epi.org/page/s/quick" method="post" id="quick_signup">
	    <div>
	      <label for="email" class="hidden">Email: </label>
				<input class="text-input" type="text" value="Email" name="email" id="email"/>
	      <label for="zip" class="hidden">Zip: </label>
				<input class="text-input2" type="text" value="Zip" name="zip" id="zip"/>
	      <input type="submit" value="Go" class="button" id="signupbutton" />
	    </div>
	  </form>
	<?php }
	elseif ($widget == 'blogsearch') { ?>
		<form role="search" method="get" id="blog-searchform" class="searchform" action="/blog" >
			<div><label class="screen-reader-text visuallyhidden" for="s">Search for:</label>
				<input type="text" value="" name="s" id="s" />
				<input type="hidden" name="view" value="blog" />
				<input type="submit" id="searchsubmit" value="Go" />
			</div>
		</form>	
<?php }
elseif ($widget == 'search') { ?>
	<form role="search" method="get" id="searchform" action="/" >
		<div><label class="screen-reader-text visuallyhidden" for="s">Search for:</label>
			<input type="text" value="" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="Search" />
		</div>
	</form>	
	<?php }
	elseif ($widget == 'advancedsearch') { ?>
	<?php }
	elseif ($widget == 'calculator') { ?>
		
	<?php include dirname( __FILE__ ) . '/epi-calculator.php'; ?>
		
	<?php }
	elseif ($widget == 'other') { ?>
	<?php }
	elseif ($widget == 'other') { ?>
		
	<?php }
	return ob_get_clean();
}

add_shortcode( 'epi', 'epi_widget_shortcode' );




function epi_events_shortcode( $atts ) { 
	extract( shortcode_atts( array(
 		'widget' => '',
 		'style' => ''
  	), $atts ) );

	ob_start(); ?>
	<?php //  $upcoming = do_shortcode('[postlist query="posts_per_page=3&type=other&post_status=future" style="events"]'); 
			
//			$upcoming = new WP_Query( array(
//				'type' => array('other','events'),
//				'posts_per_page' => 3
//				'meta_key'=>'Event Date',  'orderby' => 'meta_value_num', 'order' => DESC
//			) );
			
			$upcoming = do_shortcode('[postlist query="posts_per_page=3&post_type=event&orderby=date&order=asc&type=&post_status=" style="events" filter="future"]'); 
	
	if ($upcoming) { echo $upcoming; } else { ?>
		<?php if (is_page('events')) { ?>
		<h3 class="notice">There are no events scheduled at this time.</h3>
		<?php } ?>
			<p><span>Sign up to be notified of our next event.</span></p>
		<?php echo do_shortcode('[epi widget="signup"]'); ?>
		
		
	<?php }
	
	?>
	
	<?php
//	return do_shortcode(ob_get_clean()); //allows nesting of shortcodes
	return ob_get_clean(); //allows nesting of shortcodes
}

add_shortcode( 'epi_events', 'epi_events_shortcode');


/****************************************************
EPI Link shortcode
[link {taxonomyname}="term"]
[link {taxonomyname}="term"]
****************************************************/

function epi_link_shortode( $atts, $content = null ) {

//list taxonomies

$args='';
$output='objects';

$taxonomies = get_taxonomies( $args, $output );

foreach ($taxonomies as $taxonomy) {
//	$tax_atts[] = $taxonomy->name => '';
}

	extract( shortcode_atts( array(
 		'type' => '',
 		'heading' => '',
 		'div' => '',
 		'style' => '',
 		'number' => '6'
  	), $atts ) ); 

// get taxonomy link by slug
// or, if issue, get issue (issue page) by slug

$bla = '<a href="#"></a>';

return $open . ob_get_clean() . $close; //do_shortcode() would allow nesting of shortcodes
}


add_shortcode( 'link', 'epi_link_shortode');





function epi_single_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
 		'type' => '',
 		'heading' => '',
 		'div' => '',
 		'style' => '',
 		'number' => '6'
  	), $atts ) );


if ($div) { $class = $div; }
else { $class = 'epiwidget-not';}

$open = '<div class="' . $class .'">';

$close = '</div>';

	ob_start(); ?>
<?php if( $type == 'Snapshot' ) : ?>


	<?php if(is_front_page()) { ?>
	<h2>Snapshot</h2><?php } ?>
	<?php 
	$issue = hey_terms_array('issue');
	$the_query = new WP_Query( 'post_type=&type=economic-snapshots&posts_per_page=1&issue=' . $issue );
		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<!-- <p class="date"><?php echo get_the_date(); ?></p> -->
			<a href="<?php the_permalink(); ?>">
				<img src="/m/?src=<?php echo hey_getmyimage(); ?>&w=268" alt="<?php the_title_attribute(); ?>">
			</a>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			
			<?php if (!is_front_page()): ?>
				<?php // the_excerpt(); ?>
			<?php endif ?>
				<?php endwhile; wp_reset_postdata(); ?>


<?php elseif( $type == 'Quick Take' ) : ?>

	<h2><?php echo $heading; ?></h2>
	<?php 
	$issue = hey_terms_array('issue');
	$the_query = new WP_Query( 'post_type=&type=quick-takes&posts_per_page=1&issue=' . $issue );
		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php the_content(); ?>
				<p class="authors qt">— <?php echo hey_terms( 'people' ); ?><br>
				<span class="date"><?php echo get_the_date(); ?> <?php echo get_the_time(); ?></span></p>
				<?php endwhile; wp_reset_postdata(); ?>


<?php elseif( $type == 'Video' ) : ?>
<?php $id = get_the_ID(); ?>
<?php if ($video = get_post_meta($id, "Video URL", true)) { ?>
	<?php if($heading) { ?>
	<h2><?php echo $heading; ?></h2><?php } ?>
	<?php echo do_shortcode( '[pro-player width="268" height="220"]' . $video . '[/pro-player]' ); ?>
<?php } ?>

<?php elseif( $type == 'Clips' ) : ?>
	<?php $query = do_shortcode('[postlist query="posts_per_page='. $number .'&type=&post_type=clip&s='. hey_terms_array('issue') .'" style="clips"]');
	
	 	if ($query) { ?>
		
	<?php if ($heading) { ?>
		<h2><?php echo $heading; ?></h2>
	<?php } //if ($heading) ?>
	<?php echo $query;
		} else { $open = ''; $close = ''; } // if ($query)
 	endif;  ?>

<?php 
return $open . ob_get_clean() . $close; //do_shortcode() would allow nesting of shortcodes
}


add_shortcode( 'epi_single', 'epi_single_shortcode');









/****************************************************
	shortcode for displaying Feature Box
****************************************************/


function epi_feature_shortcode( $atts ) {
	$before = '';
	$after = '';
  	extract( shortcode_atts( array(
 		'query' => '',
 		'style' => ''
  	), $atts ) );

//		$query = wp_parse_args( $query, $defaults );
ob_start();	?>

		<?php
		
		if (!is_front_page()) :
		
//			$the_query = new WP_Query( array( 'post_id'=>3179, 'post_type'=>'any', 'posts_per_page'=>'1' ));

			// $featured = hey_field('Featured in box');
			// if ($featured) {
			// $the_query = new WP_Query("post_type=any&posts_per_page=1&p=$featured" );
			// } else {
//			$the_query = new WP_Query('post_type=feature&posts_per_page=1&topic=' . hey_terms_array('issue') );
			// }
			
			$the_query = new WP_Query('post_type=feature&posts_per_page=1&internal=issue-page-feature&issue=' . hey_terms_array('issue') );

			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<div class="featurebox clearfix">
				<img src="/m/?src=<?php echo hey_getmyimage(); ?>&w=360&h=280" width="360" height="280" class="featureimage left" alt="<?php the_title_attribute(); ?>">
				<div class="featuretext">
				<?php if ($showdate): ?>
					<p class="date"><?php echo get_the_date(); ?></p>
				<?php endif ?>
				<?php if($is_a_standalone_feature) { ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php } elseif ($main_link = hey_field('main_link')) { ?>
					<h2><a href="<?php echo $main_link; ?>"><?php the_title(); ?></a></h2>				
				<?php } else { ?>
					<h2><?php the_title(); ?></h2>	
				<?php } ?>
					
					<?php the_content(); ?>
					<?php edit_post_link('<span class="admin-only">Edit</span>'); ?>
				</div><!-- .featuretext -->	
				</div><!-- .featurebox -->	

				<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
		
<?php

	$return = $before . ob_get_clean() . $after;
	return $return;
	
}

add_shortcode( 'epi_feature', 'epi_feature_shortcode' );





function hey_authors() {
	$id = get_the_ID();
	ob_start();
	if (is_object_in_term($id,'people')) {
	count(get_terms( $id, 'people')) < 3 ? $and = ' and ' : $and = ', '; ?>
<p class="authors">By <?php the_terms( $post->ID, 'people', '', $and, ' ' ) ?></p>
<?php }
	
	$r = ob_get_clean();
	return $r;
}



function hey_terms( $taxonomy, $style = 'and', $linked = 'links', $property = 'name'){
//	global $wp_query;
//	$id = $wp_query->post->ID;
// This gets the terms of the main page so it doesn't work in other loops outside of the main loop, like in sidebars...
	$id = get_the_ID();	
	$terms = wp_get_object_terms( $id, $taxonomy );
	
	foreach( $terms as $term ) {
		if ($linked == 'links') {
			
				if ($taxonomy != 'issue') {
			$term_array[] = '<a href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->$property . '</a>';
				} elseif ($taxonomy == 'issue' && $term->parent == 0 && $term->slug != 'other') {
					$term_array[] = '<a href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->$property . '</a>';
				}
	
		} else { 
			$term_array[] = $term->$property;
		}
	}
	
if ($term_array) {

	if ($style == 'and' && count($term_array) > 1 ) {
		$connector = ', ';
		$and = ' and ';
		$last_term = array_pop($term_array);
		return implode( $connector, $term_array ) . $and . $last_term ;
	} else {
		return implode( $style, $term_array );
	}
}
} //////// END of function hey_terms() /////////





function hey_terms_array ( $taxonomy , $glue = ',' , $property = 'slug' ){

	$id = get_the_ID();	
	$terms = wp_get_object_terms( $id, $taxonomy );

	if($terms) {
	foreach( $terms as $term ) {
		$term_array[] = $term->$property;
		}

	return implode( $glue, $term_array );
	}

} //////// END of function hey_terms_array() /////////





function hey_is_first( $n = '1' ) {
	if ($the_query->current_post < $n ) { return true; } else {return false; }
} //////// END of function hey_is_first() /////////





function hey_getmyimage() {
	$id = get_the_ID();
	if (get_post_meta( $id, 'teaser_image', true)) {
	return get_post_meta( $id, 'teaser_image', true);
	}
	elseif (get_post_meta( $id, 'Teaser Image URL', true)) {
	return get_post_meta( $id, 'Teaser Image URL', true);
	}
	elseif (get_post_meta( $id, 'Teaser Image', true)) {
		$image = get_post_meta( $id, 'Teaser Image', true);
		if (strlen($image) > 6) { return $image; }
	elseif ($image = get_post_meta( $id, 'post_image', true)) {
		return $image;
	}
//	else { return wp_get_attachment_url( get_post_meta( $image, 'Teaser Image', true) ); }
//		return get_post_meta( $id, 'Teaser Image', true);
	} else {
	return 'http://w3.epi-data.org/temp2011/epi-default00.png';
	}
}





function hey_author_photo() {

	$terms[] = wp_get_object_terms( get_the_id(), 'people', $args );

	$slug = $terms[0][0]->slug;
	
	$photo = '';
	
	$the_query = new WP_Query( "posts_per_page=1&post_type=bio&name=$slug" );
	while ( $the_query->have_posts() ) : $the_query->the_post();
	
		$photo = get_post_meta( get_the_id(), 'post_image', true);
	endwhile;
	wp_reset_query();
	
	return get_the_id() . $photo;
}








/****************************************************
	Get top-most parent of a taxonomy term
****************************************************/


// determine the topmost parent of a term
function get_term_top_most_parent($term_id, $taxonomy){

	// start from the current term
    $parent  = get_term_by( 'id', $term_id, $taxonomy);

	// climb up the hierarchy until we reach a term with parent = '0'
    while ($parent->parent != '0'){

		$term_id = $parent->parent;
		
        $parent  = get_term_by( 'id', $term_id, $taxonomy);

    }

    return $parent;

}



// so once you have this function you can just loop over the results returned by wp_get_object_terms
function hey_top_parents($taxonomy, $results = 1) {

	// get terms for current post
	$terms = wp_get_object_terms( get_the_ID(), $taxonomy );

	// set vars
	$top_parent_terms = array();

	foreach ( $terms as $term ) {

		//get top level parent
		$top_parent = get_term_top_most_parent( $term->term_id, $taxonomy );

		//check if you have it in your array to only add it once
		if ( !in_array( $top_parent, $top_parent_terms ) ) {

			$top_parent_terms[] = $top_parent;

		}

	}

	// build output (the HTML is up to you)
	
	$count = 0; 	// before our foreach loop we set the count to zero
					//	We'll stop the loop once the count reaches $results
	
	if ( $top_parent_terms ) {
		
		$r = '<span class="loop-' . $taxonomy . '">';

		foreach ( $top_parent_terms as $term ) {

			$r .= ' <a href="' . get_term_link( $term->slug, $taxonomy ) . '">' . $term->name . '</a>';

			$count++; //Increase the value of the count by 1
			if($count==$results) break; //Break the loop is count is equal to the max_loop

		} // end foreach
	
		$r .= '</span>';
		
	}

	return $r;
	
}





/****************************************************
	END: top-most parent of a taxonomy term
****************************************************/





function hey_getmyfield( $field ) {
	
	if (get_post_meta( get_the_ID(), $field, true)){
	return get_post_meta( get_the_ID(), $field, true);
	} else
	return;
}

function hey_field( $field ) {
	
	if (get_post_meta( get_the_ID(), $field, true)){
	return get_post_meta( get_the_ID(), $field, true);
	} else
	return;
}


function hey_author_link() {

	$terms = wp_get_object_terms( get_the_ID(), 'people' );

	if ($terms) {
		return get_term_link($terms[0]->slug, 'people');
	} else {
		return '#';
	}
}




if( !is_admin()){
   // wp_deregister_script('jquery'); 
   // wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"), false, '1.6.1'); 
   // wp_enqueue_script('jquery');
}


$fyi = get_stylesheet_directory_uri() ; //that's the URL to the template folder, fyi





/****************************************************
Register post relationships for Posts 2 Posts plugin 
--- doesn't work when outside of functions.php - maybe it's loading too soon
****************************************************/

// add_action('init','p2p_bla');

// function p2p_bla() {
// if (function_exists('p2p_register_connection_type')) {
// p2p_register_connection_type( array(
//         'from' => 'publication',
//         'to' => 'page',
//         'fields' => array(
// //                'role' => 'Role',
// //                'role_type' => 'Role Type'
//         ),
//         'context' => 'advanced',
//         'prevent_duplicates' => false,
//         'reciprocal' => true,

//         'title' => array(
//                 'from' => 'Featured on Issue Page',
//                 'to' => 'Featured in feature box'
//         )
// ) );
// }
// }






/****************************************************
A function that I don't (yet) use for adding taxonomy terms to the post class.  This is only relevant if you use <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>.
Note: to add classes to post_class() ad-hoc, you can do post_class('newclass')
from http://wordpress.mfields.org/2010/append-a-posts-taxonomy-terms-to-post-class/
****************************************************/

// add_filter( 'post_class', 'mysite_post_class', 10, 3 );
// if( !function_exists( 'mysite_post_class' ) ) {
//     /**
//      * Append taxonomy terms to post class.
//      * @since 2010-07-10
//      */
//     function mysite_post_class( $classes, $class, $ID ) {
//         $taxonomy = 'type';
//         $terms = get_the_terms( (int) $ID, $taxonomy );
//         if( !empty( $terms ) ) {
//             foreach( (array) $terms as $order => $term ) {
//                 if( !in_array( $term->slug, $classes ) ) {
//                     $classes[] = $term->slug;
//                 }
//             }
//         }
//         return $classes;
//     }
// }






/****************************************************
Register all the sidebars (Widget areas)
****************************************************/



if (function_exists('register_sidebar')) {
	
	register_sidebar(array(
		'name'=> 'Blog',
		'id' => 'sidebar_blog',
		'before_widget' => '<div id="%1$s" class="blogwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
		// 
		// register_sidebar(array(
		// 	'name'=> 'Homepage',
		// 	'id' => 'sidebar_home',
		// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 	'after_widget' => '</li>',
		// 	'before_title' => '<h2>',
		// 	'after_title' => '</h2>',
		// ));
		// register_sidebar(array(
		// 	'name'=> 'Issue Pages',
		// 	'id' => 'sidebar_issue',
		// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 	'after_widget' => '</li>',
		// 	'before_title' => '<h3>',
		// 	'after_title' => '</h3>',
		// ));
		// register_sidebar(array(
		// 	'name'=> 'Default Sidebar',
		// 	'id' => 'sidebar_default',
		// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 	'after_widget' => '</li>',
		// 	'before_title' => '<h3>',
		// 	'after_title' => '</h3>',
		// ));
		// register_sidebar(array(
		// 	'name'=> 'Footer (Left)',
		// 	'id' => 'sidebar_footer_left',
		// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 	'after_widget' => '</li>',
		// 	'before_title' => '<h3>',
		// 	'after_title' => '</h3>',
		// ));
		// register_sidebar(array(
		// 	'name'=> 'Footer (Middle)',
		// 	'id' => 'sidebar_footer_middle',
		// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 	'after_widget' => '</li>',
		// 	'before_title' => '<h3>',
		// 	'after_title' => '</h3>',
		// ));
		// register_sidebar(array(
		// 	'name'=> 'Footer (Right)',
		// 	'id' => 'sidebar_footer_right',
		// 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 	'after_widget' => '</li>',
		// 	'before_title' => '<h3>',
		// 	'after_title' => '</h3>',
		// ));
}
















/**************************************
Register EPI's custom menus.
**************************************/

add_action( 'after_setup_theme', 'regMyMenus' );

function regMyMenus() {
// This theme uses wp_nav_menu() in four locations.
register_nav_menus( array(
'top-nav' => __( 'EPI Top Links' ),
'main-nav' => __( 'Main Navigation' ),

) );
}

// if ( function_exists('register_sidebar') ){
//     register_sidebar(array(
//         'name' => 'Main Sidebar',
//         'before_widget' => '<div class="callout callout-promo clearfix">',
//         'after_widget' => '</div>',
//         'before_title' => '<h3>',
//         'after_title' => '</h3>',
// ));
// }


/**************  END  ********************/





// add_action('init', 'getfield');

// function getfield($key, $echo = FALSE) {
// 	global $post;
// 	$custom_field = get_post_meta($post->ID, $key, true);
// 	if ($echo == FALSE) return $custom_field;
// 	echo $custom_field;
// }



/****************************************************
	Helper function for Gecka Term Ordering plugin
****************************************************/

add_action('init', 'gecka_drag');

function gecka_drag() {
	if( function_exists('add_term_ordering_support') )
	add_term_ordering_support ('people');
}

add_action('init', 'gecka_drag');




/**
 * Define default terms for custom taxonomies in WordPress 3.0.1
 *
 * @author    Michael Fields     http://wordpress.mfields.org/
 * @props     John P. Bloch      http://www.johnpbloch.com/
 *
 * @since     2010-09-13
 * @alter     2010-09-14
 *
 * @license   GPLv2
 */

// http://wordpress.mfields.org/2010/set-default-terms-for-your-custom-taxonomies-in-wordpress-3-0/

function mfields_set_default_object_terms( $post_id, $post ) {
	
    // if ( 'publish' === $post->post_status ) {
        $defaults = array(
	
            'press' => array( 'type' => array( 'press-releases' ) ),
            'news' => array( 'type' => array( 'epi-news' ) ),
            'event' => array( 'type' => array( 'event' ) ),
            'blog' => array( 'type' => array( 'blog' ) ),
            'post' => array( 'type' => array( 'blog' ) ),

            );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );

			if ( array_key_exists( $post->post_type, $defaults ) ) {
	            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults[$post->post_type] ) ) {
	                wp_set_object_terms( $post_id, $defaults[$post->post_type][$taxonomy], $taxonomy );
		
				}
            } // end of if array_key_exists
		} // end of foreach $taxonomies
	// } // end of if post_status is publish
	
} // end of function


add_action( 'save_post', 'mfields_set_default_object_terms', 100, 2 );



/****************************************************
	Helper functions for Front-End Editor plugin.
****************************************************/

// if (function_exists('editable_post_meta')) { 
// 
// function fee_choose_taxonomy_interface( $data ) {
//   if ( isset( $data['taxonomy'] ) )
//     $data['type'] = 'terminput';
// 
//   return $data;
// }
// add_filter( 'front_end_editor_wrap', 'fee_choose_taxonomy_interface' );
// 
// }
// 
// 
// function fee_choose_taxonomy_interface( $data ) {
//   if ( isset( $data['taxonomy'] ) ) {
//     switch ( $data['taxonomy'] ) {
//       case 'issue':
//         $data['type'] = 'terminput';
//         break;
//       // case 'type':
//       //   $data['type'] = 'terminput';
//       //   break;
//       // case 'people':
//       //   $data['type'] = 'terminput';
//       //   break;
// 
//       // 
//       // case 'issue':
//       //   $data['type'] = 'termselect';
//       //   break;
// 
// 
// 
//       // etc.
//     }
//   }
// 
//   return $data;
// }
//  add_filter( 'front_end_editor_wrap', 'fee_choose_taxonomy_interface' );


function fee_choose_taxonomy_interface( $data ) {
  if ( isset( $data['taxonomy'] ) )

    $data['type'] = 'terminput';
    // $data['type'] = 'termselect';

  return $data;
}
add_filter( 'front_end_editor_wrap', 'fee_choose_taxonomy_interface' );



function epi_admin_loop_elements() {
	ob_start();	
	?>
		
		
		 <?php if ( is_user_logged_in() && !in_array(get_post_type(), array('press', 'clip', 'feature', 'news', 'bio')) ) { ?>
		
		<div class="admin-only">
			<strong><a href="<?php the_permalink(); ?>?view=print">Print version</a></strong>
		</div>
		
		<?php if (function_exists('editable_post_meta')) { ?>
		<div class="admin-only">
		<strong>PDF: </strong><br>
		<?php echo editable_post_meta( get_the_id(), 'PDF Location', 'input'); ?> <br>
		<strong>Press release: </strong><br>
		<?php echo editable_post_meta( get_the_id(), 'Press Release Location', 'input'); ?> 	<br>
		<strong>Pub ID (like "Issue Brief #197"): </strong><br>
		<?php echo editable_post_meta( get_the_id(), 'epi_publication_code', 'input'); ?>	
		<br><strong>Author: </strong> <?php the_terms( get_the_id(), 'people', $before, ' | ', $after ); ?>
		<br><strong>Issues: </strong> <?php the_terms( get_the_id(), 'issue', $before, ' | ', $after ); ?>
		<br><strong>Type: </strong> <?php the_terms( get_the_id(), 'type', $before, ' | ', $after ); ?>
		
		</div>
		 <?php } //end Front-End Editor check ?> 
		 <?php } //end is_user_logged_in ?> 
	<?php
return ob_get_clean();
} // end of epi_admin_loop_elements()




function epi_get_associated_id($taxonomy) {
	wp_get_object_terms(get_the_id(), $taxonomy);
	
	return $id;
}








/****************************************************
Functions from Boilerplate theme's functions.php file
****************************************************/


/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function boilerplate_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'boilerplate_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function boilerplate_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( '<span class="nowrap">Read more <span class="meta-nav">&rarr;</span></span>', 'boilerplate' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and boilerplate_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function boilerplate_auto_excerpt_more( $more ) {
//	return ' &hellip;' . boilerplate_continue_reading_link();
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'boilerplate_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function boilerplate_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= boilerplate_continue_reading_link();
	}
	return $output;
}
// add_filter( 'get_the_excerpt', 'boilerplate_custom_excerpt_more' );




/****************************************************
Stop Wordpress from "guessing" redirects for nonexistent URLs
http://wordpress.stackexchange.com/questions/28045/stop-wordpress-from-guessing-redirects-for-nonexistent-urls
****************************************************/


// function no_redirect_guess_404_permalink( $header ){
//     global $wp_query;

//     if( is_404() )
//         unset( $wp_query->query_vars['name'] );

//     return $header;
// }

// add_filter( 'status_header', 'no_redirect_guess_404_permalink' );



/****************************************************
How to remove “Person:”, "Type:", etc. from <title>
http://wordpress.stackexchange.com/questions/29020/how-to-remove-taxonomy-name-from-wp-title
****************************************************/

// add_filter( 'wp_title', 'mamaduka_remove_tax_name', 10, 3 );

function mamaduka_remove_tax_name( $title ) {
    if ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}


/****************************************************
How to remove “Person:”, "Type:", etc. from <title>
http://wordpress.stackexchange.com/questions/29020/how-to-remove-taxonomy-name-from-wp-title
****************************************************/

add_filter( 'wp_title', 'wpse29020_fix_title', 10, 3 );

function wpse29020_fix_title( $title, $sep, $seplocation )
{
    // If this isn't our flavors taxonomy, just return the title
    if( ! is_tax() ) return $title;

    // Get the term and taxonomy
    $obj = get_queried_object();
	$tax = get_queried_object()->taxonomy;

    // Get the terms name
    $name = sanitize_term_field( 'name', $obj->name, $obj->term_id, $tax, 'display' );

    // construct the title
//    $title = $name . " $sep " . bloginfo( 'name' );
    $title = $name . ' | ';
    return $title;
}

// 
// add_filter( 'wp_title', 'wpse29020_fix_title', 10, 3 );
// function wpse29020_fix_title( $title, $sep, $seplocation )
// {
//     // If this isn't our flavors taxonomy, just return the title
//     if( ! is_tax( 'people' ) ) return $title;
// 
//     // Get the term
//     $obj = get_queried_object();
// 
//     // Get the terms name
//     $name = sanitize_term_field( 'name', $obj->name, $obj->term_id, 'people', 'display' );
// 
//     // construct the title
//     $title = $name . " $sep " . bloginfo( 'name' );
//     return $title;
// }



/****************************************************
	Add support for epi.org/feed and other RSS urls.
****************************************************/

add_theme_support('automatic-feed-links');

