<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php get_header(); ?>

<?php if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $title = $term->taxonomy;
} ?>

		<h2 class="sp-header">demographic: or <?php echo $title; ?></h2> 
		<div id="intro">
			<h1><?php single_cat_title(); ?></h1>
									</div>
		<ul class="chart-list pagecount-1"><!-- Structured to allow the endless scroll to work -->
						<li>
							
							<ul class="clearfix">
							
<?php $counter = -1;	 ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php 	
$counter++;
if ($counter != 0 && $counter % 3 == 0) {
   echo '</ul></li><li><ul class="clearfix">';
}
?>


		
																	<li>
																										<a href="<?php the_permalink(); ?>"><img src="<?php echo $urlbase; ?>/m/?src=/media/images/big/<?php $key="Chart Cropped"; echo get_post_meta($post->ID, $key, true); ?>&w=180" alt="Thumbnail: <?php the_title(); ?>" /></a>																<h3><a href="<?php the_permalink(); ?>"><?php if (function_exists('the_subheading')) { the_subheading('', ''); } else {the_title();}?></a></h3>

								</li>
								
								
								
								
								
<?php endwhile; endif; ?>


									</ul>
				</li>

		</ul>

	</div>



<?php get_sidebar() ?>
    
<?php get_footer(); ?>