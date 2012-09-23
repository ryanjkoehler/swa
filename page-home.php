<?php
/**
* Description of Template goes here
*
Template Name: Home
*/

?>

<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<div id="intro">
		<?php the_content(); ?>
	</div>

	<div id="intro-quote">
		<blockquote style="margin-top: 0px">
			<!-- <p><em>"…the best resource of information on the economic condition of American workers."</em></p> -->
			<!-- <p style="padding-top:16px; line-height:18px;">Ray Marshall <br />U.S. Secretary of Labor, 1977-1981</p> -->

			<?php // echo get_post_meta($post->ID, 'Callout Text', true) ?>

			<a href="/economic-indicators"><img src="/m/?src=http://www.stateofworkingamerica.org/wp-content/themes/swa-clone/img/eilogo1-pink.png&w=158" alt="Economic Indicators"></a>

			<p class="front-accent">
				<?php 
				$the_query = new WP_Query( 'post_type=page&post_parent=839&posts_per_page=1&orderby=date&order=desc' );
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php echo get_the_date(); ?>: <br>
					<span class="black">New data on </span>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?> &raquo;</a> 
				<?php endwhile; wp_reset_postdata(); ?>
			</p>
		</blockquote>
	</div><!-- intro-quote -->
</div><!-- main-content -->

<?php endwhile; endif; ?>

<div id="aside">
	<?php get_template_part( 'sidebar-explore' ); ?>
</div>

<div>
	<?php get_template_part( 'part.slider', 'home' ); ?>
</div>

<?php get_footer(); ?>