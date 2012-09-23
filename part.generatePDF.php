<?php if ( is_user_logged_in() ) { ?>
<div class="admin-only">
	<div id="hide" style="height:50px;"></div>
	<strong>Javascript-based PDF generation</strong>:
		<a href="#" id="docraptor-javascript" onclick="hey.docraptor.download({test:true});">Test PDF</a> |
		<a href="#" id="docraptor-javascript" onclick="hey.docraptor.download({test:false});">Final PDF</a><br>
</div>
<?php } ?>