<?php 


/****************************************************
Get a table or figure in a factsheet, by its figure number
****************************************************/

function epi_chartlink_sc ( $atts, $content=null ) { 
	extract( shortcode_atts( array(
		"number" => null
	), $atts ) ); 
	

		$query = new WP_Query(array(
			'post_type' => 'chart',
			'titlesearch' => $number . ' ', // We have to add a space afterwards or else 2.1 will grab 2.15, etc.
			// 'titlesearch' => '2020',
		));

		// print_r($query);

		while ( $query->have_posts() ) : $query->the_post();

			$url = get_permalink();

		endwhile;
		wp_reset_postdata();

		

		$r = '<a href="'. $url .'">'.$content.'</a>';

		return $r;

}

add_shortcode( 'chartlink', 'epi_chartlink_sc' );






/****************************************************
Get a table or figure in a factsheet, by its figure number
****************************************************/

function epi_factsheet_fig_sc ( $atts, $content=null ) { 
	extract( shortcode_atts( array(
		"number" => null
	), $atts ) ); 

	return; 


	ob_start();
	?>


		<div class="calloutnumber"><?php echo $content; ?></div>


	<?php

	return ob_get_clean();
}

add_shortcode( 'factsheet_fig', 'epi_factsheet_fig_sc' );




/****************************************************
Callout number shortcode
****************************************************/

function epi_calloutnumber_sc ( $atts, $content=null ) { 
	extract( shortcode_atts( array(
	), $atts ) ); 
	ob_start();
	?>


		<div class="calloutnumber"><?php echo $content; ?></div>


	<?php

	return ob_get_clean();
}

add_shortcode( 'calloutnumber', 'epi_calloutnumber_sc' );





/****************************************************
Callout number shortcode
****************************************************/

function epi_spotlight_sc ( $atts, $content=null ) { 
	extract( shortcode_atts( array(
	), $atts ) ); 
	ob_start();
	?>


		<div class="spotlight-container"><?php echo do_shortcode($content); ?></div>


	<?php

	return ob_get_clean();
}

add_shortcode( 'spotlight', 'epi_spotlight_sc' );








/****************************************************
	[haschart] shortcode
****************************************************/

function epi_haschart_sc ( $atts, $content=null ) { 
	extract( shortcode_atts( array(
		'number' => null,
		'style' => null,
	), $atts ) ); 

		if (!$number)
			return;

		$numbers = split(',', $number);
		$numberString = '';
		
		// foreach($numbers as $number) {
		// 	$number = trim($number);

		// 	$numberString .= '<span>'.$number.'</span>'.;
		// }
		
		$numberString = join($numbers, ' | ');

	ob_start();
	?>



		<div class="haschart-box">This section contains these charts: <?php echo $numberString; ?></div>


	<?php

	return ob_get_clean();
}

add_shortcode( 'haschart', 'epi_haschart_sc' );

