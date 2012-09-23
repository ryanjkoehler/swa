<?php
/**
* Description of Template goes here
*
Template Name: Featured Story
*/

?>


<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<?php 
	
	$children = get_pages('child_of='.$post->ID);

	$parenttitle =		get_the_title($post->post_parent);
	$parenturl =		get_permalink($post->post_parent);	// the second parameter is whether to use the title as the permalink text	

	?>



	<h2 class="sp-header">
	
	<?php // if ($children) { echo 'Feature'; } else { echo '<a href="'. $parenturl . '">' . $parenttitle . '</a>'; } ?>
	
	Feature
	
	</h2>
	
<?php if(has_term($term_optional,'feature') & !$children) { ?>


	<dl class="short-breadcrumb mini-nav">
		<dt><?php echo '<a href="'. $parenturl . '">' . $parenttitle . '</a>'; ?></dt>
	</dl>

<?php 

$next = next_page_not_post($empty, $empty, 'sort_column=menu_order&sort_order=asc');
if (!empty($next)) : ?>
		<dl class="next-page mini-nav">
		<dt>Next Page:</dt>
		<dd><?php echo next_page_not_post(); ?></dd>
	</dl>
	
<?php endif ?>


<?php } ?>

	<div id="intro">
	<h1><?php the_title(); ?></h1>
	
	<?php
	  $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
	  if ($children) { ?>
		
		<div class="feature-nav moved-feature-nav">
			<h3><?php the_title(); ?></h3>
	  		<ol><?php echo $children; ?></ol>
		</div>
	  <?php } ?>
	
	<?php the_content(); ?>


	
<?php if(has_term($term_optional,'feature') && !$children) { ?>
	
	<div class="pagination clearfix">
		
	<?php
	
	 $nextPage = next_page_not_post('Next page', '', 'sort_column=post_date&sort_order=desc');
	 $prevPage = previous_page_not_post('Previous page', '', 'sort_column=post_date&sort_order=desc');
	 if (!empty($nextPage) || !empty($prevPage)) {
//		 if (!empty($prevPage)) echo '<div class="next">Previous page: ' . $prevPage . '</div>';
//		 if (!empty($nextPage)) echo '<div class="next">Next page: ' . $nextPage . '</div>';


//	 if (!empty($prevPage)) echo '&larr; ' . $prevPage;
//	 if (!empty($nextPage)) echo $nextPage . ' &rarr; ';
//echo '<hr>';
//if (!empty($prevPage)) echo '&larr; ' . previous_page_not_post('Previous page');
//if (!empty($nextPage)) echo next_page_not_post('Next page') . ' &rarr;';

if (!empty($prevPage)) echo previous_page_not_post('&larr; Previous page');
if (!empty($nextPage)) echo next_page_not_post('Next page &rarr;');


	}
	?>
			</div>
	<?php } ?>


		<div class="utilities">
			<div class="print-feature"></div>
		</div>

<?php if (!$children) { ?>
		<?php
		  $children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0');
		  if ($children) { ?>
		
			<div class="feature-nav">
				<h3><?php if ($children) { echo get_the_title($post->post_parent); } else {} ?></h3>
		  		<ol><?php echo $children; ?></ol>				
			</div>

<?php } ?>
<?php } ?>

	

	
	
	</div>	
</div>

<?php endwhile; endif; ?>



<?php get_sidebar() ?>
    
<?php get_footer(); ?>