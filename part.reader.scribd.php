<?php 
	
	$term = get_queried_object();
	$mytax = get_posts("post_type=tax&subject={$term->slug}");
	$tax_id = $mytax[0]->ID;
	$pdf_url = get_post_meta($tax_id, 'pdf_url', true);

	$pdf_url = strpos($pdf_url, 'ttp') ? $pdf_url : home_url($pdf_url);

	echo $pdf_url;
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

<script type='text/javascript' src='http://www.scribd.com/javascripts/scribd_api.js'></script>


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

<script type="text/javascript">
  var scribd_doc = scribd.Document.getDocFromUrl( '<?php echo $pdf_url; ?>' , 'pub-5561074432583746928' );

  var onDocReady = function(e){
    scribd_doc.api.setPage(2);
  }

  scribd_doc.addParam('jsapi_version', 2);
  scribd_doc.addEventListener('docReady', onDocReady);
  scribd_doc.write('embedded_doc');
</script>