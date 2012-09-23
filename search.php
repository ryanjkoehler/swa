<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */



/**
 * The same as Wordpress's get_template_part, but it accepts a WP_Query object as its first variable so that you can use loop templates 
 * 
 * @param object $query  WP_Query object
 * @param string $template1 template name base
 * @param string $template2 template name 
 * @return gets the template part with $query as its query
 */
function get_loop_template( $query = null, $template1 = null, $template2 = null ) {

	if ( !$template1 || !$query )
		return;
	
	global $wp_query;
	$wp_query = $query;

	get_template_part($template1, $template2);

	wp_reset_query();

}


$searchterm = get_search_query();


$pageQuery = new WP_Query(array(
        'post_type'         => array('page'),
        's'                 => $s,
        'posts_per_page'    => -1,
        'paged'             => $paged
    )
);

$numPages = $pageQuery->post_count;



$chartQuery = new WP_Query(array(
        'post_type'         => array('chart','post'),
        's'                 => $s,
        'posts_per_page'    => -1,
        'paged'             => $paged
    )
);

$numCharts = $chartQuery->post_count;


$numTotal = $numCharts + $numPages;


?>

		<?php get_header(); ?>

		<?php 
// 				$searchterm = get_search_query();
// //				$mySearch =& new WP_Query("s=$s & showposts=-1");
// 				// $mySearch = new WP_Query("$query_string&post_type=post,chart,page&showposts=-1");
// 				$mySearch = new WP_Query("s=$searchterm&post_type=post,chart,page&showposts=-1");
// 				$numtotal = $mySearch->post_count; // overridden below
// 				wp_reset_query();
				
// 				$searchterm = get_search_query();
// //				$mySearch =& new WP_Query("s=$s & showposts=-1 & post_type=post");
// 				// $mySearch = new WP_Query("$query_string&showposts=-1&post_type=post,chart");
// 				$mySearch = new WP_Query("s=$searchterm&showposts=-1&post_type=post,chart");
// 				$numcharts = $mySearch->post_count;
// 				wp_reset_query();
				
// // 				$searchterm = get_search_query();
// // //				$mySearch =& new WP_Query("s=$s & showposts=-1 & post_type=page");
// // 				// $mySearch = new WP_Query("$query_string&showposts=-1&post_type=page");
// // 				$mySearch = new WP_Query("s=$searchterm&showposts=-1&post_type=page");
// // 				wp_reset_query();
				
// // 				$numpages = $mySearch->post_count;
// 				$numtotal = $numpages + $numcharts;


// 				$numtotal = $wp_query->post_count;



				
		 ?>

			<!-- <h2 class="sp-header"><?php echo $taxonomy; /*** This is the title of the taxonomy -- such as "Subjects" or "Demographics" ***/ ?></h2>  -->
				<div id="intro">
					<!-- <h1>Search results for "<?php echo $searchterm; ?>" <span style="color:#aaa;">(<?php echo $numtotal; ?>)</span></h1> -->
					<h1>Search results for "<?php echo $searchterm; ?>" <span style="color:#aaa;">(<?php echo $numTotal; ?>)</span></h1>
						<?php 



					 // $query = query_posts("s=$searchterm&posts_per_page=-1&post_type=page");
					 // $num = $query->post_count;








						 ?>	

					
					
					<!-- <h3 class="search"><?php echo $numpages; ?> page<?php if ($numpages!=1) echo 's'; ?> and <?php echo $numcharts; ?> chart<?php if ($numcharts!=1) echo 's'; ?> were found.</h3> -->
					<h3 class="search"><?php echo $numPages; ?> page<?php if ($numPages!=1) echo 's'; ?> and <?php echo $numCharts; ?> chart<?php if ($numCharts!=1) echo 's'; ?> were found.</h3>

<?php // get_template_part( 'loop', 'search' ) ?>
<?php get_loop_template( $pageQuery, 'loop', 'search' ) ?>

<div class="navigation" style="text-align:right;"><p><?php posts_nav_link(); ?></p></div>

<?php wp_reset_query(); ?>  

					
			
				
				<?php 

				// if ($numcharts == 0) {

				// } elseif ($numcharts > 0) { 

				if ( true || $numcharts = true ) {

					// $WP_Query = new WP_Query("s=$searchterm&posts_per_page=-1&post_type=post,chart"); 





					// $wp_query = $chartQuery;



					get_loop_template( $chartQuery, 'loop', 'charts-new' );

					?>			
				
				<!-- <h3 class="search"><?php echo $numcharts; ?> chart<?php if ($numpages!=1) echo 's'; ?> found.</h3> -->
				<!-- <h3 class="search"><?php echo $numCharts; ?> chart<?php if ($numpages!=1) echo 's'; ?> found.</h3> -->
				
<?php // get_template_part( 'loop', 'charts-new' ) ?>

<?php } ?>

			</div>

</div><!-- /.intro???????-->

		<?php get_sidebar() ?>

		<?php get_footer(); ?>