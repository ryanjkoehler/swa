<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<div id="intro">
	<!-- <h1><?php the_title(); ?></h1> -->
	
	<?php the_content(); ?>
		</div>

<style type="text/css">
/*
			.button-link {
			    padding: .25em .4em;
			    background: #4479BA;
			    color: #FFF;

			    -webkit-border-radius: 4px;
			    -moz-border-radius: 4px;
			    border-radius: 4px;

			    border: solid 1px #20538D;

			    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);

			    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
			    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
			    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);

			    -webkit-transition-duration: 0.6s;
			    -moz-transition-duration: 0.6s;
			    transition-duration: 0.6s;

			    -webkit-user-select:none;
			    -moz-user-select:none;
			    -ms-user-select:none;
			    user-select:none;
			}
			.button-link:hover {
			    background: #356094;
			    border: solid 1px #2A4E77;
			    text-decoration: none;
			    color: #fff;
			}

			.button-link:visited {
				color: #fff;
			}

			.middlebutton {
				-webkit-border-radius:  0px;
					-moz-border-radius: 0px;
					  	 border-radius: 0px;
			}

			.leftbutton {
				-webkit-border-top-right-radius: 0px;
				-webkit-border-bottom-right-radius: 0px;
				-moz-border-radius-topright: 0px;
				-moz-border-radius-bottomright: 0px;
				border-top-right-radius: 0px;
				border-bottom-right-radius: 0px;
			}
			.rightbutton {
				-webkit-border-top-left-radius: 0px;
				-webkit-border-bottom-left-radius: 0px;
				-moz-border-radius-topleft: 0px;
				-moz-border-radius-bottomleft: 0px;
				border-top-left-radius: 0px;
				border-bottom-left-radius: 0px;
			}

			.button-link:active {
			    -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
			    -moz-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
			    box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);

			    background: #2E5481;
			    border: solid 1px #203E5F;
			    color: #fff;
			}



			.buttoncontainer {
				margin: 1em 0;
				font-size: 1.4em;
				text-align: right;
			}

			.button-link {
				font-family: Georgia;
				font-style: italic;
			}

			.button-link span {
				font-family: 'myriad-pro';
				font-style: normal;
				text-transform: uppercase;
				font-weight: bold;
				color: hsl(200, 90%, 85%);
			}
			
*/


</style>

<?php 

function epi_reader_showChapters() {
	$r = '';
	$chapters = array();
	$chapters[] = "Overview";
	$chapters[] = "Income";
	$chapters[] = "Mobility";
	$chapters[] = "Wages";
	$chapters[] = "Jobs";
	$chapters[] = "Wealth";
	$chapters[] = "Poverty";
	$chapters[] = "Appendix";

	foreach ($chapters as $key => $chapter) {
		// $r .= '<h2>'.$chapter.'</h2>';
		?> 
		<div class="chapterbox">
			<h2 class="chaptertitle"><a href="#<?php echo $chapter; ?>">
				<span class="chapternumber">
					<?php echo $key+1; ?>
				</span>
				<?php echo $chapter; ?></a></h2>
			<div class="expansion" style="display:none;">
				<p><a class="button-link" href="#">Download <span>PDF</span></a> <a class="button-link" href="#">View <span>charts</span></a></p>
				<?php // Output a list of tags that are children of this tag ?>

				<ul class="chapter-toc" style="list-style-type: none; margin: 0">
				<li>I. Poverty and the macroeconomy
				</li>
				<li>II. Poverty demographics – age, race, ethnicity, family type, and nativity
				</li>
				<li>III. Poverty – twice poverty, deep poverty, relative poverty, and persistance
				</li>
				<li>IV. Alternative poverty measures
				</li>
				<li>V. Government policy and poverty
				</li>
				<li>VI. Poverty and low-wage workers
				</li>
				</ul>



				<p>
					<?php if ($previousChapter = $chapters[$key-1]) { ?>
						<a href="#<?php echo $previousChapter; ?>">Previous chapter</a>
					<?php } ?>
					<?php if ($nextChapter = $chapters[$key+1]) { ?>
						<a href="#<?php echo $nextChapter; ?>">Next chapter</a>
					<?php } ?>

				</p>
			</div>
		</div>
		<?php
	}
}

$pdfURL = get_template_directory_uri() . '/SWA-Wages.pdf?#page=1&view=FitH&zoom=200%&scrollbar=0&toolbar=0&navpanes=0';

 ?>

<div id="readercontainer">
	<div id="viewer" class="clearfix">
		<div id="viewerbar" class="clearfix">
			<div class="vbelement vbtitle"><strong><em>State of Working America</em></strong> 12th Edition</div>
			<!-- <div class="vbelement">&#9664; | &#9654;</div> -->
			<div class="vbelement">Buy the book</div>
		</div>
		<div id="pdfobject"></div>
		<object id="pdf_content" type="application/pdf" data="<?php echo $pdfURL; ?>">
			<div class="pdf-fallback">
				<p><a href="<?php echo $pdfURL; ?>">Click here to view the <?php echo $chapter; ?> PDF.</a></p>
			</div>
		</object>
	</div>
	<div id="navigator" class="clearfix">
		<?php epi_reader_showChapters(); ?>
	</div>
</div>

</div>


<?php endwhile; endif; ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js-new/pdfobject.min.js"></script>
<script type="text/javascript">
	// window.onload = function (){
	// 	var myPDF = new PDFObject({ 
	// 		url: "<?php echo $pdfURL; ?>",
	// 		// navpanes: 1,
	// 		// view: "FitH", //FitV
	// 		// pagemode: "thumbs", 
	// 		// search: "shape of wage"
	// 	}).embed('pdfobject');
	// };
</script>
<script type="text/javascript">


jQuery(function ($) {	

	console.log('test');

	var $expandables = $('.chapterbox .expansion');

	$("h2.chaptertitle").click(function(e){
		var $target = $(this).next('.expansion');
		$target.show();
		$expandables.not($target).hide();
		// $(this).next('.expansion').fadeIn().parent('.chapterbox'); //.siblings().find('.expansion').fadeIn();
		e.preventDefault();
	})
});

</script>


<?php // get_sidebar() ?>
    
<?php get_footer(); ?>