<!doctype html>  
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
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
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/print-ie.css" media="print"><![endif]-->
	<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/libs/modernizr-1.6.min.js"></script>
	<!--[if lt IE 7 ]><script src="<?php echo get_stylesheet_directory_uri() ?>/js/libs/dd_belatedpng.js"></script><script> DD_belatedPNG.fix('img, .png_bg');</script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/print-ie.css" media="print"><![endif]--> 
	
	
	<?php wp_head(); ?>
</head>

<body<?php if (is_front_page()) {?> class="home"<?php } ?>>
	<div id="container"<?php if ( is_page_template('page-interactive.php') ) { ?> class="clearfix interactive"<?php } ?>>
		<div id="header" class="png_bg">
	    	<a class="visuallyhidden" href="#main">Skip to main content</a>
			<div id="identity"><a href="/"><span class="visuallyhidden">Economic Policy Institute - The State Of Working America</span></a></div>

			<?php wp_nav_menu(); ?>

						<?php
	
							// $EPI_menu_walker = new EPI_menu_walker;

						//	if(function_exists('wp_nav_menu')) {
					//			wp_nav_menu(array(
					//				'theme_location' => 'main-nav',
					///				'container' => '',
					//				'container_id' => 'nav',
					//				'menu_id' => 'nav',
					//				'fallback_cb' => 'topnav_fallback',
								//	'walker' => $EPI_menu_walker
					//			));
						//	} else {
						//		get_template_part('part.menu-old'); 
						//	} 
	
						?>
			
			
			<div id="search" class="clearfix">
				
			<div id="essearchlinks" style="color: #fff">
				
				<!-- <a href="/charts/asearch">Advanced Search</a> |  -->
				<!-- <a href="/chart-index">Chart Index</a> -->
			</div>
							
								
				
				<!-- <form name="search" id="SearchForm" method="post" action="/charts/search" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST" /></div><label for="search-text" class="visuallyhidden">Search</label><input name="data[Search][q]" type="text" id="search-text" class="search-text" placeholder="Search" /><input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/img/form/search-go.png" alt="Search submit button" /></form>			</div> -->
				<form name="search" id="SearchForm" method="get" action="/" accept-charset="utf-8"><label for="search-text" class="visuallyhidden">Search</label><input name="s" type="text" id="search-text" class="search-text" placeholder="Search" /><input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/img/form/search-go.png" alt="Search submit button" /></form>			</div>
		</div>
    
		<div id="main-content" class="clearfix">
			<?php if(!is_page_template('page-interactive.php')) { ?>
			<div id="main"<?php if(is_category()) {echo ' class="results"';} ?>>
			<?php } ?>			
