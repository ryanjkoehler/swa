<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php get_header(); ?>

<?php 

if( is_tax() ) {
    // global $wp_query;
    $term = get_queried_object();

    // $taxonomy = $term->taxonomy; // This is the Taxonomy Title
	// $taxonomy_term = $term->name; 


} ?>

<!-- <h2 class="sp-header"><?php echo $taxonomy; /*** This is the title of the taxonomy -- such as "Subjects" or "Demographics" ***/ ?></h2>  -->
	<div id="intro">
		<h1>
			<?php echo $term->name; /*** This is the term you're looking at -- such as "Health" or "Race & Ethnicity" ***/ ?>
		</h1>
	</div>

	<div class="intro">
		
		<?php 

		$myTaxonomy = get_posts(array(
			'post_type' => 'tax',
			$term->taxonomy => $term->slug,
			'posts_per_page' => 1,
		));

		$myTaxonomy = $myTaxonomy[0];

		if ( $myTaxonomy ) {
			setup_postdata($myTaxonomy);

			the_content();
			edit_post_link( 'Click here to edit Taxonomy Meta', '', '', get_the_id() );

			$pdf_url = get_post_meta(get_the_id(), 'pdf_url', true);
			$pdf_url = get_term_link($term) . '?reader';

			if ($pdf_url && $term->taxonomy == 'subject')
				$chapter_button = '<a href="'.$pdf_url.'" class="button-link"><i class="ss-icon">book</i>Read the <span>chapter</span></a>';


			$factsheets = get_posts(array(
					'post_type' => 'page',
					$term->taxonomy => $term->slug,
					'type' => 'fact-sheet',
					'posts_per_page' => -1,
				));

			$factsheet_button = '';

			foreach ($factsheets as $factsheet) {
				setup_postdata($factsheet);
				$buttontext = 'Key numbers on ' . get_the_title();
				if ($term->slug == 'overview') $buttontext = get_the_title();
				$factsheet_button .= '<a class="button-link" href="'.get_permalink().'"><i class="ss-icon">list</i>'.$buttontext.'</a> ';
			}

			wp_reset_postdata();
			wp_reset_query();

		}


	?>

	</div>
	
	
	<?php if ($chapter_button || $factsheet_button ) { ?>
		<div class="buttoncontainer">
			<?php echo $factsheet_button; ?>
			<?php echo $chapter_button; ?>
		</div>
	<?php } ?>


<?php 



/**
 * Output the chapter table of contents
 * 
 */
function epi_swa_chapter_toc() {

	$taxonomy = 'subject';
	$terms = get_terms( $taxonomy, array(
		'child_of' => get_queried_object()->term_id,
		'hide_empty' => true,
		'orderby' => 'term_order',
		// 'exclude' => array(),
		// 'include' => array(),
	));

	$r = '';
	$open[] = '<ol class="subsection-toc">';
	$close[] = '</ol>';

	foreach ( $terms as $term ) {
		$r .= '<li><a href="#" class="subsection-toggler" data-section-id="'. $term->term_id .'">';
		$r .= $term->name;
		$r .= '</a></li>';
	}

	return join($open) . $r . join(array_reverse($close));
}



/**
 * Output charts by tag
 * 
 */
function epi_listChartsByTag() {

	$taxonomy = 'subject';
	$sections = get_terms( $taxonomy, array(
		'child_of' => get_queried_object()->term_id,
		'hide_empty' => true,
		'orderby' => 'slug',
		'exclude' => array(),
		'include' => array(),
	));

	if (!$sections || has_term('poverty', 'subject'))
		$sections = array(get_queried_object());


	?>
	<div class="inset-box">
		<input id="quicksearch" class="bigsearchfield clearfield" value="Type to filter charts" type="text">
		<!-- <a href="#" class="button">View as list</a> -->
		<!-- <a href="#" class="button">View as grid</a> -->
		<a href="#" class="switch_thumb">Switch Thumb</a>
		<div class="chaptertoc">
			<?php // echo epi_swa_chapter_toc(); ?>
		</div>
		
	</div>
	<?php




	foreach($sections as $section) {

		echo '<section class="section">';
		echo '<h2 class="sectiontitle">'.$section->name.'</h2>';

		query_posts(array(
			'orderby' => 'title',
			'order' => 'ASC',
			'post_type' => array('post','chart'),
			$section->taxonomy => $section->slug,
			'posts_per_page' => -1,
		));


		get_template_part( 'loop', 'charts-new' );
		wp_reset_query();

		echo '</section>';
	}
	
	











	?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js-new/jquery.clearfield.js"></script>
		<script type="text/javascript">
		jQuery(function($){

			/**
			 * Automatically style and clear input fields
			 * @uses jQuery ClearField
			 */
			$('.clearfield').clearField();
			
			$('.thumb_view li h2').live({
				click: function(event){
					$(event.target).find('a').trigger('click');
				}
			});


			$('.display li').live({
				mouseenter: function(){
					var $this = $(this);
					$this.addClass('active');
					// var $resizeMe = $this.find('h2');
					// $this.data({originalHeight: $resizeMe.height()}) 
					// $resizeMe.animate({
					// 	height: $this.height()
					// });
				}, 
				mouseleave: function(){
					var $this = $(this);
					$this.removeClass('active');
					// console.log($this.data().originalHeight);
					// $this.find('h2').animate({
					// 	height: $this.data().originalHeight
					// });
				}
			});

			// Add a class to style year ranges at the end of chart titles
			$(".charttitle a").each(function(){
				$title = $(this);
				// $title.html( $title.html().replace(/(\d+([-–— ]\d+)?$)/g, '<span class="daterange">$1</span>' ));
				$title.html( $title.html().replace(/(\d+([-–— and]+\d+)?( \(.*dollars.*\))?\*?$)/g, '<span class="daterange">$1</span>' ));
			});
			
			$("a.switch_thumb").toggle(function(e){
				$(this).addClass("swap"); 
				$("ul.display").fadeOut("fast", function() {
					$(this).fadeIn("fast").removeClass("list_view").addClass("thumb_view");
				});
				e.preventDefault();
			}, function (e) {
		    	$(this).removeClass("swap");
				$("ul.display").fadeOut("fast", function() {
					$(this).fadeIn("fast").addClass("list_view").removeClass("thumb_view");
				});
				e.preventDefault();
			});			


			/**
			 * Quicksearch by Eric
			 * Lets you filter through a set of results
			 */
			
			$('#quicksearch').keyup(function(){
				var speed = 400
				var $input = $(this);
				var $items = $('li.chartitem');
				var query = $input.val().toLowerCase();

				var $misses = $items.filter(function(){
					return $(this).addClass('qs-miss').find('.charttitle').text().toLowerCase().search(query) === -1;
				}).hide(speed);

				$items.not($misses).removeClass('qs-miss').show(speed);

				var $sections = $('.section');
				var $activeSections = $sections.filter(function(){
					return $(this).has('li:not(.qs-miss)').length;
				}).show(speed);

				$sections.not($activeSections).hide(speed);

			});


			/**
			 * Toggle subsections of the chart list
			 */
			
			$('.subsection-toggler').click(function(e){
				var $this = $(this);
				var section = $this.text();
				var $tocLinks = $this.closest('ol').find('.active');

				$tocLinks.not($this).removeClass('active');
				$this.toggleClass('active');

				var $sections = $('.section');
				var $activeSections = $sections.filter(function(){
					return $(this).has('.sectiontitle:contains('+section+')').length;
				});

				if ($tocLinks.filter('.active').length) {
					$sections.not($activeSections).fadeOut(0, function(){
						$activeSections.fadeIn(500);
					});
				} else {
					$sections.fadeIn(500);
				}

				e.preventDefault();
			});




		});

	</script>
		
	<?php

} 

?>

<?php epi_listChartsByTag(); ?>





</div>



<?php get_sidebar() ?>
<?php get_footer(); ?>