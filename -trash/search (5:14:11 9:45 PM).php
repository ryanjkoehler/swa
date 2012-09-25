<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

		<?php get_header(); ?>

		<?php 
				$searchterm = get_search_query();
				$mySearch =& new WP_Query("s=$s & showposts=-1");
				$num = $mySearch->post_count;
		 ?>

			<!-- <h2 class="sp-header"><?php echo $taxonomy; /*** This is the title of the taxonomy -- such as "Subjects" or "Demographics" ***/ ?></h2>  -->
				<div id="intro">
					<h1>Search results for "<?php echo $searchterm; ?>" (<?php echo $num; ?>)</h1>
								

					<?php $query = query_posts("$query_string . '&posts_per_page=-1'"); ?>
					
					
					<h3>Pages</h3>
					<?php if ( $query ) : ?>
					<?php while (have_posts()) : the_post(); ?>
					<h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
					<p><?php the_excerpt(); ?></p>
					<?php endwhile; ?>
					<?php else : ?>
				<p>	No pages found.</p>
					<?php endif; ?>

<?php wp_reset_query(); ?>  

					
			
				
					<?php $query = query_posts("$query_string . '&posts_per_page=-1&post_type=post'"); ?>			
				
				<ul class="chart-list pagecount-1"><!-- Structured to allow the endless scroll to work -->
								<li>

									<ul class="clearfix">

		<?php $counter = -1;	 ?>
		<?php if ( $query ) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<?php 	
		$counter++;
		if ($counter != 0 && $counter % 3 == 0) {
		   echo '</ul></li><li><ul class="clearfix">';
		}		
		?>



																			<li>
																												<a href="<?php the_permalink(); ?>"><img src="<?php echo $urlbase; ?>/m/?src=/media/images/big/<?php $key="Chart Cropped"; echo get_post_meta($post->ID, $key, true); ?>&w=180" alt="Thumbnail: <?php the_title(); ?>" /></a>																<h3><a href="<?php the_permalink(); ?>"><?php if (function_exists('the_subheading')) { the_subheading('', ''); } else {the_title();}?></a></h3>

										</li>



		<?php endwhile; ?>
		<?php else : ?>



<p>No charts found.</p>

<?php endif; ?>

											</ul>
						</li>

				</ul>

			</div>

</div><!-- /.intro???????-->

		<?php get_sidebar() ?>

		<?php get_footer(); ?>