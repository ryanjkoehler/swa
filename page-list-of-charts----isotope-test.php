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

<?php endwhile; endif; ?>

<ul id="filters">
  <li><a href="#" data-filter="*">Show all</a></li>
  <li><a href="#" data-filter=".income">Income</a></li>
  <li><a href="#" data-filter=".health">Health</a></li>
  <!--   <li><a href="#" data-filter=".alkali, .alkaline-earth">alkali and alkaline-earth</a></li>
    <li><a href="#" data-filter=":not(.transition)">not transition</a></li>
    <li><a href="#" data-filter=".metal:not(.transition)">metal but not transition</a></li> -->
</ul>

<div id="isocontainer">
	

	<?php
	//$mySearch =& new WP_Query("$query_string & showposts=-1 & post_type=post");

	query_posts("s=income&posts_per_page=5&post_type=post"); ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<p class="<?php echo 'income'; ?>"><?php the_title(); ?></p>

	<?php endwhile; endif; ?>
	

	<?php
	//$mySearch =& new WP_Query("$query_string & showposts=-1 & post_type=post");

	query_posts("s=health&posts_per_page=5&post_type=post"); ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<p class="<?php echo 'health'; ?>"><?php the_title(); ?></p>

	<?php endwhile; endif; ?>


</div>


		</div>
		<div class="utilities">
			<div class="print-feature"></div>
		</div>


</div>





<?php get_sidebar() ?>

<script src="<?php echo get_stylesheet_directory_uri() ?>/jquery.isotope.min.js"></script>
    <script type="text/javascript">
	var $ = jQuery;

    	$('#filters a').click(function(){
		  var selector = $(this).attr('data-filter');
		  $('#isocontainer').isotope({ filter: selector });
		  return false;
		});
    </script>
<?php get_footer(); ?>