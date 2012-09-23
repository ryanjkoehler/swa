<?php
/****************************************************
	query shortcode and loop styles for 
	[]
****************************************************/

function hey_query_shortcode( $atts ) {
	$before = '<ul>';
	$after = '</ul>';
  	extract( shortcode_atts( array(
 		'query' => '',
 		'style' => '',
 		'filter' => '',
		'pagination' => null
  	), $atts ) );

//		$query = wp_parse_args( $query, $defaults );
		
		ob_start();	
//		$the_query = new WP_Query( $atts['query'] );
		
		if ($pagination == 'true'){
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$pagination = "&paged=$paged";
		} else { $pagination = ''; }
		
		
		if ( $filter == 'future' ) {
			add_filter( 'posts_where', 'heyfilter_OnlyFuturePosts' );
		} elseif ( $filter == 'past' ) {
			add_filter( 'posts_where', 'heyfilter_OnlyPastPosts' );
		}
		
		$the_query = new WP_Query( html_entity_decode($query) . $pagination );
		if ($the_query->have_posts()) {
		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php if ($style == 'list') { ?><li>
	<p class="date"><?php echo get_the_date(); ?></p>
	<h3<?php if ($the_query->current_post == 0) {  echo ' class="h3first"'; } ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php // echo hey_authors(); ?>
	<?php if ($the_query->current_post == 0) { the_excerpt(); } ?>
	</li>
<?php } elseif ($style == 'events') { ?><li>
	<h3><span class="date"><?php echo get_the_date(); ?></span>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</li>
<?php }

// Styling for EPI in the News
elseif ($style == 'clips') { 
	$before = '<ul class="line-list">';
	?>
<li>
	<?php if (strlen(get_the_content()) > 10) { $hascontent=' hascontent'; } else {$hascontent=null;} ?>
	<a href="<?php echo get_post_meta(get_the_ID(), 'Clip URL', true); ?>" class="external epi-clip<?php echo $hascontent; ?>"><?php the_title(); ?><br>
	<span class="accent-alt"><?php $array = wp_get_post_terms(get_the_ID(), 'source'); echo $array[0]->name; ?></span> | 
	<span class="date"><?php echo get_the_date(); ?></span>
	<?php if ($hascontent) { ?>
		<span class="showclip">
			<?php the_content(); ?>
		</span>
	<?php } ?>
	</a><?php // edit_post_link(' | Edit clip'); ?>
</li>	
<?php }

// Styling for EPI in the News --alternate
elseif ($style == 'clips2') { ?>

<p><a href="<?php echo get_post_meta(get_the_ID(), 'Clip URL', true); ?>"><?php the_title(); ?></a>  &rarr; 
<span style="white-space:nowrap;">
<span class="accent-alt"><?php $array = wp_get_post_terms(get_the_ID(), 'source'); echo $array[0]->name; ?></span> 
<span class="date"><?php echo get_the_date(); ?></span>
</span>
</p>	

<?php }

// Styling for lists in a sidebar or the columns on the front page
elseif ($style == 'column') { ?>

<li>
	<p class="date"><?php echo get_the_date(); ?></p>
	<h3<?php if ($the_query->current_post == 0) { echo ' class="h3first"'; } ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>  

<?php // if hey_authors() ? echo hey_authors();  ?>

<?php if ($the_query->current_post == 0) { the_excerpt(); } ?>
</li>		

<?php } elseif ($style == 'bios') { ?>

	<div class="person <?php if ($jobtitle) { echo $jobtitle; } // foreach ($jobtypes as $jobtype) {echo ' '.$jobtype;} ?>">
		<h2><a href="<?php echo hey_author_link(); ?>" name="<?php echo strtolower(hey_field('Last name')); ?>" class="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<h3><?php echo hey_field('Job title'); ?></h3>
		<?php if($image = hey_field('post_image')) { ?>
		<div class="attributed-image alignright clearfix">		
		<img src="/m/?src=<?php echo $image; ?>&w=130&h=190" class="bio-photo" width="130" height="190" alt="<?php the_title_attribute(); ?>">
		<br><span class="small"><a href="<?php echo $image; ?>">High-resolution</a></span>
		</div><!-- .image -->
		<?php } ?>
							<?php the_content(); ?>
							<p><a href="<?php echo hey_author_link(); ?>">View publications by <?php the_title(); ?></a></p>
							<?php edit_post_link('Edit bio'); ?>
							<hr>
		

<?php } elseif ($style == 'associate-bios') { ?>
	<strong><a href="<?php echo hey_author_link(); ?>"><?php the_title(); ?></a></strong>, <?php echo hey_field('Organization'); ?><br>


<?php } elseif ($style == 'name-and-title') { ?>
	<p class="columnize-p"><strong><a href="<?php echo hey_author_link(); ?>"><?php the_title(); ?></a></strong><br>
	<?php echo hey_field('Job title'); ?></p>


	
<?php } elseif ($style == 'loop-list') { ?>
		<?php get_template_part( 'loop-main' ); ?>			
	
<?php } elseif ($style == 'blog') { ?>
		<?php get_template_part( 'loop', 'blog' ); ?>
			
	<?php } elseif ($style == 'issues') { ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>	
	
<?php } elseif ($style == 'snapshot') { ?>
<?php } else { ?>

		<?php get_template_part( 'loop-main' ); ?>



<?php }
	endwhile; 
//	echo '<hr>';
	if ($pagination) { ?>
		</ul>
		<div id="adv-search-pagination" class="clearfix">
			<?php wp_pagenavi(array('query' =>$the_query)); ?> 
		</div>
	<?php } // end of $pagination
	
	wp_reset_postdata();
	
	if ( $filter == 'future' ) {
		remove_filter( 'posts_where', 'heyfilter_OnlyFuturePosts' );
	} elseif ( $filter == 'past' ) {
			remove_filter( 'posts_where', 'heyfilter_OnlyPastPosts' );
	}
	
	
	$list = $before . ob_get_clean() . $after;
	
}
	
	return $list;
	
}


add_shortcode( 'postlist', 'hey_query_shortcode' );

