<?php 

wp_dequeue_script('jquery');

 ?>
<!doctype html>  
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
	<script>
		// window.jQuery || document.write("<script src='js/libs/jquery-1.5.1.min.js'>\x3C/script>")    
	</script>
	<?php 




	 ?>
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

<?php if ( false && is_user_logged_in() ) { ?>
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
	<div id="container"<?php if (is_page_template('page-interactive.php')) echo ' class="clearfix interactive"'; ?>>
		<div id="header" class="png_bg">
	    	<a class="visuallyhidden" href="#main">Skip to main content</a>
			<div id="identity"><a href="/"><span class="visuallyhidden">Economic Policy Institute - The State Of Working America</span></a></div>

						<?php
							$EPI_menu_walker = new EPI_menu_walker;
							wp_nav_menu(array(
								'theme_location' => 'main-nav',
								'container' => '',
								'menu_id' => 'nav',
								'walker' => $EPI_menu_walker
							));
						?>
			
			<div id="search" class="clearfix">
				<div id="essearchlinks" style="color: #fff">
					<!-- <a href="/charts/asearch">Advanced Search</a> |  -->
					<!-- <a href="/chart-index">Chart Index</a> -->
				</div>	
				<!-- <form name="search" id="SearchForm" method="post" action="/charts/search" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST" /></div><label for="search-text" class="visuallyhidden">Search</label><input name="data[Search][q]" type="text" id="search-text" class="search-text" placeholder="Search" /><input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/img/form/search-go.png" alt="Search submit button" /></form>			</div> -->
				<form name="search" id="SearchForm" method="get" action="/" accept-charset="utf-8"><label for="search-text" class="visuallyhidden">Search</label><input name="s" type="text" id="search-text" class="search-text" placeholder="Search" /><input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/img/form/search-go.png" alt="Search submit button" /></form>
			</div>
		</div>
    
		<div id="main-content" class="clearfix">
			<?php if(!is_page_template('page-interactive.php')) { ?>
			<div id="main"<?php if(is_category()) {echo ' class="results"';} ?>>
			<?php } ?>			
