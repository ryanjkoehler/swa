<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

		<?php get_header(); ?>

		<?php 
				// $searchterm = get_search_query();
				// $mySearch =& new WP_Query("$query_string & showposts=-1");
				// $numtotal = $mySearch->poslidingtabs_count; // overridden below
				
				// $searchterm = get_search_query();
				// $mySearch =& new WP_Query("$query_string & showposts=-1 & poslidingtabs_type=post");
				// $numposts = $mySearch->poslidingtabs_count;
				
				// $searchterm = get_search_query();
				// $mySearch =& new WP_Query("$query_string & showposts=-1 & poslidingtabs_type=page");
				
				// $numpages = $mySearch->poslidingtabs_count;
				// $numtotal = $numpages + $numposts;
				
		 ?>

			<h2 class="sp-header">Economic Indicators</h2> 
				<div id="intro">
					<h1><?php the_title(); ?></h1>


					<?php the_content(); ?>



<hr><hr><hr>





    <!-- Start HTML - Horizontal tabs -->
    <div id="slidingtabs_horizontal" class="slidingtabs_horizontal">                                                
        
        <div class="slidingtabs_tabs_container">                                                                                                                                          
            
            <a href="#prev" class="slidingtabs_prev"></a>
            
            <div class="slidingtabs_slide_container">
            
                <ul class="slidingtabs_tabs">
                    <li><a href="#slidingtabs_content_1" rel="tab_1" class="slidingtabs_tab slidingtabs_first_tab slidingtabs_tab_active">Horizontal Tab #1</a></li>
                    <li><a href="#slidingtabs_content_2" rel="tab_2" class="slidingtabs_tab">Horizontal Tab #2</a></li>                                     
                    <li><a href="#slidingtabs_content_3" rel="tab_3" class="slidingtabs_tab">Horizontal Tab #3</a></li>
                    <li><a href="#slidingtabs_content_4" rel="tab_4" class="slidingtabs_tab">Horizontal Tab #4</a></li>
                    <li><a href="#slidingtabs_content_5" rel="tab_5" class="slidingtabs_tab">Horizontal Tab #5</a></li>                                                       
                    <li><a href="#slidingtabs_content_6" rel="tab_6" class="slidingtabs_tab">Horizontal Tab #6</a></li>
                    <li><a href="#slidingtabs_content_7" rel="tab_7" class="slidingtabs_tab">Horizontal Tab #7</a></li>
                    <li><a href="#slidingtabs_content_8" rel="tab_8" class="slidingtabs_tab">Horizontal Tab #8</a></li>                                                            
                </ul>
            
            </div> <!-- /.slidingtabs_slide_container -->
            
            <a href="#next" class="slidingtabs_next"></a>                                                                                                
        
        </div> <!-- /.slidingtabs_tabs_container -->
       
        <div class="slidingtabs_view_container">                    
            
            <div class="slidingtabs_view">                 
                        
                <div id="slidingtabs_content_1" class="slidingtabs_tab_view slidingtabs_first_tab_view">
                    <h2>Horizontal Tab #1</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh duis odio morbi quam, scelerisque convallis aenean quam tincidunt ornare nam nec feugiat sodales tristique.</p>
                        
                        <blockquote><p>Aliquam commodo ullamcorper aenean erat. Nullam vel justo in neque porttitor eget laoreet. Aenean lacus adipiscing.</p></blockquote>
                                
                        <p>Aliquam commodo ullamcorper erat. Nullam vel justo cras porttitor laoreet. Aenean lacus dui, consequat eu, adipiscing nonummy, eget non, nisi. Morbi nunc est, dignissim non, ornare sed, luctus eu, massa. Vivamus tincidunt diam nec eget urna.</p>
                        
                        <p>Curabitur velit. Veniam donec orci viverra, lorem convallis in libero quisque, purus erat dolor curabitur, justo arcu nisl, natoque velit euismod dapibus nulla semper. Suspendisse odio tempor. Id ornare nam nec feugiat, ac consectetuer magna, dolor enim vel in, pulvinar bibendum ante ac, dui nibh dui est neque lacinia et. Duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat, eu praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh ut odio morbi quam, scelerisque convallis tincidunt tristique.</p>
                    </div>                            
                </div>
                
                <div id="slidingtabs_content_2" class="slidingtabs_tab_view">
                    <h2>Horizontal Tab #2</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a tellus nec tellus volutpat interdum vel vel nisi. Vestibulum vestibulum porta ultrices. Suspendisse pharetra nisi eu orci sollicitudin nec suscipit tellus lacinia. Cras porta metus sit amet dolor imperdiet at mollis est malesuada. Nulla ligula dolor, porta vel odio. Sed sodales nulla blandit mauris commodo eu varius purus rhoncus. Nam imperdiet elementum egestas. Proin sapien metus, viverra quis tristique a, malesuada a nibh.</p>                                                                
                        
                        <blockquote>Nam et iaculis est. Phasellus nec tempor arcu. Praesent risus vitae eget facilisis tempus fermentum eget mauris semper.</blockquote>                                                                        
                        
                        <p>Nam et iaculis est. Phasellus nec tempor arcu. Praesent at risus vitae lacus facilisis tempus et sed tortor. Duis cursus sapien eget neque laoreet quis fermentum mauris semper. Nulla a diam quis tellus lobortis congue ut vitae massa, sed a ante eros.</p>
                        
                        <p>Donec lacinia aliquet porttitor. Pellentesque vel sem et dui sagittis aliquet. Ut et est eget augue tristique pharetra sit amet quis orci. Quisque elit sem, feugiat a auctor ac, congue vitae massa. Nulla convallis tortor eget ligula elementum in fringilla augue elementum. Ut bibendum accumsan nibh non fringilla. Fusce nec elementum enim. Duis condimentum cursus massa, elit bibendum turpis auctor elementum. Quisque ante felis, tincidunt vel iaculis non, volutpat non neque.</p>
                    </div>
                </div>
                
                <div id="slidingtabs_content_3" class="slidingtabs_tab_view">
                    <h2>Horizontal Tab #3</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh duis odio morbi quam, scelerisque convallis aenean quam tincidunt ornare nam nec feugiat sodales tristique.</p>
                        
                        <blockquote><p>Aliquam commodo ullamcorper aenean erat. Nullam vel justo in neque porttitor eget laoreet. Aenean lacus adipiscing.</p></blockquote>
                                
                        <p>Aliquam commodo ullamcorper erat. Nullam vel justo cras porttitor laoreet. Aenean lacus dui, consequat eu, adipiscing nonummy, eget non, nisi. Morbi nunc est, dignissim non, ornare sed, luctus eu, massa. Vivamus tincidunt diam nec eget urna.</p>
                        
                        <p>Curabitur velit. Veniam donec orci viverra, lorem convallis in libero quisque, purus erat dolor curabitur, justo arcu nisl, natoque velit euismod dapibus nulla semper. Suspendisse odio tempor. Id ornare nam nec feugiat, ac consectetuer magna, dolor enim vel in, pulvinar bibendum ante ac, dui nibh dui est neque lacinia et. Duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat, eu praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh ut odio morbi quam, scelerisque convallis tincidunt tristique.</p>
                    </div>
                </div>
                
                <div id="slidingtabs_content_4" class="slidingtabs_tab_view">
                    <h2>Horizontal Tab #4</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a tellus nec tellus volutpat interdum vel vel nisi. Vestibulum vestibulum porta ultrices. Suspendisse pharetra nisi eu orci sollicitudin nec suscipit tellus lacinia. Cras porta metus sit amet dolor imperdiet at mollis est malesuada. Nulla ligula dolor, porta vel odio. Sed sodales nulla blandit mauris commodo eu varius purus rhoncus. Nam imperdiet elementum egestas. Proin sapien metus, viverra quis tristique a, malesuada a nibh.</p>                                                                
                        
                        <blockquote>Nam et iaculis est. Phasellus nec tempor arcu. Praesent risus vitae eget facilisis tempus fermentum eget mauris semper.</blockquote>                                                                        
                        
                        <p>Nam et iaculis est. Phasellus nec tempor arcu. Praesent at risus vitae lacus facilisis tempus et sed tortor. Duis cursus sapien eget neque laoreet quis fermentum mauris semper. Nulla a diam quis tellus lobortis congue ut vitae massa, sed a ante eros.</p>
                        
                        <p>Donec lacinia aliquet porttitor. Pellentesque vel sem et dui sagittis aliquet. Ut et est eget augue tristique pharetra sit amet quis orci. Quisque elit sem, feugiat a auctor ac, congue vitae massa. Nulla convallis tortor eget ligula elementum in fringilla augue elementum. Ut bibendum accumsan nibh non fringilla. Fusce nec elementum enim. Duis condimentum cursus massa, elit bibendum turpis auctor elementum. Quisque ante felis, tincidunt vel iaculis non, volutpat non neque.</p>
                    </div>
                </div>
                
                <div id="slidingtabs_content_5" class="slidingtabs_tab_view">
                    <h2>Horizontal Tab #5</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh duis odio morbi quam, scelerisque convallis aenean quam tincidunt ornare nam nec feugiat sodales tristique.</p>
                        
                        <blockquote><p>Aliquam commodo ullamcorper aenean erat. Nullam vel justo in neque porttitor eget laoreet. Aenean lacus adipiscing.</p></blockquote>
                                
                        <p>Aliquam commodo ullamcorper erat. Nullam vel justo cras porttitor laoreet. Aenean lacus dui, consequat eu, adipiscing nonummy, eget non, nisi. Morbi nunc est, dignissim non, ornare sed, luctus eu, massa. Vivamus tincidunt diam nec eget urna.</p>
                        
                        <p>Curabitur velit. Veniam donec orci viverra, lorem convallis in libero quisque, purus erat dolor curabitur, justo arcu nisl, natoque velit euismod dapibus nulla semper. Suspendisse odio tempor. Id ornare nam nec feugiat, ac consectetuer magna, dolor enim vel in, pulvinar bibendum ante ac, dui nibh dui est neque lacinia et. Duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat, eu praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh ut odio morbi quam, scelerisque convallis tincidunt tristique.</p>
                    </div>
                </div>
                
                <div id="slidingtabs_content_6" class="slidingtabs_tab_view">
                    <h2>Horizontal Tab #6</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a tellus nec tellus volutpat interdum vel vel nisi. Vestibulum vestibulum porta ultrices. Suspendisse pharetra nisi eu orci sollicitudin nec suscipit tellus lacinia. Cras porta metus sit amet dolor imperdiet at mollis est malesuada. Nulla ligula dolor, porta vel odio. Sed sodales nulla blandit mauris commodo eu varius purus rhoncus. Nam imperdiet elementum egestas. Proin sapien metus, viverra quis tristique a, malesuada a nibh.</p>                                                                
                        
                        <blockquote>Nam et iaculis est. Phasellus nec tempor arcu. Praesent risus vitae eget facilisis tempus fermentum eget mauris semper.</blockquote>                                                                        
                        
                        <p>Nam et iaculis est. Phasellus nec tempor arcu. Praesent at risus vitae lacus facilisis tempus et sed tortor. Duis cursus sapien eget neque laoreet quis fermentum mauris semper. Nulla a diam quis tellus lobortis congue ut vitae massa, sed a ante eros.</p>
                        
                        <p>Donec lacinia aliquet porttitor. Pellentesque vel sem et dui sagittis aliquet. Ut et est eget augue tristique pharetra sit amet quis orci. Quisque elit sem, feugiat a auctor ac, congue vitae massa. Nulla convallis tortor eget ligula elementum in fringilla augue elementum. Ut bibendum accumsan nibh non fringilla. Fusce nec elementum enim. Duis condimentum cursus massa, elit bibendum turpis auctor elementum. Quisque ante felis, tincidunt vel iaculis non, volutpat non neque.</p>
                    </div>
                </div>
                
                <div id="slidingtabs_content_7" class="slidingtabs_tab_view">
                    <h2>Horizontal Tab #7</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh duis odio morbi quam, scelerisque convallis aenean quam tincidunt ornare nam nec feugiat sodales tristique.</p>
                        
                        <blockquote><p>Aliquam commodo ullamcorper aenean erat. Nullam vel justo in neque porttitor eget laoreet. Aenean lacus adipiscing.</p></blockquote>
                                
                        <p>Aliquam commodo ullamcorper erat. Nullam vel justo cras porttitor laoreet. Aenean lacus dui, consequat eu, adipiscing nonummy, eget non, nisi. Morbi nunc est, dignissim non, ornare sed, luctus eu, massa. Vivamus tincidunt diam nec eget urna.</p>
                        
                        <p>Curabitur velit. Veniam donec orci viverra, lorem convallis in libero quisque, purus erat dolor curabitur, justo arcu nisl, natoque velit euismod dapibus nulla semper. Suspendisse odio tempor. Id ornare nam nec feugiat, ac consectetuer magna, dolor enim vel in, pulvinar bibendum ante ac, dui nibh dui est neque lacinia et. Duis netus ut posuere feugiat arcu, purus wisi quis fringilla at, nunc ut eget elit duis erat, eu praesent, ut fermentum lacus turpis cras. Justo gravida erat quam mauris purus, aliquam quisque, eget nisl. Pellentesque nibh ut odio morbi quam, scelerisque convallis tincidunt tristique.</p>
                    </div>
                </div>
                
                <div id="slidingtabs_content_8" class="slidingtabs_tab_view">
                    <h2>Horizontal Tab #8</h2>
                    
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a tellus nec tellus volutpat interdum vel vel nisi. Vestibulum vestibulum porta ultrices. Suspendisse pharetra nisi eu orci sollicitudin nec suscipit tellus lacinia. Cras porta metus sit amet dolor imperdiet at mollis est malesuada. Nulla ligula dolor, porta vel odio. Sed sodales nulla blandit mauris commodo eu varius purus rhoncus. Nam imperdiet elementum egestas. Proin sapien metus, viverra quis tristique a, malesuada a nibh.</p>                                                                
                        
                        <blockquote>Nam et iaculis est. Phasellus nec tempor arcu. Praesent risus vitae eget facilisis tempus fermentum eget mauris semper.</blockquote>                                                                        
                        
                        <p>Nam et iaculis est. Phasellus nec tempor arcu. Praesent at risus vitae lacus facilisis tempus et sed tortor. Duis cursus sapien eget neque laoreet quis fermentum mauris semper. Nulla a diam quis tellus lobortis congue ut vitae massa, sed a ante eros.</p>
                        
                        <p>Donec lacinia aliquet porttitor. Pellentesque vel sem et dui sagittis aliquet. Ut et est eget augue tristique pharetra sit amet quis orci. Quisque elit sem, feugiat a auctor ac, congue vitae massa. Nulla convallis tortor eget ligula elementum in fringilla augue elementum. Ut bibendum accumsan nibh non fringilla. Fusce nec elementum enim. Duis condimentum cursus massa, elit bibendum turpis auctor elementum. Quisque ante felis, tincidunt vel iaculis non, volutpat non neque.</p>
                    </div>
                </div>                                            	
                
            </div> <!-- /.slidingtabs_view -->
         
        </div> <!-- /.slidingtabs_view_container -->                                          
    
    </div> <!-- /#slidingtabs_horizontal -->        
    <!-- End HTML - Horizontal tabs -->                                                                                                        













								




					<?php $query = query_posts("$query_string&posts_per_page=3&poslidingtabs_type=page"); ?>
					<?php // $num = $query->poslidingtabs_count; ?>
					
					
					<h3 class="search"><?php echo $numpages; ?> page<?php if ($numpages!=1) echo 's'; ?> and <?php echo $numposts; ?> chart<?php if ($numposts!=1) echo 's'; ?> were found.</h3>

<?php get_template_part( 'loop', 'search' ) ?>

<div class="navigation" style="text-align:right;"><p><?php posts_nav_link(); ?></p></div>

<?php wp_reset_query(); ?>  

					
			
				
				<?php if ($numposts == 0) { ?> 
					
				<?php } elseif ($numposts > 0) { ?>
					<?php $query = query_posts("$query_string&posts_per_page=-1&poslidingtabs_type=post"); ?>			
				
				<h3 class="search"><?php echo $numposts; ?> chart<?php if ($numpages!=1) echo 's'; ?> found.</h3>
				
<?php get_template_part( 'loop', 'charts' ) ?>

<?php } ?>

			</div>

</div><!-- /.intro???????-->

		<?php get_sidebar() ?>




	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/jquery.slidingtabs.pack.js"></script>
    <script type="text/javascript">  

jQuery(function ($) {	


  	$(document).ready(function() {
  				
  		// Horizontal Sliding Tabs demo
  		$('div#slidingtabs_horizontal').slideTabs({  			
			// Options  			
			contentAnim: 'slideH',
			totalWidth: '640',
			contentAnimTime: 600,
			contentEasing: 'easeInOutExpo',
			tabsAnimTime: 300,

            classBtnDisabled: 'slidingtabs_btn_disabled',
            classBtnNext: 'slidingtabs_next',
            classBtnPrev: 'slidingtabs_prev',
            classExtLink: 'slidingtabs_ext',
            classTab: 'slidingtabs_tab',
            classTabActive: 'slidingtabs_tab_active',
            classTabsContainer: 'slidingtabs_tabs_container', 
            classTabsList: 'slidingtabs_tabs',
            classView: 'slidingtabs_view',
            classViewActive: 'slidingtabs_active_view',
            classViewContainer: 'slidingtabs_view_container'

  		});		  		  		
  	
  	});		


});



    </script>





		<?php get_footer(); ?>