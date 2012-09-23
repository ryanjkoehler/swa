<?php
/**
* Description of Template goes here
*
Template Name: Page
*/

?>


<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<div id="intro" <?php post_class(); ?>>
	<header class="fact-header">
		<h1><?php the_title(); ?></h1>
	</header>
	
	<?php the_content(); ?>

	<?php 



	$folders["Income data"] = array(
		"Annual work hours for middle income families",
		"Family income limits, by quintile and top 5%",
		"Income levels",
		"Income shares",
		"Mean family income, by income group",
		"Mean post-tax income levels, by income group",
		"Mean pre-tax income levels, by income group",
		"Median family income",
		"Median income, by race",
		"Share of aggregate family income",
		);

	$folders["Jobs data"] = array(
		"Employment to population ratio (EPOPs)",
		"Job Openings and Labor Turnover (JOLTS)",
		"Labor force participation rate (LFPR)",
		"Long term unemployment",
		"Underemployment",
		"Unemployment rates",
		);

	$folders["Wage data"] = array(
		"Annual wages and hours",
		"Annual wages by wage group",
		"College and high school wage premiums",
		"Compensation, Benefits, wages",
		"Education shares of employment",
		"Entry level benefits",
		"Entry level wages",
		"Health and pension benefit coverage",
		"Minimum wage",
		"Poverty level wages",
		"Production and nonsupervisory earnings",
		"Productivity and compensation",
		"Union coverage",
		"Wage deciles",
		"Wage gaps",
		"Wage Inequality measures",
		"Wages by education",
		);

	foreach ($folders as $folder => $files) {
		$extension = ".xlsx";
		$extension = ($folder == "Jobs data") ? '.xls' : '.xlsx';

		echo '<h2>'.$folder.'</h2>';
		echo '<ul>';

		foreach ( $files as $file ) {
			$url = "http://www.epi.org/files/2012/data-swa/".str_replace(' ', '-', strtolower($folder))."/{$file}{$extension}";
			echo '<li><a href="'. $url .'">'. $file .'</a></li>';
		}

		echo '</ul>';


	}
 	?>


		</div>

<?php if (wp_get_object_terms($post->ID, 'feature')): ?>

		<div class="utilities">
			<div class="print-feature"></div>
		</div>

<?php endif ?>


</div>

<?php endwhile; endif; ?>



<?php get_sidebar() ?>

<script type="text/javascript">
	jQuery(function ($) {
		$(".calloutnumber:contains('ppt.')").each(function(){
			$this = $(this);
			html = $this.html();
			html = html.replace(/ppt./gi, '<span class="light">ppt.</span>' );
			$this.html(html);
		})

	});
</script>

<?php get_footer(); ?>