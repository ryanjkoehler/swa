<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>
<?php 

// Custom URL forwarding based on plugin
if (function_exists('doUrlForwarding'))
	doUrlForwarding();

 ?>
<?php get_header(); ?>


	<h2 class="sp-header">Error</h2>
	<div class="detail">
		<h1>404. Page not found.</h1>
		<p>Here are a few suggested pages.</p>
		<ul id="nav-404" class="clearfix">
			<li><a href="/about">About the State of Working America</a></li>
			<li id ="features-nav">
				Features
				<ul>
									<li><a href="/features/view/1">Inequality</a></li>
									<li><a href="/features/view/2">Great Recession</a></li>
									<li><a href="/features/view/3"> Economic Landscape</a></li>
								</ul>
			</li>
			<li id ="subjects-nav">
				Subjects

<!-- 

				<ul>
									<li><a href="/charts/subject/8">Poverty</a></li>
									<li><a href="/charts/subject/9">Income</a></li>
									<li><a href="/charts/subject/10">Wages</a></li>
									<li><a href="/charts/subject/11">Health</a></li>
									<li><a href="/charts/subject/12">Jobs</a></li>
									<li><a href="/charts/subject/14">Wealth</a></li>
									<li><a href="/charts/subject/15">International</a></li>
									<li><a href="/charts/subject/16">Mobility</a></li>
									<li><a href="/charts/subject/18">Economy Track</a></li>
								</ul> -->
<ul>
<?php wp_list_categories('taxonomy=subject&title_li='); ?> 
</ul>

			</li>
			<li id ="demographics-nav">
				Demographics
<!-- 				<ul>
									<li><a href="/charts/demographic/1">Race &amp; Ethnicity</a></li>
									<li><a href="/charts/demographic/2">Gender</a></li>
									<li><a href="/charts/demographic/3">Age</a></li>
									<li><a href="/charts/demographic/4">Family Type</a></li>
									<li><a href="/charts/demographic/5">Union Membership</a></li>
									<li><a href="/charts/demographic/6">Immigration Status</a></li>
									<li><a href="/charts/demographic/7">Education Level</a></li>
								</ul>
 -->	
 <ul>
<?php wp_list_categories('taxonomy=demographic&title_li='); ?> 
</ul>
 
 
 
 
 
 
 
 		</li>
		</ul>
		
</div>
</div>

<?php get_sidebar() ?>
    
<?php get_footer(); ?>