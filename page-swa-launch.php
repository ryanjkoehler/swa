<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php // get_header('jumpdrive'); ?>
<?php get_header(); ?>

<?php 
	if(have_posts()) : while(have_posts()) : the_post(); 
			
			$img = get_post_meta(get_the_id(), 'fact_sheet_header', true);
			$img = $img ? ' style="background: rgba(255, 255, 255, 0) url(\'' . $img . '.800\') no-repeat center;"' : '';
	?>

	<script type="text/javascript">

		jQuery(function ($) {
			// $('#nav, #EPI-info, #for-the-media, #share-page, #search').hide()
			// $('.ss-icon').hide()
			// $('#search').after('<div class="jump-title"><strong>The State of Working America</strong> <span>12th Edition</span> <a href="http://stateofworkingamerica.org">View online &raquo;</a></div>');
		});

	</script>

	<div id="intro" <?php post_class(); ?>>
		<header <?php echo $img; ?> class="fact-header">
			
		</header>
	
		<?php // the_content(); ?>

		<div class="jump-intro clearfix">
			<!-- <h1><?php // the_title(); ?></h1> -->
			<img id="swabook" src="http://www.epi.org/files/2012/swa-book3d.png.240">
			<h1>Welcome to <em>The State of Working America</em>.</h1>
			
			<h3>Thank you for accessing EPI’s <strong><em>State of Working America</em></strong> 
				with your jump drive. Here you’ll find the full text of each chapter as well as summaries of key facts. 
				<!-- If you are online, <a href="http://stateofworkingamerica.org/jump2012">click here to load the web version of this page</a>, with full access to over 250 charts from the book. -->
			</h3>
		</div>

		<?php 

		$chapters = get_terms('subject', array(
				'parent' => 0,
			));

		foreach ( $chapters as $key => $term ) {


			$title = $term->name;

			$key++;
			$number = '<strong>'. $key++ .'</strong> ';
			$title = $number . $title;

			$slug = $term->slug;

			if ( $slug == 'inequality' 
				|| $slug == 'appendix' 
				|| $slug == 'health' 
				|| $slug == 'international' 
				) continue;

			// $myFactsheet = get_posts("subject={$term->slug}&type=fact-sheet");
			// $myFactsheet = is_wp_error($myFactsheet) ? array() : $myFactsheet;

			// foreach ($myFactsheet as $post) {
			// 	setup_postdata($post);
			// 	$factsheet_pdf = get_post_meta($post->ID, 'pdf_url', true);
			// 	wp_reset_postdata();
			// }

			$myMeta = get_posts( array(
				'numberposts'		=>	1,
				'offset'			=>	0,
				'subject'			=>	$term->slug,
				'orderby'			=>	'menu_order',
				'order'				=>	'ASC',
				'post_type'			=>	'tax',
				)
			);

			$myMeta = is_wp_error($myMeta) ? array() : $myMeta;

			foreach ($myMeta as $post) {
				setup_postdata($post);
				ob_start();
				the_content();
				$blurb = ob_get_clean();
				$pdf_url = get_post_meta(get_the_id(), 'pdf_url', true); // This chapter's PDF URL
				// $pdf_url = get_term_link($term) . '?reader'; // This chapter's reader URL
				wp_reset_postdata();
				wp_reset_query();


				

				if ($pdf_url && $term->taxonomy == 'subject')
					$chapter_button = '<a href="'.$pdf_url.'" class="button-link"><i class="ss-icon">book</i>Read the <span>chapter</span></a>';


				$factsheets = get_posts("post_type=page&posts_per_page=-1&type=fact-sheet&subject=$slug");

				// print_r($factsheets);

				$factsheet_button = '';

				foreach ($factsheets as $factsheet) {
					setup_postdata($factsheet);
					$buttontext = "Key numbers on {$factsheet->post_title}";
					
					$factsheet_url = get_permalink($factsheet->ID);
					$factsheet_url = get_post_meta($factsheet->ID, 'fact_sheet_pdf', true);

					// echo $factsheet_url . $factsheet->ID;
					

					// $buttontext = 'Key numbers on ' . get_the_title();
					if ($term->slug == 'overview') $buttontext = $factsheet->post_title;
					$factsheet_button .= '<a class="button-link" href="'.$factsheet_url.'"><i class="ss-icon">list</i>'.$buttontext.'</a> ';
				}

				wp_reset_postdata();
				wp_reset_query();

			}



			?>

			<div class="section">
				<h1 class="sectiontitle"><?php echo $title;  ?></h1>
				<div class="blurb">
					<?php echo $blurb; ?>
				</div>
				<div class="buttoncontainer centered---">
					<?php echo $factsheet_button; ?>
					<?php echo $chapter_button; ?>
				</div>
			</div>



			





			<?php

		}











		 ?>

	</div>
</div>

<?php endwhile; endif; ?>



<?php get_sidebar('jumpdrive'); ?>

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