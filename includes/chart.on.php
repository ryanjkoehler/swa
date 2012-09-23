<?php 


/**
 * Get the components of an EPI chart.
 * 
 */
function get_epi_chart($field) {
	
	global $post;

	$parts = epi_split_title( $post->post_title );
	$title = $parts['title'];
	$number = $parts['number'];
	$type = $parts['type'];

	$label_original = $parts['label'];
	$label = $label_original;
	$label = (isset($_GET['label'])) ? str_replace('_', ' ', $_GET['label']) : $label;


	switch ($field) {
		case 'title':
			return $title;
		case 'label':
			return $label;
		case 'label_original':
			return $label_original;
		case 'number':
			return $number;
		case 'type':
			return $type;
		case 'image_url':
			return get_epi_chart_image_url($number);
		case 'body':
			ob_start();
			the_content();
			return ob_get_clean();
			// return wpautop(get_the_content());
		case 'notes':
			$notes = wpautop( trim(get_post_meta(get_the_id(), 'chart_notes', true)));
			return $notes;
		case 'source':
			$source = wpautop( trim(get_post_meta(get_the_id(), 'chart_source', true)));
			return $source;
		case 'endnotes':
			$endnotes = wpautop( trim(get_post_meta(get_the_id(), 'chart_endnotes', true)));
			return $endnotes;
		default: return;
	}
}








/**
 * Parses an unfiltered post title into its Title, Type, Label, and number.
 *
 * @example input:  $title = SWA-Wages | Figure 3A | Unemployment rate, 1979-2012
 * 			output: $title['title'] = "Unemployment rate, 1979-2012"
 * 					$title['label'] = "Figure 3A"
 * 					$title['number'] = "3A"
 * 					$title['type'] = "Figure"
 * 
 * @param  {string} $post_title The unfitered post title
 * @return {array} The components of the title
 * @since  2012-09-05 23:15:00
 * @author  Eric
 */
function epi_split_title( $post_title ) {

	$titleParts = array();
	$acceptable_types = array('Table', 'Figure', 'Infographic', 'Interactive');

	$titlebits = explode(' | ', $post_title);

	$titleParts['title'] = array_pop($titlebits);
	$titleParts['label'] = array_pop($titlebits);

	$type_and_number = explode(' ', $titleParts['label']);
	if ( is_array($type_and_number) ) {

		$type = $type_and_number[0];
		$number = $type_and_number[1];

		if (in_array($type, $acceptable_types)) {
			$titleParts['type'] = $type;
		}

		if ($number)
			$titleParts['number'] = $number;

	}


	// $img = $img ? $img : 'http://www.epi.org/files/2012/charts-swa/'. $number .'.png';

	return $titleParts;
}












// formerly epi_getChartBodyUrl
function get_epi_chart_image_url( $chart_number = null ) {
	// $chart_label = get_epi_chart('label_original'); // @todo: Provide fallback using $label_original: i.e., if our we have a custom label, first look for that file, and use the original if it doesn't exist.
	// $chart_number = preg_replace('/[^\d]*(\d+)\.?([\w\d]*)/i', '$1$2', $chart_label); // FUTURE: replace this with get_epi_chart('filename')
	
	// $chart_number = get_epi_chart('title');



	// global $post;
	// $chart_number =  // custom added
	// echo '<h2>'. $chart_number . ' is share <h2>';
	
	if (!$chart_number)
		return;

	// Use absolute path so that PHP's file functions will work
	// $path_absolute = '/home/epi/epi.org/files/swa/'; // future: replace this with Wordpress function
	// $path_relative = 'http://www.epi.org/files/swa/';
	$path_absolute = '/home/epi/epi.org/files/2012/charts-swa/'; // future: replace this with Wordpress function
	$path_relative = 'http://www.epi.org/files/2012/charts-swa/';
	// $extension = ($globalChart['format'] == 'png') ? '.png' : '.svg';
	$extension = '.png';
	$filename = $chart_number . $extension;
	


	if (!file_exists($path_absolute . $filename))
		return;

	return $path_relative . $filename;
	
}




