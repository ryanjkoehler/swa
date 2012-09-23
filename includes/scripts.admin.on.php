<?php 
/****************************************************
	Inline Javascript for the admin
	
	How to properly add scripts in Wordpress
	http://wpcandy.com/teaches/how-to-load-scripts-in-wordpress-themes
	
	How to enqueue inline scripts
	http://wordpress.stackexchange.com/questions/24851/wp-enqueue-inline-script-due-to-dependancies
****************************************************/


add_action( 'wp_footer', 'epi_add_inline_scripts_admin' );

function epi_add_inline_scripts_admin() { 
	if ( is_admin() && wp_script_is( 'jquery', 'done' ) ) { ?>	

		<script type="text/javascript">
		jQuery(function ($) {



			$(".p2p-col-title a:first-child").after('<a href="#" class="hey-getchartlink">Shortcode</a>');
			$('.hey-getchartlink').click(function(){
				alert( $(this).parent('td').find('a:first-child').text() );
			});



		});
		</script>
	<?php 
	} // if admin && jQuery is done
} // end of function