<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php get_header('blank'); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>


	<?php get_template_part('part.generatePDF'); ?>

	<?php 
			$img = get_post_meta(get_the_id(), 'fact_sheet_header', true);
			$img = $img ? ' style="background: rgba(255, 255, 255, 0) url(\'' . $img . '.800\') no-repeat center"' : '';

	?>

	
	<div id="intro" <?php post_class(); ?>>
	<header class="print-header"><a href="http://stateofworkingamerica.org">The State of Working America <strong>Key Numbers</a></strong></header>
	<footer class="print-footer">Economic Policy Institute | www.stateofworkingamerica.org | www.epi.org</footer>
	<header class="fact-header" <?php echo $img; ?>>
		<h1><?php the_title(); ?></h1>
	</header>
	
	<?php the_content(); ?>


		</div>


	


</div>

<?php endwhile; endif; ?>

<script type="text/javascript">
	jQuery(function ($) {
		$(".calloutnumber:contains('ppt.')").each(function(){
			$this = $(this);
			html = $this.html();
			html = html.replace(/ppt./gi, '<span class="light">ppt.</span>' );
			$this.html(html);
		})

	});
</script>

<?php get_footer('blank'); ?>