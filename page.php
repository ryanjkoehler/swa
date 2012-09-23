<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php get_header(); ?>

<?php 


	if(have_posts()) : while(have_posts()) : the_post(); 
			
			$img = get_post_meta(get_the_id(), 'fact_sheet_header', true);
			$img = $img ? ' style="background: rgba(255, 255, 255, 0) url(\'' . $img . '.800\') no-repeat center;"' : '';

			$pdf_url = get_post_meta(get_the_id(), 'fact_sheet_pdf', true);

			?>

	<div id="intro" <?php post_class(); ?>>

		<?php if ($pdf_url) { ?>

			<div class="floatright">
				<a href="<?php echo $pdf_url; ?>" target="_blank">Print version [PDF]</a>
			</div>
	
		<?php } ?>

		<header <?php echo $img; ?> class="fact-header"><h1><?php the_title(); ?></h1></header>
		<?php the_content(); ?>

	</div>


<?php get_template_part('part.generatePDF'); ?>


<?php if (wp_get_object_terms($post->ID, 'feature')): ?>

		<div class="utilities">
			<div class="print-feature"></div>
		</div>

<?php endif ?>


</div>

<?php endwhile; endif; ?>



<?php get_sidebar() ?>
<?php get_footer(); ?>