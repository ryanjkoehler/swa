<?php 
/****************************************************
	Scripts and styles
	
	How to properly add scripts in Wordpress
	http://wpcandy.com/teaches/how-to-load-scripts-in-wordpress-themes
	
	How to enqueue inline scripts
	http://wordpress.stackexchange.com/questions/24851/wp-enqueue-inline-script-due-to-dependancies
****************************************************/


add_action( 'wp_footer', 'epi_add_inline_scripts' );

function epi_add_inline_scripts() {
	// Make sure jQuery is loaded before adding these scripts
	if ( wp_script_is( 'jquery', 'done' ) ) { ?>	
		<script type="text/javascript">
		jQuery(function ($) {


			/**
			 * Front page slider
			 */
			
			var $slider = $('#full-width-slider');
			if ($slider.length) {
				$('#full-width-slider').royalSlider({
				    arrowsNav: true,
				    loop: false,
				    keyboardNavEnabled: true,
				    controlsInside: true,
				    imageScaleMode: 'fill',
				    arrowsNavAutoHide: false,
				    autoScaleSlider: true, 
				    autoScaleSliderWidth: 900,     
				    autoScaleSliderHeight: 400,
				    controlNavigation: 'bullets',
				    thumbsFitInViewport: false,
				    navigateByClick: true,
				    startSlideId: 0,
				    autoPlay: false,
				    transitionType:'move',
				    globalCaption: true
				});
			}


			/**
			 * Stylize fact sheets
			 */
			
			$('.fact-sheet p:first').addClass('factsheet-intro');

			$(".calloutnumber:contains('ppt.')").each(function(){
				$this = $(this);
				html = $this.html();
				html = html.replace(/ppt./gi, '<span class="light">ppt.</span>' );
				$this.html(html);
			});


			/**
			 * Subject and demographic sub-dropdown menus
			 */
			
			$('li.subject-menu-toggler > a, li.demographic-menu-toggler > a').append(' <span style="font-size: .8em; color: #205d81" class="menu-plus"><i class="ss-plus"></i></span>');

			$('li.subject-menu-toggler').click(function(e){
				var $this = $(this);

				// Hide other sub-items
				$this.closest('ul').find('.sub-demographic').slideUp(200);

				// Toggle sub-items
				$this.nextAll('.sub-subject').slideToggle(200);
				e.preventDefault();
			});

			$('li.demographic-menu-toggler').click(function(e){
				var $this = $(this);

				// Hide other sub-items
				$this.closest('ul').find('.sub-subject').slideUp(200);

				// Toggle sub-items
				$this.nextAll('.sub-demographic').slideToggle(200);
				e.preventDefault();
			});
		});
		</script>
	<?php 
	} // if jQuery is done
} // end of function