<ul class="display list_view clearfix">

<?php while (have_posts()) : the_post(); ?>
	<li class="chartitem">
		<div class="content_block">
			<?php 

				// Get chart fields
				$number = get_epi_chart('number');
				$type = get_epi_chart('type');

				// Get the image URL, or a fallback, or a table icon
				$img = get_post_meta($post->ID, "Chart_Cropped_URL", true);
				$img = $img ? $img : 'http://www.epi.org/files/2012/charts-swa/'. $number .'.png';
				$img = $img ? $img : 'http://www.epi.org/files/2012/stock-3dbars.png';
				$img = !has_term('table', 'type') ? $img : 'http://www.epi.org/files/2012/icon-table9.png';

				// Get the Economic Indicators tags
				$indicators = get_the_term_list( get_the_id(), 'indicator', 'Economic indicators: ', '', '' );

			 ?>
			<a href="<?php the_permalink(); ?>"><img src="/m/?src=<?php echo $img; ?>&w=196" width="196" alt="Thumbnail: <?php the_title_attribute(); ?>" /></a>
			<?php 

			if ( is_user_logged_in() ) { 

				if (has_term('table', 'type'))
					// $icon = ' ss-rows icon-before';

				if (has_term('figure', 'type')) {
					// $icon = ' ss-barchart icon-before';
					// $icon = ' ss-piechart icon-before';
				}
			}
			 ?>
			<h2 class="charttitle<?php echo $icon; ?>"><a href="<?php the_permalink(); ?>">
				<?php the_title(); ?></a>
			</h2>
			
			<p class="details">
				<?php if ( $number || $indicators ) : ?>
					<?php if ($indicators) { ?>
						<?php echo $indicators; ?>
					<?php } ?>
					<?php if ( $number ) { ?>
						<strong class="figurelabel"><?php echo $type; ?> <?php echo $number; ?></strong> in <em>State of Working America 12th Edition</em>
					<?php } ?>
				<?php endif; ?>
			</p>
		</div>
	</li>
<?php endwhile; ?>

</ul>