<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

</div>
	    <div id="footer" class="clearfix">
	    	<div id="EPI-info">
		
		
				<?php
				if(function_exists('wp_nav_menu')) {
				wp_nav_menu(array(
				'theme_location' => 'top-nav',
				'container' => '',
				'container_id' => 'clearfix',
				'menu_id' => 'top-nav',
//				'fallback_cb' => 'topnav_fallback',
				));
				} else {
				?>
				<!-- Hard-coded menu -->
				<ul class="clearfix">
					<li><a href="http://www.epi.org">EPI.org</a></li>
					<li><a href="http://www.epi.org/pages/about_the_economic_policy_institute/">About EPI</a></li>
					<li><a href="https://secure.epi.org/page/contribute">Support EPI</a></li>	
				</ul>
<?php } ?>
			
	
			</div>
			<div id="identity-copyright" class="png_bg">
				<span>Economic Policy Institute</span>
				
				<!--Copyright &copy; 2011 Economic Policy Institute. All rights reserved.-->
				This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons <!-- Attribution-ShareAlike 3.0 --> License</a>
				
			</div>
			<div id="share-page">
				<span>Share</span>
				<ul class="clearfix">
					<li>
					<!-- ADDTHIS BUTTON BEGIN -->
					<script type="text/javascript">
					var addthis_config = {
					     username: "episocial"
					};
					</script>	
					<a href="http://www.addthis.com/bookmark.php" 					      
						class="addthis_button"
					    addthis:url="http://www.stateofworkingamerica.com"
					    addthis:title="State of Working America"
					    addthis:description="State of Working America">
				    <img src="http://s7.addthis.com/static/btn/sm-plus.gif" width="16" height="16" alt="Share" /></a>		
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
					<!-- ADDTHIS BUTTON END -->
					</li>
					<li><a class="ir twitter" href="http://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http://www.stateofworkingamerica.com">Twitter</a></li>
					<li><a class="ir facebook" href="http://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http://www.stateofworkingamerica.com">Facebook</a></li>		
				</ul>
			</div>
			<ul id="utility-nav">
				<li>
					<!-- <a href="/pages/view/3">Site Map</a> |  -->
					<!-- <a href="/pages/view/4">Chart Index</a> -->
						
					</li>
				
<!--
				<li><a href="/pages/about">About the State of Working America</a></li>
				<li><a href="http://www.epi.org/">EPI Home</a></li>
-->
				
			</ul>
	    </div>
	</div> <!--! end of #container -->


	<div id="media-info" class="clearfix">
		<div id="for-the-media">
			<h4>For the media</h4>
			<!-- <h4>Economic Policy Institute</h4> -->
			<!-- <span class="pa"><a href="http://www.epi.org/publications/entry/news_from_epi_epi_to_launch_electronic_version_of_state_of_working_america_/">Press Release</a></span> -->
			<span class="org">Economic Policy Institute</span>
			<span class="department">Media Relations Department</span>
			<span class="tel">(202) 775&ndash;8810 | <a class="email" href="mailto:news@epi.org">news@epi.org</a></span>
	
			
			
		</div>
		
	</div>
	
	<!-- Javascript at the bottom for fast page loading -->

	<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<!--	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script> -->	
<!--	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script> -->


<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script> -->

	  
	<!-- scripts concatenated and minified via ant build script-->
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/plugins.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/script.js"></script>
	<!-- end concatenated and minified scripts-->

	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/boxy.js"></script>	

	<script type="text/javascript">
	jQuery(function ($) {	

		// $('#nav li:has(ul)').addClass("dd");
		$('#nav > li').not(':has(ul)').find('a').css({backgroundImage: 'none'});


	});
	</script>
	
	<?php wp_footer(); ?>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/font-symbolset/ss-standard.js"></script>
	</body>
</html>