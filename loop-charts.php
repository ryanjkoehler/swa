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
			<a href="<?php the_permalink(); ?>"><img src="/m/?src=<?php $key="Chart_Cropped_URL"; echo get_post_meta($post->ID, $key, true); ?>&w=180" width="180" alt="Thumbnail: <?php the_title_attribute(); ?>" /></a>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</li>
	<?php endwhile; endif; ?>
	</ul>
</li>
</ul>