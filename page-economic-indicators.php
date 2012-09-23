<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<div id="intro">
	<h1><?php the_title(); ?></h1>
	
	<?php // the_content(); ?>

<?php 

$the_query = new WP_Query( 'post_type=page&post_parent=839&posts_per_page=-1&orderby=date&order=desc' );

while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>	
		<p><a href="<?php the_permalink(); ?>"><strong>Updated:</strong></a> <?php echo get_the_date(); ?></p>

<?php 

endwhile;

wp_reset_postdata();

?>


		</div>

<?php if (wp_get_object_terms($post->ID, 'feature')): ?>

		<div class="utilities">
			<div class="print-feature"></div>
		</div>

<?php endif ?>


</div>

<?php endwhile; endif; ?>



<?php get_sidebar() ?>
    
<?php get_footer(); ?>