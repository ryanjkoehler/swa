<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		// bloginfo( 'name' );

		// Add the blog description for the home/front page.
/*		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
*/
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

		?></title>
	<meta name="description" content="State of Working America homepage">
	<meta name="keywords" content="home, page, epi, state of working america">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="imagetoolbar" content="no">
	
	<!-- Typekit fonts -->
	<script type="text/javascript" src="//use.typekit.net/nyu8lvw.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/style.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/style.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/boxy.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/font-symbolset/ss-standard.css">
		<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/print-ie.css" media="print">
	<![endif]--> 
	
	<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/libs/modernizr-1.6.min.js"></script>
	<!--[if lt IE 7 ]>
		<script src="<?php echo get_stylesheet_directory_uri() ?>/js/libs/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
	<![endif]-->
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/print-ie.css" media="print">
	<![endif]--> 
	
	
	
	<?php if(is_page_template('page-interactive.php')) { ?>
		
		
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/swfobject.js" ></script>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/swfaddress.js"></script>
		<script type="text/javascript">
			var flashvars = {dataPath:'<?php echo get_stylesheet_directory_uri() ?>/flash/income.csv'};
			var params = {allowNetworking:"all", hasPriority:"true", allowScriptAccess:"always", wmode:"transparent"};
			var attributes = {id:'income', name:'income'};
			swfobject.embedSWF("<?php echo get_stylesheet_directory_uri() ?>/flash/income.swf", "fcontent", "940", "575", "9.0.115", false, flashvars, params, attributes);
		</script>


		
		
	<?php } ?>




<?php if ( is_user_logged_in() ) { ?>
	
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/style-dan.css">

<?php } ?>	
	
	
	
		
<?php
/****************************************************

This was commented out after activating Google Analyticator plugin
2012-05-30 11:51:57

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5401971-12']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
****************************************************/
?>		
		
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="container"<?php if ( is_page_template('page-interactive.php') ) { ?> class="clearfix interactive"<?php } ?>>
		<div id="header" class="png_bg">
	    	<a class="visuallyhidden" href="#main">Skip to main content</a>
			<div id="identity"><a href="/"><span class="visuallyhidden">Economic Policy Institute - The State Of Working America</span></a></div>

						<?php
	
					// 		$EPI_menu_walker = new EPI_menu_walker;

					// 		if(function_exists('wp_nav_menu')) {
					// 			wp_nav_menu(array(
					// 				'theme_location' => 'main-nav',
					// 				'container' => '',
					// //				'container_id' => 'nav',
					// 				'menu_id' => 'nav',
					// //				'fallback_cb' => 'topnav_fallback',
					// 				'walker' => $EPI_menu_walker
					// 			));
					// 		} else {
					// 			get_template_part('part.menu-old'); 
					// 		} 
	
						?>

			
			<!-- <div id="search" class="clearfix"> -->
			<!-- </div> -->

			<div style="height: 50px; background: red;"></div>
    
		<div id="main-content" class="clearfix">
			<?php if(!is_page_template('page-interactive.php')) { ?>
			<div id="main"<?php if(is_category()) {echo ' class="results"';} ?>>
			<?php } ?>			
