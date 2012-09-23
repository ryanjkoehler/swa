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

<?php if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $taxonomy = $term->taxonomy; // This is the Taxonomy Title
	$taxonomy_term = $term->name; 
} ?>

<h2 class="sp-header"><?php echo $taxonomy; /*** This is the title of the taxonomy -- such as "Subjects" or "Demographics" ***/ ?></h2> 
<div id="intro">
<h1><?php echo $taxonomy_term; /*** This is the term you're looking at -- such as "Health" or "Race & Ethnicity" ***/ ?></h1>
</div>


<?php 

if (!isset($_GET['newversion'])) {
	
	$wp_query->set('posts_per_page', 300 );
	$wp_query->query($wp_query->query_vars);
	get_template_part('loop', 'charts');

} else {
	?>
		<style type="text/css">
			.intro {
				font-family: Georgia;
				font-size: 1.5em;
			}
			
			.intro .firstphrase {
				font-size: 1.8em;
				line-height: 0;
				color: hsl(200, 80%, 30%);
			}
			
			
			/* Thumbnail toggler */
			ul.display {
				float: left;
				width: 100%;
				margin: 0;
				padding: 0;
				list-style: none;
/*				border-top: 1px solid #333;*/
/*				border-right: 1px solid #333;*/
/*				background: #222;*/
			}
			ul.display li {
				float: left;
				width: 100%;
			}
			ul.display li:nth-of-type(even) {
/*				background: #ddd;*/
			}

			ul.display li .content_block a img{
				padding: 5px;
				border: 2px solid #ccc;
				background: #fff;
				margin: 0 15px 0 0;
				float: left;
			}

			ul.thumb_view li{
				position: relative;
				width: 250px;
				width: 30%;
				width: 300px;
				height: 190px;
/*				margin-right: 1%;*/
			}
			
			ul.thumb_view img {
				width: 250px;
			}
			
			ul.thumb_view li h2 a {
				color: #fff;
			}
			
			ul.thumb_view li h2 {
				display: inline;
				display: block;
				position: absolute;
				width: 250px;
				background: #444;
				background: rgba(0,0,0,.7);
				padding: 20px 10px;
				color: #fff;
			}
			ul.thumb_view li p{
				display: none;
			}
			ul.thumb_view li .content_block a img {
				margin: 0 0 10px;
			}


			a.switch_thumb {
				width: 122px;
				height: 26px;
				line-height: 26px;
				padding: 0;
				margin: 10px 0;
				display: block;
				background: url(http://web.archive.org/web/20110716104416/http://www.sohtanaka.com/web-design/examples/display-switch/switch.gif) no-repeat;
				outline: none;
				text-indent: -9999px;
			}
			a:hover.switch_thumb {
				filter:alpha(opacity=75);
				opacity:.75;
				-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=75)";
			}
			a.swap { background-position: left bottom; }

			
			h2.charttitle {
/*				margin: 0 .3em;*/
			}
			
			a .daterange {
/*				color: yellow;*/
				opacity: .6;
				font-weight: normal;
			}
			
			
		</style>
		<div class="intro">
			
			<p><span class="firstphrase">Poverty is more than a number.</span> This is a blurb about this subject. It is very short and provides the user with a sense of context. View the charts, get the fact sheet, or read the chapter.</p>
			
		</div>
		
		<a href="#" class="switch_thumb">Switch Thumb</a> 

	<?php
	
	$sections = get_terms( 'post_tag' );
	
	
	
	foreach($sections as $section) {
		echo '<h2>'.$section->name.'</h2>';
		$query = new WP_Query( "post_type=post&post_tag={$section->term_id}&posts_per_page=-1" );

		get_template_part('loop', 'charts-new');

		wp_reset_postdata();
		
		
	}
	
	
	?>
		
		<script type="text/javascript">
		jQuery(function($){
			
			$(".charttitle a").each(function(){
				$title = $(this);
				$title.html( $title.html().replace(/(\d+([-–— ]\d+)?$)/g, '<span class="daterange">$1</span>' ));
			});
			
			$("a.switch_thumb").toggle(function(){
			  $(this).addClass("swap"); 
			  $("ul.display").fadeOut("fast", function() {
			  	$(this).fadeIn("fast").addClass("thumb_view"); 
				 });
			  }, function () {
		      $(this).removeClass("swap");
			  $("ul.display").fadeOut("fast", function() {
			  	$(this).fadeIn("fast").removeClass("thumb_view");
				});
			}); 			
		});
		</script>

		
		
		
		
	<?php
	
	
}

 ?>


</div>



<?php get_sidebar() ?>
    
<?php get_footer(); ?>