<?php 
/****************************************************
	Actions attached to the temlate_redirect hook
	Updated 2012-04-18 13:59:50
****************************************************/

// Add the 'view' query var, so that it's registered by Wordpress
add_action('query_vars', 'epi_addqueryvars');

function epi_addqueryvars($qvars) {
	$qvars[] = 'view';
	return $qvars;
}








// Intercept the template if ?view=embed
add_action('template_redirect', 'hey_intercept_template');

function hey_intercept_template() {
	
	$pt = get_post_type();


	// Show the reader if the URL ends in ?reader

    if ( is_tax('subject') && isset($_GET['reader']) ) {
		global $wp_query, $post, $posts;
		get_template_part('page','reader');
		exit();
	}



    if ( isset($_GET['docraptor']) ) {
		global $wp_query, $post, $posts;
		get_template_part('print','factsheet');
		exit();
	}





	$isChart = get_post_type() == 'chart';
	// $isBlog = get_post_type() == 'blog';
	$isBlog = get_query_var('view') == 'blog';
	$isPrint = get_query_var('view') == 'print';
	$isEmbed = get_query_var('view') == 'embed';

	if ($isBlog) {
		get_template_part('blog-archive');
		exit();
	}

	if (has_term('email-template-swa', 'internal') && is_single()) {
		get_template_part('template-email-swa');
		exit();
	}

    if ($isChart) {
		global $wp_query, $post, $posts;
		
		if ($isEmbed):
			get_template_part('single-chart','embed');
			exit();
		elseif ($isPrint && (stripos(get_the_title(), 'swa-') !== false)): 
			get_template_part('template-print','chart');
			exit();
		elseif ($isPrint): 
			get_template_part('template-print','chart');
			exit();
		endif;
		
	} else {
		if ($isPrint): 
			get_template_part('template-print');
			exit();
		elseif (has_term('slideshow-jmpress-js', 'internal')):
			get_template_part('template','slideshow-jmpressjs');
			exit();		
		elseif (has_term('slideshow-impress-js', 'internal')): 
			get_template_part('template','slideshow-impressjs');
			exit();		
		elseif (has_term('slideshow-reveal-js', 'internal')): 
			get_template_part('template','slideshow-revealjs');
			exit();		
		endif;
	}
}

// GET PDF URL
function hey_getpdf($id = null) {
	$id = $id ? $id : get_the_id();
	if ($url = get_post_meta( $id, 'pdf_url', true ))
		return $url;
	if ($url = get_post_meta( $id, 'PDF Location', true ))
		return $url;
	return;
}

// Redirect to the publication's PDF if ?view=pdf 
// Accompanying rule in .htaccess: [see .htaccess]
add_action('template_redirect', 'redirect_header', 1);
function redirect_header() {
	global $wp_query;
	if ((get_post_type() == 'publication') &&
		 ('pdf' == $_GET["view"]) &&
		 ($pdf_url = hey_getpdf(get_the_id()))) {
		
		wp_redirect($pdf_url, 303);	
		
		exit;
	}
}
