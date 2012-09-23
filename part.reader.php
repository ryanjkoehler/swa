<?php 
	
	$term = get_queried_object();
	$mytax = get_posts("post_type=tax&subject={$term->slug}");
	$tax_id = $mytax[0]->ID;
	$pdf_url = get_post_meta($tax_id, 'pdf_url', true);

	// $pdf_url = strpos($pdf_url, 'ttp') ? $pdf_url : home_url($pdf_url);
	// $pdf_url = strpos($pdf_url, 'ttp') ? $pdf_url : 'http://epi-data.org/_swa-embargo'.$pdf_url; // embargo url
	// $pdf_url = strpos($pdf_url, 'ttp') ? $pdf_url : 'http://stateofworkingamerica.org'.$pdf_url;
	$pdf_url = strpos($pdf_url, 'ttp') ? $pdf_url : site_url($pdf_url); // embargo url

	// echo $pdf_url;
	// $pdf_url = 'http://www.epi.org/files/2012/bp340-labor-market-young-graduates.pdf';


	$terms = array('overview', 'income', 'mobility', 'wages', 'jobs', 'wealth', 'poverty' );

	foreach($terms as $i => $term ) {
		$term = get_term_by( 'slug', $term, 'subject' );
		$link = get_term_link($term);
		$readerLink = $link . '?reader';

		$active = ( $term->slug == get_queried_object()->slug ) ? ' class="active-chapter"' : '';


		$output['chapter_links'] .= ($i != 0) ? ' | ' : '';
		$output['chapter_links'] .= '<a href="'.$readerLink.'"'.$active.'>'. $term->name .'</a>';
	}

	$output['chapter_links'] .= ' | <a class="ital" href="" id="toggle-viewermore" data-toggleTarget="#reader_more">more</a>';


 ?>

<div id="reader_bar">
	<h1><strong>The State of Working America</strong> <span>12th Edition</span></h1>
	<!-- <a href="http://www.epi.org/getswa/" class="buylink">Preorder the book</a> -->
</div>

<div id="reader_nav">
	<?php echo $output['chapter_links']; ?>
</div>
<div id="reader_more" style="display: none;">
	<!-- <a href="<?php echo home_url('/12th-edition-table-of-contents/'); ?>">Table of contents</a> | <a href="#">Appendix</a> | <a href="#">Full documentation and methodology</a> -->
	<a href="<?php echo home_url('/files/book/Table-of-Contents.pdf'); ?>">Table of contents</a> | <a href="<?php echo home_url('/files/book/Appendices.pdf'); ?>">Appendices</a> | <a href="<?php echo home_url('/files/book/Documentation-and-Methodology.pdf'); ?>">Documentation and methodology</a>
</div>


<script type="text/javascript">

jQuery(function ($) {
	$("[data-toggleTarget]").click(function(e){
		var $this = $(this);
		var target = $this.attr('data-toggleTarget');
		$(target).slideToggle(200);
		e.preventDefault();
	});
});

</script>


<div id='embedded_doc'></div>
<div id="google_viewer">
<iframe width='100%' height='700' frameborder='0' scrolling='no' src='http://docs.google.com/viewer?url=<?php echo $pdf_url; ?>&embedded=true' ></iframe>

</div>