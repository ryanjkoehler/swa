
<div id="aside">

<?php if ( ! is_page('data') ) { ?>

	<div class="widget-data-2 clearfix">
	<!-- <div class="clearfix"> -->
	<!-- <h3><strong></strong>Open data</h3> -->
	<p><a href="/data">Get the data</a> behind the charts.</p>
	</div>

<?php } ?>

<?php include( get_stylesheet_directory() . '/sidebar-explore.php'); ?>



<div class="callout callout-promo clearfix">
<h3><strong>Interactive</strong> feature</h3>

<a href="/pages/interactive"><img src="http://www.epi.org/files/2012/interactive-thumb.png.180" alt="Interactive feature promo image" /></a>	<a href="/pages/interactive"><span>When income grows, who gains?</span></a></div>


	<!-- <div class="callout callout-nav">
	<h3><strong>Featured</strong> Stories</h3>
	<ul class="clearfix">
					<li><a href="/features/view/1">Inequality</a></li>	
					<li><a href="/features/view/2">Great Recession</a></li>	
					<li><a href="/features/view/3"> Economic Landscape</a></li>	
			</ul>
	</div>
 -->

<?php /* Widgetized sidebar */
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Main Sidebar') ) : ?><?php endif; ?>








</div>


