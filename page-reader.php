<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php get_header(); ?>


	<div id="intro" <?php post_class(); ?>>
	<!-- <header class="fact-header"> -->
		<!-- <h1><?php the_title(); ?></h1> -->
	<!-- </header> -->
	
	<?php // the_content(); ?>


		<?php get_template_part('part.reader'); ?>

		</div>

</div>



<div id="aside">

<?php 
	
	// Get fact sheet
	query_posts(array(
		'post_type' => 'tax',
		'subject' => get_queried_object()->slug,
		'posts_per_page' => 1,
		));

	while (have_posts()) : the_post(); 
		$output['pdf'] = get_post_meta(get_the_id(), 'pdf_url', true);
		$output['toc'] = get_post_meta(get_the_id(), 'table_of_contents', true);
		$output['toc'] = do_shortcode($output['toc']);

		ob_start();
		?>
			
		<?php 
		$output['sidebar'] = ob_get_clean();
	endwhile;
	wp_reset_query();

	 ?>

	 <?php 

	 	$term = get_queried_object();
	 	$myDocumentationPost = get_posts("post_type=page&type=documentation&subject={$term->slug}");
	 	$myDocumentationUrl = get_permalink($myDocumentationPost[0]);

	 	// print_r($myDocumentationPost);
	 	// $myDocumentation = $myDocumentation[0]->post_content;
	 	// $pdf_url = get_post_meta($tax_id, 'pdf_url', true);

	  ?>

		<h1><?php the_title(); ?></h1>
		<a href="<?php echo $output['pdf']; ?>" class="button-link blocky"><i class="ss-icon">download</i> Download chapter</a>
		<a href="<?php echo get_term_link(get_queried_object()); ?>" class="button-link blocky"><i class="ss-icon">piechart</i> View <span>charts</span></a>
		<a href="<?php echo $myDocumentationUrl; ?>" class="blocky">Documentation and methodology</a>
		<div class="chaptertoc">
			<?php // the_content(); ?>

			<?php if ($output['toc']) { ?>
				<h2>
					<em>Chapter contents</em>
				</h2>
				<?php echo $output['toc']; ?>
			<?php } ?>
		</div>

	<?php


 ?>

	

</div>


<?php get_footer(); ?>