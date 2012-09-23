<?php
/**
* Description of Template goes here
*
Template Name: Interactive
*/

?>

<?php get_header(); ?>


<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php endwhile; endif; ?>

<!-- 	<div id="intro"><?php the_content(); ?></div>
	
	
	
			<?php echo get_post_meta($post->ID, "Callout Text", true) ?>
	 -->
	
			<div class="interactivetext">
			<div class="itleft">
				<p><strong>Use the sliders on the timeline to select a timespan</strong>, and see how growth in average income was shared between the richest 10% and the other 90% of Americans. All figures are in 2008 dollars.</p>
			</div>	
			<div class="itright">

				<!-- 				<span class="share-chart">Share: <a class="addthis_button" href="http://www.addthis.com/bookmark.php"><img src="http://s7.addthis.com/static/btn/sm-plus.gif" width="16" height="16" alt="Share" /></a></span>
					 -->

					<div class="addthis_toolbox addthis_default_style">
					    <a href="http://addthis.com/bookmark.php?v=250" class="addthis_button_compact">Share</a>
					    <span class="addthis_separator"> </span>
					    <a class="addthis_button_facebook"></a>
					    <a class="addthis_button_twitter"></a>
					    <a class="addthis_button_email"></a>
					    <span class="addthis_separator"> </span>
					    <a class="addthis_button_facebook_like"></a>
					</div>


				</div>
			</div>

			<div id="fcontent">
				<p><a href="http://www.adobe.com/go/getflashplayer"><img src="/flash/income_noflash.png" width="940" height="575" border="0" alt="This content requires the Adobe Flash Player version 9.0.115 or greater and a browser with JavaScript enabled."/>Please download the latest Adobe Flash Player now.</a></p>
			</div>

			<div class="interactivetext">
			<div class="itleft">
			<p>
				<strong>Source:</strong> The data come from this table: http://www.econ.berkeley.edu/~saez/TabFig2008.xls<br />
				on Emmanuel Saez’s website at University of California, Berkeley.

				<a href="javascript:ReverseDisplay('uniquename')">Methodology</a></p> 


				<div id="uniquename" style="display:none;">

				<br /> 

			<p>	<strong>Calculations:</strong> 
				All incomes are in 2008 dollars.  Between any two years, the share of growth in average incomes accounted for by the richest 10% is 10% of the growth in the average income of the top 10% divided by the growth in the overall average income; the share of growth in average incomes accounted for by the bottom 90% is 90% of the growth in the average income of the bottom 90% divided by the growth in the overall average income.  These shares are represented in the pie chart.  In periods where one or more categories saw negative income growth and one or more categories saw positive income growth, the pie chart simply represents the group that saw growth, and the text provides details.  In periods where every category saw income losses, the pie chart shows shares of losses, and the text provides details.  </p>
					</div>
					</div>
				<div class="itright">
				</div>
			</div>

			<script type="text/javascript" language="JavaScript"><!--
			function HideContent(d) {
			document.getElementById(d).style.display = "none";
			}
			function ShowContent(d) {
			document.getElementById(d).style.display = "block";
			}
			function ReverseDisplay(d) {
			if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
			else { document.getElementById(d).style.display = "none"; }
			}
			//--></script>


    
<?php get_footer(); ?>