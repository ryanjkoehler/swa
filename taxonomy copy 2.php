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
			
			
			.display a {
				text-decoration: none;
			}

			/* Thumbnail toggler */
			ul.display {
				/*float: left;*/
				width: 100%;
				margin: 0;
				padding: 0;
				list-style: none;
			}

			ul.display li {
				float: left;
				width: 100%;
			}
			ul.display li:nth-of-type(even) {
				/*background: #ddd;*/
			}

			ul.list_view .content_block {
				/*padding-left: 1em;*/
			}

			ul.display li:hover {
				/*background: #efefef;*/

			    -webkit-transition-duration: 0.2s;
			    -moz-transition-duration: 0.2s;
			    transition-duration: 0.2s;

			}

			ul.list_view li.active h2 a {
				color: #0071b7;
			}

			ul.display li .content_block a img{
				padding: 5px;
				/*border: 2px solid #ccc;*/
				background: #fff;
				margin: 0 15px 0 0;
				float: left;
			}


			ul.list_view li .content_block a img{
				display: none;
			}


			ul.thumb_view li{
				position: relative;
				width: 200px;
				margin-right: 13px;
				margin-bottom: 13px;
				height: 140px;
				overflow: hidden;
/*
				The horizontal offset of the shadow, positive means the shadow will be on the right of the box, a negative offset will put the shadow on the left of the box.
				The vertical offset of the shadow, a negative one means the box-shadow will be above the box, a positive one means the shadow will be below the box.
				The blur radius (optional), if set to 0 the shadow will be sharp, the higher the number, the more blurred it will be.
				The spread radius (optional), positive values increase the size of the shadow, negative values decrease the size. Default is 0 (the shadow is same size as blur).
				Color
*/

				-moz-box-shadow:    1px 2px 4px 0px #ccc;
				-webkit-box-shadow: 1px 2px 4px 0px #ccc;
				box-shadow:         1px 2px 4px 0px #ccc;

				border-width: 2px;
				border-style: solid;
				border-color: #069;

			}

			/* Hover */
			ul.thumb_view li:hover { 
				/*border-color: #FF5E99;*/
				border-color: #0071b7;
				border-color: hsla();
				-moz-box-shadow:    none;
				-webkit-box-shadow: none;
				box-shadow:         none;
			}


			ul.thumb_view li:nth-child(3n) {
				/*margin-right: 0;*/
			}


			ul.thumb_view * {
				-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
				   -moz-box-sizing: border-box; /* Firefox, other Gecko */
				        box-sizing: border-box; /* Opera/IE 8+ */

			}
			
			ul.thumb_view img {
				/*width: 250px;*/
				width: 100%;
			}
			
			ul.thumb_view li h2 a {
				color: #fff;
			}
			
			ul.thumb_view li h2 {

				cursor: pointer;

				display: block;
				position: absolute;
				bottom: 0;
				width: 100%;
				background: #444;
				background: rgba(0,0,0,.8);
				/*background: hsla(200, 100%, 20%, .8);*/
				text-shadow: 1px 1px 1px #000;
				padding: 20px 10px;
				margin: 0;
				color: #fff;
				font-size: 14px;
				line-height: 1;
			}

			/* Hover */
			ul.thumb_view li.active h2 {
				background: hsla(200, 100%, 30%, 1);
				-webkit-transition-duration: 0.6s;
				-moz-transition-duration: 0.6s;
				transition-duration: 0.6s;

			}

			ul.thumb_view li p{
				display: none;
			}

			ul.thumb_view li .content_block a img {
				margin: 0 0 10px;
			}



			/* View switcher button */

			a.switch_thumb {
				width: 122px;
				height: 26px;
				line-height: 26px;
				padding: 0;
				margin: 10px 0;
				display: block;
				background: url('http://www.stateofworkingamerica.org/wp-content/themes/swa-clone/img/switch1.gif') no-repeat;
				outline: none;
				text-indent: -9999px;
			}
			a:hover.switch_thumb {
				filter:alpha(opacity=75);
				opacity:.75;
				-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=75)";
			}
			a.swap { background-position: left bottom; }

			
			.list_view .chartitem {
				padding: .5em 0;
				border-top: 1px solid #ddd;
			}

			h2.charttitle {
				margin: .5em 0;
				padding: 0;
				/*margin-bottom: 1em;*/
				font-size: 16px;
			}

			h2.charttitle a {
				color: #444;
			}

			
			h2.sectiontitle {
				font-weight: 600;
				font-weight: 300;
				text-transform: uppercase;
				letter-spacing: .2em;
				color: #0071b7;
			}

			a .daterange {
/*				color: yellow;*/
				opacity: .6;
				font-weight: normal;
			}

			.button-link {
			    padding: .5em .7em;
			    background: #4479BA;
			    color: #FFF;

			    -webkit-border-radius: 4px;
			    -moz-border-radius: 4px;
			    border-radius: 4px;

			    border: solid 1px #20538D;

			    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);

			    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
			    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
			    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);

			    -webkit-transition-duration: 0.6s;
			    -moz-transition-duration: 0.6s;
			    transition-duration: 0.6s;

			    -webkit-user-select:none;
			    -moz-user-select:none;
			    -ms-user-select:none;
			    user-select:none;
			}
			.button-link:hover {
			    background: #356094;
			    border: solid 1px #2A4E77;
			    text-decoration: none;
			    color: #fff;
			}

			.button-link:visited {
				color: #fff;
			}

			.middlebutton {
				-webkit-border-radius:  0px;
					-moz-border-radius: 0px;
					  	 border-radius: 0px;
			}

			.leftbutton {
				-webkit-border-top-right-radius: 0px;
				-webkit-border-bottom-right-radius: 0px;
				-moz-border-radius-topright: 0px;
				-moz-border-radius-bottomright: 0px;
				border-top-right-radius: 0px;
				border-bottom-right-radius: 0px;
			}
			.rightbutton {
				-webkit-border-top-left-radius: 0px;
				-webkit-border-bottom-left-radius: 0px;
				-moz-border-radius-topleft: 0px;
				-moz-border-radius-bottomleft: 0px;
				border-top-left-radius: 0px;
				border-bottom-left-radius: 0px;
			}

			.button-link:active {
			    -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
			    -moz-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
			    box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);

			    background: #2E5481;
			    border: solid 1px #203E5F;
			    color: #fff;
			}

			.buttoncontainer {
				margin: 1em 0;
				font-size: 1.4em;
				text-align: right;
			}

			.button-link {
				font-family: Georgia;
				font-style: italic;
			}

			.button-link span {
				font-family: 'myriad-pro';
				font-style: normal;
				text-transform: uppercase;
				font-weight: bold;
				color: hsl(200, 90%, 85%);
			}
			
			.factsheet {
				margin: 2em 0;
				padding: 5em;
				text-align: center;
				background: #ccc;
				/*height: 400px;*/

			   -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
			    -moz-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
			    box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);

			}

			.bigsearchfield {
				/*background: #efefef;*/
				padding: .3em .4em;
				font-family: Georgia;
				font-size: 2em;
				width: 300px;
			}

			.clearFieldBlurred { 
				background: #eee;
				color: #aaa; 
				font-style: italic; 
				/*-webkit-transition-duration: 0.2s;*/
				/*-moz-transition-duration: 0.2s;*/
				/*transition-duration: 0.2s;*/

			}
			.clearFieldActive { 
				color: #666; 
				/*-webkit-transition-duration: 0.2s;*/
				/*-moz-transition-duration: 0.2s;*/
				/*transition-duration: 0.2s;*/

			}


		</style>
		<div class="intro">
			
			<p><span class="firstphrase">Poverty is more than a number.</span> This is a blurb about this subject. It is very short and provides the user with a sense of context. View the charts, get the fact sheet, or read the chapter.</p>
			
		</div>
		
		<div class="buttoncontainer">
		<a href="#" class="button-link leftbutton">View the <span>charts</span></a> <a href="#" class="button-link middlebutton">Get the <span>facts</span></a> <a href="#" class="button-link rightbutton">Read the <span>chapter</span></a>

		</div>


		<div class="factsheet">
			<h1>Fact sheet goes here.</h1>
		</div>




<ul style="list-style-type: none; margin: 0">
<li>I. Poverty and the macroeconomy
</li>
<li>II. Poverty demographics – age, race, ethnicity, family type, and nativity
</li>
<li>III. Poverty – twice poverty, deep poverty, relative poverty, and persistance
</li>
<li>IV. Alternative poverty measures
</li>
<li>V. Government policy and poverty
</li>
<li>VI. Poverty and low-wage workers
</li>
</ul>
	
		
	<?php
	

	function epi_listChartsByTag( $taxonomy ) {

		$sections = get_terms( $taxonomy );
		
		?> 

		<a href="#" class="switch_thumb">Switch Thumb</a> 

		<input id="quicksearch" class="bigsearchfield clearfield" value="Type to filter" type="text">

		<?php
		
		foreach($sections as $section) {

			echo '<section class="section">';
			echo '<h2 class="sectiontitle">'.$section->name.'</h2>';
			$term_id = $section->term_id;
			// $temp = $wp_query;
			// $wp_query = null;
			// $wp_query = new WP_Query("post_tag=$term_id");
			// $wp_query->query("posts_per_page=5");
			// $wp_query->query("post_type=post&post_tag=$section->term_id&posts_per_page=5");
			// $wp_query = new WP_Query( "post_type=post&post_tag={$section->term_id}&posts_per_page=-1" );

			// query_posts("post_type=post&post_tag={$section->term_id}&posts_per_page=-1");


			query_posts(array(
				'post_type' => 'post',
				'tag' => $section->slug,
				'posts_per_page' => 5,
			));

			//Get the Posts
			get_template_part( 'loop', 'charts-new' );
			wp_reset_query();


			// get_template_part('loop', 'charts-new');

			echo '</section>';
			// wp_reset_query();
			// wp_reset_postdata();
			// $wp_query = null;
			// $wp_query = $temp;
			
			
		}
		
		
		?>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js-new/jquery.clearfield.js"></script>
			<script type="text/javascript">
			jQuery(function($){

				$('.clearfield').clearField();
				
				$('.thumb_view li h2').live({
					click: function(event){
						$(event.target).find('a').trigger('click');
					}
				});

				// $('.thumb_view li').live({
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
					$title.html( $title.html().replace(/(\d+([-–— ]\d+)?$)/g, '<span class="daterange">$1</span>' ));
				});
				
				$("a.switch_thumb").toggle(function(){
				  $(this).addClass("swap"); 
				  $("ul.display").fadeOut("fast", function() {
				  	$(this).fadeIn("fast").removeClass("list_view").addClass("thumb_view");
					 });
				  }, function () {
			      $(this).removeClass("swap");
				  $("ul.display").fadeOut("fast", function() {
				  	$(this).fadeIn("fast").addClass("list_view").removeClass("thumb_view");
					});
				}); 			
			});


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

				console.log(query);

			});
			

			// jQuery.fn.liveUpdate = function(list){
			//   list = jQuery(list);
			//   if ( list.length ) {
			//     var rows = list.children('li'),
			//       cache = rows.map(function(){
			//         return this.innerHTML.toLowerCase();
			//       });
			      
			//     this
			//       .keyup(filter).keyup()
			//       .parents('form').submit(function(){
			//         return false;
			//       });
			//   }
			    
			//   return this;
			    
			//   function filter(){
			//     var term = jQuery.trim( jQuery(this).val().toLowerCase() ), scores = [];
			    
			//     if ( !term ) {
			//       rows.show();
			//     } else {
			//       rows.hide();

			//       cache.each(function(i){
			//         var score = this.score(term);
			//         if (score > 0) { scores.push([score, i]); }
			//       });

			//       jQuery.each(scores.sort(function(a, b){return b[0] - a[0];}), function(){
			//         jQuery(rows[ this[1] ]).show();
			//       });
			//     }
			//   }
			// };




			
			</script>
			
		<?php
		
		

	}


	epi_listChartsByTag( post_tag );


}

 ?>


</div>



<?php get_sidebar() ?>
    
<?php get_footer(); ?>