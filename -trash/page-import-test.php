<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php // get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<div id="intro" <?php post_class(); ?>>
	<header class="fact-header">
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

<?php // get_footer(); ?>