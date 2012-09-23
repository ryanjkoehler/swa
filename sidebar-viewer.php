
<div id="aside">

<?php include( get_stylesheet_directory() . '/sidebar-explore.php'); ?>

<div class="callout callout-promo clearfix">
<h3><strong>Interactive</strong> feature</h3>

<a href="/pages/interactive"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/filler/promo-chart.jpg" alt="Interactive feature promo image" /></a>	<a href="/pages/interactive"><span>When income grows, who gains?</span></a></div>


	<div class="callout callout-nav">
	<h3><strong>Featured</strong> Stories</h3>
	<ul class="clearfix">
					<li><a href="/features/view/1">Inequality</a></li>	
					<li><a href="/features/view/2">Great Recession</a></li>	
					<li><a href="/features/view/3"> Economic Landscape</a></li>	
			</ul>
</div>


<?php /* Widgetized sidebar */
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Main Sidebar') ) : ?><?php endif; ?>








</div>


