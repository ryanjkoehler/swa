<?php 



function log_if_admin($content, $function = 'echo') {

	global $current_user;
	get_currentuserinfo();

	if ( $current_user->user_login != 'admin' )
		return;

	ob_start(); ?> 
		<span class="admin-only">
			<?php 

			if ($function == 'echo')
				echo $content; 

			if ($function == 'print_r')
				print_r($content);

			if ($function == 'alert') { 
				?>

				<script type="text/javascript">
					alert('<?php echo $content; ?>');
				</script>

				<?php
			}
				

			?>
		</span>
	<?php

	echo ob_get_clean();

};



get_template_part('functions/class.colorConversion');

/* $testrgb = array(0.2,0.75,0.4); //RGB to start with 
print_r($testrgb); */ 

/*
  print "Hex: "; 
  $testhex = "#C5003E"; 
  print $testhex; 
  $testhex2rgb = _color_unpack($testhex,true);  
  print "<br />RGB: "; 
  var_dump($testhex2rgb); 
  print "<br />HSL color module: "; 
  $testrgb2hsl = _color_rgb2hsl($testhex2rgb); //Converteren naar HSL 
  var_dump($testrgb2hsl); 
  print "<br />RGB: "; 
  $testhsl2rgb = _color_hsl2rgb($testrgb2hsl); // En weer terug naar RGB 
  var_dump($testhsl2rgb); 
  print "<br />Hex: "; 
  $testrgb2hex = _color_pack($testhsl2rgb,true); 
  var_dump($testrgb2hex); 

  */





function epi_getSvgCode() {

	$chartBodyUrl = get_epi_chart('image_url');
	
	if (!$chartBodyUrl)
		return;
		
	ob_start(); ?>
		<object data="<?php echo $chartBodyUrl; ?>" width="480" height="300" type="image/svg+xml">
			<!-- <img src="<?php echo $chartBodyUrl; ?>" width="480" height="300"> -->
		</object>
	<?php
	
	return ob_get_clean();

}







function epi_pregreplace_fontsize($matches) {
	$size = $matches[1];
	$multiplier = 1.1;

	$newSize = $size * $multiplier;
	$newSize = 'font-size="'.$newSize.'"';
	return $newSize;
}	





/**
 * Deprecated -- we can just use preg_match_all to capture all colors into an array
 */

function regexCallback_colorMatcher($matches){
	global $foundColors;
	$foundColors[] = $matches[0];
	return $matches;

}

function resaturate_hsl($hsl, $amount = .5, $max = .85, $min = .1) {
	$regex = '/hsl\((\d+), ?(\d+)%, ?(\d+)%\)/i';
	preg_match($regex, $hsl, $match);

	$h = $match[1];
	$s = $match[2];
	$l = $match[3];


	// Convert lightness to decimal
	$l = $l / 100;

	// if ($min == 0)
		// $min = $l/100;

	$range = $max - $min;

	// $l = $l + ($amount/$range * 100); //
	$l = ($amount/$range);
	// $l = $l + ($amount * 100) * $range;

	// Make sure lightness is between the min and max
	$l = max($min, $l);
	$l = min($max, $l);

	// Convert lightness back to percent
	$l = $l * 100;
	

	$newHslString = "hsl($h, $s%, $l%)";
	// echo $newHslString;
	return $newHslString;

}


function createMonochromeColorArray( $n ) {
	$percents = array();
	$percents[1] = array(40);
	$percents[2] = array(25, 70);
	$percents[3] = array(25, 55, 80);
	$percents[4] = array(15, 40, 60, 80);
	$percents[5] = array(15, 28, 45, 75, 85);
	$percents[6] = array(15, 35, 55, 75, 85, 100);
	$percents[7] = array(15, 30, 45, 60, 75, 90, 100);
	$percents[8] = array(15, 24, 33, 42, 51, 60, 69, 78, 87);
	$percents[9] = array(15, 25, 35, 45, 55, 65, 75, 85, 95);
	$percents[10] = array(15, 26, 37, 48, 59, 70, 81, 92, 100);

	$newColors = array();

	if (is_array($percents[$n])) {
		foreach ( $percents[$n] as $key => $valPercent ) {
			$valPercent = 100 - $valPercent;
			$valDecimal = $valPercent / 100;

			// Create an hsl() color. But this doesn't work in DocRaptor
			$newColors[$key] = "hsl(350, 60%, $valPercent%)";

			// Create an rgba() color. But transparency isn't great and doesn't seem to match lightness
			$newColors[$key] = "rgba(200, 0, 133, " . $valDecimal . ")";

			// Try using Drupal color conversion helpers

			if (function_exists('_color_hsl2rgb')) {
				// Create a color array
				$hsl = array(.2, .5, $valDecimal);

				// log_if_admin($hsl, 'print_r');

				// Convert to RGB
				$rgb = _color_hsl2rgb($hsl);
				$rgb[0] = round($rgb[0]*255);
				$rgb[1] = round($rgb[1]*255);
				$rgb[2] = round($rgb[2]*255);


				// Save as string
				// $rgb_string = "rgb(".$rgb[0]*255.", ".$rgb[1]*255.", ".$rgb[2]*255.")";
				$rgb_string = "rgb($rgb[0], $rgb[1], $rgb[2])";
				$newColors[$key] = $rgb_string;
			}

		}


		// $newColors = array_reverse($newColors);
		
		// Charts that require colors to be ordered from darkest to lightest

		$specialCharts = array(
			35403, // 6G
			// 28675, // 5B
			28678, // 5C pie

			35442, // 6Q stacked bar with US bar set apart
			28905, // 3H stacked bar with US bar set apart
			32617, // 7U "
			32619, // 7V "
			32621, // 7W "
			32625, // 7X "
			32627, // 7Y "
			32630, // 7Z "

			31368, // 2v area chart
			9999999
		);

		if (in_array(get_the_id(), $specialCharts)) {
			$newColors = array_reverse($newColors);
		}


	}




	return $newColors;

}


function createReplacementColorArray( $foundColors, $hslBaseColor ) {

	// Replacement color is an HSL string like this: hsl(360, 80%, 50%);
	// $replacementColor

	// Remove duplicates from the array
	$foundColors = array_unique($foundColors);

	// How many colors are in the array?
	$num = count($foundColors);

	echo "<h3 class='admin-only'>Found $num colors</h3>";

	// Create an empty array to hold new colors
	$newColors = array();

	// // Loop through the colors
	// for ($i = 0; $i <= $num; $i++) {
	// 	// $newColors[] = 'hsl(120, 50%, 50%)';
	// 	$newColors[] = resaturate_hsl($hslBaseColor, $i/$num);
	// }



	$newColors = createMonochromeColorArray( $num );

	return array( $foundColors, $newColors );
}










function epi_getSvgContent() {
	// $chartBodyUrl = epi_getChartBodyUrl();
	$chartBodyUrl = get_epi_chart('image_url');
	
	if (!$chartBodyUrl)
		return;
	
	if ($globalChart['format'] == 'png')
		return '<img src="'.$chartBodyUrl.'" alt="">';
			
	$svgString = file_get_contents($chartBodyUrl);


	// Color replacement
	// Future: maybe cmyk() or device-cmyk() colors will be supported
	
	global $current_user;
	get_currentuserinfo();

	$is_me = $current_user->user_login == 'admin';
	$ignore_user = isset($_GET['ignore_user']);
	


	if ( ( $is_me && !$ignore_user ) ) {



		// Try replacing all point markers with outlined circles
		// $svgString = preg_replace('/(<circle fill=")[^"]*("[^>]*>)/i', '$1#FFF" stroke="black$2', $svgString);
		$svgString = preg_replace('/<((?:circle)|(?:ellipse)) fill="[^"]*"/i', '<$1 fill="#FFF" stroke="#888"', $svgString);
		$svgString = preg_replace('/<circle (?!fill=)/i', '<circle fill="#FFF" stroke="#888"', $svgString);
		
		// Change line caps from round to square
		$svgString = preg_replace('/stroke-linecap="round"/i', 'stroke-linecap="square"', $svgString);




		$colors = array();
		$colors[] = '#CCE8FC'; //light in area chart http://www.epi.org/chart/swa-wealth-figure-6g-wealth-groups-shares/?view=print&color_correction=false
		$colors[] = '#D0E1F4';
		$colors[] = '#C1E3FA';
		$colors[] = '#77C2F7';
		$colors[] = '#9EC2E9';

		$colors[] = '#0D6392';
		$colors[] = '#275D90';
		$colors[] = '#1D4871';
		$colors[] = '#133250';
		$colors[] = '#016188';
		$colors[] = '#62B2E1';
		$colors[] = '#66A1DD';
		$colors[] = '#578CC0';
		$colors[] = '#398EC0';
		$colors[] = '#88CEFA';
		$colors[] = '#002C48';
		$colors[] = '#51A2D9';
		$colors[] = '#51A2D9'; // 2m lots of lines
		$colors[] = '#2D7AB3'; // 2y pie
		$colors[] = '#0E4E7E'; // 2z bar
		$colors[] = '#4675A3'; // 3a line
		
		$colors[] = '#011F38'; // Darkest, chapter 2



		$colors[] = '#52A2D9'; // Used as simultaneous to other color in axis of Intro 1D http://www.epi.org/chart/swaproduction/?view=print&chapter=introduction&type=figure
		$colors[] = '#2E7AB3'; // Used as simultaneous to other color in axis of Intro 1B http://www.epi.org/chart/swaproduction/?view=print&chapter=introduction&type=figure
		$colors[] = '#6095C9'; // Used as simultaneous to other color in axis of Intro 1B http://www.epi.org/chart/swaproduction/?view=print&chapter=introduction&type=figure
		$colors[] = '#1F497D'; // Used in text of 1A
		$colors[] = '#4F81BD'; // Used in text of 1A
		$colors[] = '#6095c9'; // Right dot in 1P http://www.epi.org/chart/swaproduction/?view=print&chapter=introduction&type=figure


		$colorRegexString = join($colors, ')|(');
		$colorRegexString = '/(' . $colorRegexString  . ')/i';

		// echo '<h2>'.$colorRegexString.'<h2>';

		$foundColors = array();
		$replacementColors = array();

		// preg_replace_callback( $colorRegexString, 'regexCallback_colorMatcher', $svgString);
		
		// Store matches in $foundColors
		$hasColors = preg_match_all( $colorRegexString, $svgString, $foundColors);
		// $svgString = preg_replace( $colorRegexString, 'red', $svgString);


		$newBaseColor = 'hsl(359, 80%, 80%)';

		// Clean up the array
		$foundColors = $foundColors[0];
		$foundColors = array_unique($foundColors);
		$newColors = createReplacementColorArray($foundColors, $newBaseColor);
		$newColors = $newColors[1];

		// resaturate_hsl($newBaseColor);


		// echo '<h4>Found colors:</h4>';
		// print_r($foundColors);

		// echo '<h4>New colors:</h4>';
		// print_r($newColors);

		// // $svgString = preg_replace($foundColors, $newColors, $svgString);


		if ( $_GET['color_replacement'] == 'hide_all') {
			$svgString = str_replace('<text ', '<text fill="white" ', $svgString);
			$svgString = preg_replace('/(#000000)|(#F5F5F5)|(#888)|(#989898)/i', 'white', $svgString);

			$newColors = 'white';
		}


		$svgString = str_replace($foundColors, $newColors, $svgString);

	}

	













	/***************************************************
	No need to edit above (unless you know what you're doing)
	@DAN: You can add colors here to replace them:
	*****************************************************/


	// Add another line like the ones below to find/replace another color. Source color first, replacement color second.

	if ( $_GET['color_correction'] !== 'false' )  {

		$svgString = preg_replace('/(#CCE8FC)/i', '#88CEFA', $svgString); // For example, this replaces #CCE8FC with #88CEFA.
		$svgString = preg_replace('/(#D0E1F4)/i', '#88CEFA', $svgString);
		$svgString = preg_replace('/(#C1E3FA)/i', '#88CEFA', $svgString); 
		$svgString = preg_replace('/(#77C2F7)/i', '#88CEFA', $svgString); 
		$svgString = preg_replace('/(#9EC2E9)/i', '#66A1DD', $svgString);

	}


	// This part lets you test out replacing colors with red by adding &highlight_lightest_blues to the end of your URL.

	if ( isset( $_GET['highlight_lightest_blues'] ) ) {
		// Add a "|" and a color to the first variable to select more colors. For example '/(color1|color2|color3)/i' replaces color1, color2 and color3.
		$svgString = preg_replace('/(#77C2F7|#D0E1F4|#C1E3FA)/i', 'red', $svgString); 
	}


	/***************************************************
	That's the end of the relevant code part!
	*****************************************************/




















	// The color to black and white replacement script (remove the conditional to activate this)
	if ( false && $is_me ) {

		$svgString = preg_replace('/(#0D6392|#275D90)/i', '#666', $svgString); // dark
		$svgString = preg_replace('/(#1D4871|#133250)/i', '#888', $svgString); // dark (maybe less?)
		$svgString = preg_replace('/(#016188)/i', '#888', $svgString); // dark (maybe less?)
		$svgString = preg_replace('/(#62B2E1|#66A1DD|#578CC0)/i', '#AAA', $svgString); // medium
		$svgString = preg_replace('/(#398EC0)/i', '#BBB', $svgString); // medium for single color bars
		$svgString = preg_replace('/(#88CEFA|#9EC2E9)/i', '#CCC', $svgString); // light
		$svgString = preg_replace('/(#CCE8FC|#D0E1F4)/i', '#DDD', $svgString); // lightest

		// Recession shading
		$svgString = preg_replace('/(#F5F5F5)/i', '#F5F5F5', $svgString); // lightest

	}
	
	
	// Make axis lines and tickmarks consistent. Default is grey, but some are black.
	// EX: <line fill="none" stroke="#989898" stroke-linejoin="round" stroke-miterlimit="10" x1="51.084" y1="313.783" x2="51.084" y2="9.236"></line>
	// PROBLEM: this also gets lines that aren't axes, such as trend line in 3Q. 
	// We could restrict to only vertical and horizontal lines (i.e., where x1 == x2 OR y1 == y2), but it might be quite intensive
	$svgString = preg_replace('/(#989898)/i', '#000000', $svgString); // lightest
	
	
	
	
	
	// Illustrator's multiline []-enclosed doctype attributes cause "]>" to render in the browser
	$svgString = preg_replace('/(<!DOCTYPE[^>]*)\[[^\]]*](>)/', '$1$2', $svgString);
	
	// Remove the XML declaration and doctype because we are using the SVG code inline, not embedding the SVG file
	$svgString = str_replace('<?xml version="1.0" encoding="utf-8"?>', '', $svgString);
	$svgString = str_replace('<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">', '', $svgString);
	
	// Illustrator's <foreignObject> element prevents the SVG from rendering in Safari and DocRaptor
	$svgString = preg_replace('/<\/?foreignObject[^>]*>/', '', $svgString);

	$svgString = preg_replace('/<!\[CDATA\[[^\]]*\]\]>/msi', '', $svgString);
	$svgString = preg_replace('/<\/?switch[^>]*>/', '', $svgString);
	
	// Remove <tspan> elements and add their attributes to their parent <text> tags
	$svgString = preg_replace('/<text([^>]*)><tspan([^>]*)>/', '<text$1$2>', $svgString);
	$svgString = preg_replace('/<\/tspan><\/text>/', '</text>', $svgString);
	$svgString = preg_replace('/<\/?tspan[^>]*>/', '', $svgString);

	// Replace font names with TypeKit font names so that they'll work on the web
	// // $svgString = preg_replace('/MyriadPro[^\']*/i', 'myriad-pro-semi-condensed', $svgString); //myriad-pro, myriad-pro-condensed, myriad-pro-semi-condensed
	$svgString = preg_replace('/MyriadPro-Regular/i', 'myriad-pro', $svgString); //myriad-pro, myriad-pro-condensed, myriad-pro-semi-condensed
	$svgString = preg_replace('/MyriadPro-Light/i', 'myriad-pro', $svgString); //myriad-pro, myriad-pro-condensed, myriad-pro-semi-condensed
	$svgString = preg_replace('/MyriadPro-SemiCn/i', 'myriad-pro-semi-condensed', $svgString); //myriad-pro, myriad-pro-condensed, myriad-pro-semi-condensed
	$svgString = preg_replace('/"\'MyriadPro-Bold\'"/i', '"\'myriad-pro\'" font-weight="bold"', $svgString); //myriad-pro, myriad-pro-condensed, myriad-pro-semi-condensed
	$svgString = preg_replace('/"\'MyriadPro-BoldSemiCn\'"/i', '"\'myriad-pro-semi-condensed\'" font-weight="bold"', $svgString); //myriad-pro, myriad-pro-condensed, myriad-pro-semi-condensed
	$svgString = preg_replace('/MyriadPro[^\']*/i', 'myriad-pro', $svgString); //myriad-pro, myriad-pro-condensed, myriad-pro-semi-condensed

	// Increase font sizes
	// @dependencies epi_pregreplace_fontsize (declared above)
	// $svgString = preg_replace('/font-size="([\d\.]+)"/i', 'font-size="16"', $svgString);
	// $svgString = preg_replace_callback('/font-size="([\d\.]+)"/i', 'epi_pregreplace_fontsize', $svgString); // works!
	

	// $svgString = preg_replace('/<\/?i:pgf[^>]*>/', '', $svgString); // illustrator
	// // $svgString = preg_replace('/[\s*<!ENTITY[^\]]*]/', '', $svgString); // illustrator
	// $svgString = preg_replace('/(<!DOCTYPE[^>]*)\[[^\]]*](>)/', '$1$2', $svgString); // illustrator
	// 
	// // add preserveAspectRatio="xMinYMin meet"  to svg opening tag for resizing??
	// // $svgString = '<div class="clearfixxxx" style="width: 100%;">'.$svgString.'</div>';

	return $svgString;
	
}

