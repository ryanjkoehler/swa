
<div id="aside">


	<div class="widget-bigtext clearfix">
		<!-- <p><a href="/data">Get the data</a> behind the charts.</p> -->
		<h2>Key numbers</h2>
		<p>Topic-specific fact sheets of key findings in <em>The State of Working America, 12th Edition</em></p>	

		<?php 

$factsheetlist = <<<EOF
<h3>Chapters</h3>
<ul>
<li>[safelink page="Key findings" text="Overview" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Income" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Mobility" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Wages" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Jobs" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Wealth" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Poverty" type="fact-sheet" field="fact_sheet_pdf"]</li>
</ul>

<h3>Demographics</h3>
<ul>
<li>[safelink page="African Americans" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Latinos" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Women" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Young workers" type="fact-sheet" field="fact_sheet_pdf"]</li>
</ul>

<h3>Featured issues</h3>
<ul>
<li>[safelink page="Collective bargaining" type="fact-sheet" field="fact_sheet_pdf"]</li>
<li>[safelink page="Inequality" type="fact-sheet" field="fact_sheet_pdf"]</li>
</ul>
EOF;

echo do_shortcode($factsheetlist);

		// echo do_shortcode('<h4>[safelink page="key numbers"]</h4>');
		// echo do_shortcode('<h4>[safelink page="37717" text="This is custom text"]</h4>');
		// echo do_shortcode('<h4>[safelink subject="Income" text="This is custom text"]</h4>');

		

		$factsheets = get_posts('post_type=page&type=fact-sheet&numberposts=19&order=menu_order');

		$factsheets = array();

		foreach ( $factsheets as $factsheet ) {
			?>	
			<li>
				<a href="<?php echo get_permalink($factsheet->ID); ?>">
					<?php echo $factsheet->post_title; ?>
				</a>
			</li>
			<?php
		}
		?>
		</ul>
	</div>
</div>


