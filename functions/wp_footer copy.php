<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery.valign.js"></script>
<?php if ( is_front_page()) { ?>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/EconomicPolicy.json?callback=twitterCallback2&count=1"></script>
<?php } ?>


<!-- <script src="<?php echo get_template_directory_uri(); ?>/jquery.column-1.0.min.js"></script> -->

<script>
	// $(function(){
	// 	$('.columnize4 ul').column({
	// 		count : 3
	// 		// width : '300'
	// 	});
	// });
</script>




<script type="text/javascript">
jQuery(function($) {
	$('.hidefirst').show().removeClass('visuallyhidden');
	$('.stBubble').each(function(){			
		if($(this).text() == '0' || $(this).text() == 'New') {
			$(this).hide();
		}
	});
});
</script>

<script type="text/javascript">
	jQuery(function ($) {
		// $(".blog-emailsubscribe").each(function(){ 
		//         $(this).css("height", $(this).height()+"px"); 
		//         $(this).hide(); 
		// }); 
		// $(this).toggleClass('stay-active');
		$(".blog-getemail").click(function(event) {
			$('.blog-emailsubscribe').slideToggle(200);
		  	event.preventDefault();			
		});
	});
</script>


<script type="text/javascript">
jQuery(function($) {
	$('.epiwidget a img').hover(
		function(){
			$(this).fadeTo(0, 0.8);
		},
		function(){
			$(this).fadeTo(400, 1);
		});
});
</script>

<script type="text/javascript">
	jQuery(function ($) {
		$('#searchform').submit(function(event) {

		   if ($(this).find('input').val() == '') {
		      event.preventDefault();
		   }

		});
	});
</script>

<script type="text/javascript">
jQuery(function ($) {
	var original = $('.social-help span').html();
	$(".sm-li a").hover(function(){
		var help = $(this).find("span").html();
		$('.social-help span').hide().html( help ).fadeIn(300);
	}, function(){
		$('.social-help span').html(original);
	});
});
</script>

<?php 

if (is_tax('economic-snapshots')) {
/****************************************************
	Only on the Snapshots archive
****************************************************/ ?>
	
<script type="text/javascript">
	jQuery(function ($) {	
	$(document).ready(function(){

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
});
</script>
	
<?php	}


if ( in_array(get_post_type(), array('blog', 'post')) || is_page('blog') || is_post_type_archive('blog') || is_page('bloghome') || $_GET["view"] == 'blog' ) {

	/****************************************************
		Only on the blog
	****************************************************/ ?>
<!-- <script type="text/javascript">
	$("a.toggler--").click(function () {
	      $(this).toggleClass("stay-active");
	    });
</script> -->

<script type="text/javascript">
	jQuery(function ($) {
		$(".back-to-epi").click(function(e){
			$("#access").slideToggle(200);
			e.preventDefault();
		});
		$(".utility-and-epi-wrap").mouseleave(function(){
			$("#access").hide(200);			
		})
	});
</script>

<script type="text/javascript">
	jQuery(function ($) {
		$('.blog-toggler').click(function(e){
			$('#blog-infopanel').slideToggle();
			$(this).toggleClass('stay-active');
			e.preventDefault();
		});
	});
</script>

	<script type="text/javascript">
		jQuery(function ($) {
				$('.blog-entry a[href*="/people/"],.blog-entry a[href*="/issues/"],.blog-entry a[href*="/topic/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
				$('.blogwidget a[href*="/issue/"],.blogwidget a[href*="/issues/"],.blogwidget a[href*="/topic/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
				
		});
	</script>

<script src="<?php bloginfo("template_url"); ?>/jquery.linknudging.js"></script>
<script type="text/javascript">
jQuery(function ($) {
	  $('.blogwidget.widget_nav_menu li a').nudge({
//	    property: 'margin',
//	    toCallback: function() { $(this).css('color','#f00'); },
//	    fromCallback: function() { $(this).css('color','#000'); },
	    amount: 8,
	    duration: 200
	  });
});
</script>
<script type="text/javascript">
jQuery(function ($) {
	  $('.blogwidget.widget_nav_menu li:odd').addClass('odd-row');
});
</script>

<?php } /************************************** End blog stuff */ ?>


<?php 
	/****************************************************
		Only on the homepage (epi.org)
	****************************************************/ 


// The homepage feature slider
if (is_front_page()): ?>
	<script src="<?php bloginfo("template_url"); ?>/jquery.cycle.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
	//		jQuery('.top-box').fadeIn(5000, function() {
				jQuery('#carousel')
				.cycle({
				    fx:     'fade',
				    speed:  'fast',
				    timeout: 14000,
				    pager:  '#slider-nav',
				    containerResize: 1,   // resize container to fit largest slide 
	//				fit:           0,     // force slides to fit container 
	//				height:        'auto',// container height (if the 'fit' option is true, the slides will be set to this height as well) 
				    manualTrump:   true  // causes manual transition to stop an active transition instead of being ignored 
				});
			});
	//		});
		</script>		
<?php endif ?>




<?php if (0 == 1) {
	/****************************************************
		Hide this stuff
	****************************************************/ ?>


	<script src="//static.getclicky.com/js" type="text/javascript"></script>
	<script type="text/javascript">try{ clicky.init(66484697); }catch(e){}</script>
	<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/66484697ns.gif" /></p></noscript>



	<script type="text/javascript">
		jQuery(function ($) {
			$(".back-to-epi").mouseover(function(){
				$("#access").slideDown(200);
			});
			$("#access").mouseleave(function(){
				$("#access").hide(200);			
			})
		});
	</script>



	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery.equalHeights.js"></script>
	<script>
	jQuery(function ($) {
		$(document).ready(function(){
		//	$("#sidebar, #content").equalHeights();
		// 	$("#sidebar, #content").css('overflow', 'visible');
		});
	});
	</script>
	
	<script type="text/javascript">
	// jQuery(function($) {
	// 	$(document).ready(function(){
	// 		var minHeight = 540;
	// 		var actualHeight = $('#div-name').height();
	// 		if (actualHeight < minHeight){
	// 			$('#div-name').css({'height' : minHeight});
	// 		};			
	// 	});
	// });
	</script>


	<script type="text/javascript">
		jQuery(function ($) {
				$('.blogwidget a[href*="/people/"],.blog-entry a[href*="/people/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
				$('.blogwidget a[href*="/issue/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
				$('.blogwidget a[href*="/topic/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
				$('.blog-entry a[href*="/people/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
				$('.blog-entry a[href*="/issue/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
				$('.blog-entry a[href*="/topic/"]').each(function(){ $(this).attr('href', $(this).attr('href') + '?view=blog'); });
		});
	</script>





<?php if (!is_admin()) { ?><?php } ?>
<script type="text/javascript">
	jQuery(function ($) {
//	    $("a.hascontent").css('backgroundColor', 'red');
		$('.showclip').hide();
	    $("a.hascontent, h2" ).click(function(){
			$('.showclip').slideDown(100);
	});

	   	});
</script>	

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jquery.blend-min.js"></script>
<script>
jQuery(function ($) {
	$(document).ready(function(){
		$("article ul li").blend();
	});
});
// Caution: blend screws with layout
</script>




<script>
	// jQuery(function ($) {
	// 	    var dur = 400; // Duration Of Animation in Milli Seconds
	// 	        $('.blogwidget .menu a').hover(function() {
	// 				
	// 				var padding = $(this).css( "padding-left" );
	// 			//	var padding = $(this).css( "padding-left", "+=15" );
	// 	            $(this).animate({
	// 	                paddingLeft: '24px'
	// 	            }, dur);
	// 	        }, function() {
	// 	            $(this).animate({
	// 	                paddingLeft: padding
	// 	            }, dur);
	// 	    }); // end of Jquery Script
	// });
</script>

<?php } /************************************** End hidden */ ?>