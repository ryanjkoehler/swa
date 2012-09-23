<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>


<?php 

// $query = new WP_Query( 'post_type=&type=&posts_per_page=10&titlesearch=average' );	

// while($query->have_posts()) : $query->the_post();

// 	echo '<h2>'.get_the_id().'<a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
// 	// the_title();


// endwhile;
// wp_reset_postdata();



 ?>
	<div id="intro" <?php post_class(); ?>>
	<header class="fact-header">
		<h1><?php the_title(); ?></h1>
	</header>
	
	<?php the_content(); ?>


		</div>

<?php if (wp_get_object_terms($post->ID, 'feature')): ?>

		<div class="utilities">
			<div class="print-feature"></div>
		</div>

<?php endif ?>


</div>

<?php endwhile; endif; ?>



<?php get_sidebar() ?>

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

<?php get_footer(); ?>