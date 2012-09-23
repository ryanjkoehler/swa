<?php

	/**
	 * Outputs a chart, SWA-style
	 *
	 * @uses get_epi_chart($part)
	 * @uses epi_getSvgContent()
	 * @uses hey_printURL()
	 * @formerly epi_get_swa_chart()
	 */


	// Add CSS classes based on our Wordpress tags
	
	$cssClass[] = 'chart-'.get_the_id();
	
	if(has_term('wide-chart-rotated', 'internal'))
		$cssClass[] = 'chart-landscape';
	if(has_term('wide-chart', 'internal'))
		$cssClass[] = 'chart-wide';
	if(has_term('tall-chart', 'internal'))
		$cssClass[] = 'chart-too-tall';
	if(has_term('narrow-chart', 'internal'))
		$cssClass[] = 'chart-narrow';
	if(has_term('Text-only table', 'internal'))
		$cssClass[] = 'table-text-only';
	if(has_term('multi-page-chart', 'internal'))
		$cssClass[] = 'chart-multipage';
	if(has_term('two-column-chart', 'internal'))
		$cssClass[] = 'chart-two-column';

	if (is_array($cssClass))
		$cssClass = join(' ', $cssClass);
	

	// Set up array to hold wrapper tags
	$openingTags[] = '<figure class="'.$cssClass.'">';
	$closingTags[] = '</figure>';


	// The chart title
	$chart = '';
	$chart .= '<h1>';
	// $chart .= '<span class="figure-label">'.get_epi_chart('label').' </span>';
	$chart .= get_epi_chart('title').'</h1>';
	
	// The chart body
	$chart .= '<div class="chart-body clearfix">';	
	// $chart .= epi_getSvgContent() ? epi_getSvgContent() : get_epi_chart('body');
	$chart .= get_epi_chart('image_url') ? '<img class="fig-image" src="'.get_epi_chart('image_url').'.640">' : get_epi_chart('body');
	$chart .= '</div>';
	
	// The source and notes
	$chart .= '<div class="source-and-notes">';
	
	if ($notes = get_epi_chart('notes')) {
		$chart .= '<div class="chart-notes">';	
		$chart .= $notes;
		$chart .= '</div>';	
	}
	
	if ($source = get_epi_chart('source')) {
		$chart .= '<div class="chart-source">';	
		$chart .= $source;
		$chart .= '</div>';	
	}
	
	$chart .= '</div>'; // source-and-notes
	

	ob_start();
	// Get the template part for chart editing
	get_template_part('part.chartEdit');
	$chart .= ob_get_clean();
	

	if ($openingTags || $closingTags)
		echo join((array)$openingTags) . $chart . join(array_reverse((array)$closingTags));
	else
		echo $chart;
